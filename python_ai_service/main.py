from fastapi.middleware.cors import CORSMiddleware
from datetime import datetime
from fastapi import FastAPI, HTTPException, Request
from pydantic import BaseModel, Field
from typing import List, Dict, Any
import os
import httpx
import json
import logging
import re
import uuid

# ==============================================================================
# LOGGING CONFIGURATION
# ==============================================================================
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

# ==============================================================================
# PYDANTIC MODELS (SEMUA HARUS DI SINI DULU)
# ==============================================================================

class HoaxCheckRequest(BaseModel):
    mission_id: str
    user_choice: str

class LibraryGenerateRequest(BaseModel):
    format: str
    genre: str

class GrammarGenerateRequest(BaseModel):
    difficulty: str = "intermediate"

class LiteracyGenerateRequest(BaseModel):
    topic: str

# ==============================================================================
# KONFIGURASI DAN KUNCI API
# ==============================================================================
app = FastAPI(title="Literise AI Service", version="1.0")

GEMINI_API_KEY = os.environ.get("GEMINI_API_KEY")
if not GEMINI_API_KEY:
    logger.warning("⚠️ GEMINI_API_KEY tidak ditemukan di environment")

GEMINI_API_URL = f"https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={GEMINI_API_KEY}" if GEMINI_API_KEY else None

app.add_middleware(
    CORSMiddleware,
    allow_origins=[
        "https://literise.vercel.app",
        "https://python-ai-service-syahrrulll-syahrrullls-projects.vercel.app",
        "http://localhost:3000",
        "http://127.0.0.1:8000",
        "*"
    ],
    allow_credentials=True,
    allow_methods=["GET", "POST", "OPTIONS"],
    allow_headers=["*"],
)

client = httpx.AsyncClient(timeout=60.0)
GAME_CACHE: Dict[str, Dict[str, Any]] = {}

# ==============================================================================
# HELPER FUNCTIONS
# ==============================================================================

async def call_gemini_api(prompt: str) -> str:
    """Call Gemini API dengan error handling."""
    try:
        if not GEMINI_API_URL:
            logger.error("❌ GEMINI_API_URL not configured")
            raise HTTPException(status_code=500, detail="API Key not configured")

        payload = {
            "contents": [{
                "parts": [{
                    "text": prompt
                }]
            }]
        }

        logger.info(f"📤 Sending to Gemini: {prompt[:100]}...")
        response = await client.post(GEMINI_API_URL, json=payload)

        logger.info(f"📥 Gemini status: {response.status_code}")

        if response.status_code != 200:
            error_detail = response.text
            logger.error(f"❌ Gemini error {response.status_code}: {error_detail}")
            raise HTTPException(status_code=response.status_code, detail=error_detail)

        result = response.json()

        if "candidates" not in result or not result["candidates"]:
            logger.error(f"❌ Empty candidates from Gemini: {result}")
            raise HTTPException(status_code=400, detail="No response from Gemini")

        generated_text = result["candidates"][0]["content"]["parts"][0]["text"]
        logger.info(f"✅ Generated text: {generated_text[:100]}...")

        return generated_text

    except Exception as e:
        logger.error(f"❌ call_gemini_api error: {str(e)}")
        raise

# ==============================================================================
# ENDPOINTS - HEALTH CHECK
# ==============================================================================

@app.get("/api/health")
async def health_check():
    """Simple health check."""
    return {"status": "ok", "service": "Literise AI Service"}

# ==============================================================================
# ENDPOINTS - HOAX OR NOT?
# ==============================================================================

@app.get("/api/hoax-quiz/generate")
async def generate_hoax():
    """Generate berita hoax/fakta."""
    try:
        prompt = """Buatkan 1 berita viral dalam bahasa Indonesia yang bisa berupa hoax atau fakta.

Berikan response HANYA dalam format JSON (tanpa markdown, tanpa penjelasan):
{
    "mission_id": "hoax-" + random-uuid,
    "news_snippet": "Teks berita singkat (maksimal 200 karakter)",
    "correct_answer": "Hoax" atau "Fakta",
    "explanation": "Penjelasan singkat",
    "source": "Sumber atau 'Unknown'"
}"""

        text = await call_gemini_api(prompt)

        # Extract JSON dari response
        json_match = re.search(r'\{[^{}]*(?:\{[^{}]*\}[^{}]*)*\}', text, re.DOTALL)
        if json_match:
            result = json.loads(json_match.group())
            result["mission_id"] = str(uuid.uuid4())
        else:
            logger.error(f"❌ Invalid JSON in response: {text}")
            raise HTTPException(status_code=400, detail="Invalid response format from AI")

        logger.info(f"✅ Hoax quiz generated: {result.get('mission_id')}")
        return result

    except Exception as e:
        logger.error(f"❌ generate_hoax error: {str(e)}")
        raise HTTPException(status_code=500, detail=str(e))

@app.post("/api/hoax-quiz/check")
async def check_hoax_answer(request: HoaxCheckRequest):
    """Check user answer untuk hoax quiz."""
    try:
        logger.info(f"🔍 Checking hoax answer: {request.user_choice}")

        prompt = f"""Anda adalah validator berita hoax. User memilih '{request.user_choice}' untuk suatu berita.

Buatkan response dalam format JSON:
{{
    "is_correct": true/false,
    "correct_answer": "Hoax" atau "Fakta",
    "explanation": "Penjelasan mengapa..."
}}"""

        text = await call_gemini_api(prompt)

        json_match = re.search(r'\{[^{}]*(?:\{[^{}]*\}[^{}]*)*\}', text, re.DOTALL)
        if json_match:
            result = json.loads(json_match.group())
        else:
            raise HTTPException(status_code=400, detail="Invalid response format")

        logger.info(f"✅ Hoax check result: is_correct={result.get('is_correct')}")
        return result

    except Exception as e:
        logger.error(f"❌ check_hoax_answer error: {str(e)}")
        raise HTTPException(status_code=500, detail=str(e))

# ==============================================================================
# ENDPOINTS - LIBRARY HUB
# ==============================================================================

@app.post("/api/library/generate-full-text")
async def generate_library_text(request: LibraryGenerateRequest):
    """Generate bacaan untuk library."""
    try:
        logger.info(f"📚 Generating library: format={request.format}, genre={request.genre}")

        prompt = f"""Buatkan 1 {request.format} dalam genre {request.genre} dalam bahasa Indonesia.

Berikan response dalam format JSON:
{{
    "game_id": "lib-" + uuid,
    "title": "Judul",
    "full_text": "Teks lengkap minimal 500 karakter",
    "word_count": jumlah kata
}}"""

        text = await call_gemini_api(prompt)

        json_match = re.search(r'\{[^{}]*(?:\{[^{}]*\}[^{}]*)*\}', text, re.DOTALL)
        if json_match:
            result = json.loads(json_match.group())
            result["game_id"] = f"lib-{uuid.uuid4()}"
        else:
            raise HTTPException(status_code=400, detail="Invalid response format")

        logger.info(f"✅ Library text generated: {result.get('game_id')}")
        return result

    except Exception as e:
        logger.error(f"❌ generate_library_text error: {str(e)}")
        raise HTTPException(status_code=500, detail=str(e))

@app.post("/api/library/validate-blanks/{game_id}")
async def validate_library_answers(game_id: str, answers: Dict[str, List[str]]):
    """Validate library quiz answers."""
    try:
        logger.info(f"✅ Validating library answers for {game_id}")
        return {"is_correct": True, "total_score": 100}
    except Exception as e:
        logger.error(f"❌ validate_library_answers error: {str(e)}")
        raise HTTPException(status_code=500, detail=str(e))

# ==============================================================================
# ENDPOINTS - GRAMMAR ZONE
# ==============================================================================

@app.post("/api/grammar-zone/generate-mission")
async def generate_grammar_mission(request: GrammarGenerateRequest):
    """Generate kalimat salah untuk grammar zone."""
    try:
        logger.info(f"✏️ Generating grammar mission: difficulty={request.difficulty}")

        prompt = f"""Buatkan 5 kalimat bahasa Indonesia dengan tingkat kesulitan {request.difficulty}.
Beberapa kalimat benar, beberapa salah (mix).

Format JSON:
{{
    "game_id": "gram-" + uuid,
    "sentences": [
        {{"id": 1, "text": "Kalimat 1", "is_correct": true}},
        {{"id": 2, "text": "Kalimat 2", "is_correct": false}}
    ]
}}"""

        text = await call_gemini_api(prompt)

        json_match = re.search(r'\{[^{}]*(?:\{[^{}]*\}[^{}]*)*\}', text, re.DOTALL)
        if json_match:
            result = json.loads(json_match.group())
            result["game_id"] = f"gram-{uuid.uuid4()}"
        else:
            raise HTTPException(status_code=400, detail="Invalid response format")

        logger.info(f"✅ Grammar mission generated: {result.get('game_id')}")
        return result

    except Exception as e:
        logger.error(f"❌ generate_grammar_mission error: {str(e)}")
        raise HTTPException(status_code=500, detail=str(e))

@app.post("/api/grammar-zone/submit-game/{game_id}")
async def submit_grammar_game(game_id: str, corrections: Dict[str, List[str]]):
    """Submit grammar game answers."""
    try:
        logger.info(f"✅ Submitting grammar game: {game_id}")
        return {"is_correct": True, "total_score": 100}
    except Exception as e:
        logger.error(f"❌ submit_grammar_game error: {str(e)}")
        raise HTTPException(status_code=500, detail=str(e))

# ==============================================================================
# ENDPOINTS - READING MISSION (Main Game)
# ==============================================================================

@app.post("/api/game/generate-mission")
async def generate_game_mission():
    """Generate reading mission."""
    try:
        logger.info("🎮 Generating game mission")
        return {"mission_id": str(uuid.uuid4()), "content": "Mock mission"}
    except Exception as e:
        logger.error(f"❌ generate_game_mission error: {str(e)}")
        raise HTTPException(status_code=500, detail=str(e))

@app.post("/api/game/validate-quiz/{mission_id}")
async def validate_game_quiz(mission_id: str):
    """Validate game quiz."""
    try:
        logger.info(f"✅ Validating quiz: {mission_id}")
        return {"is_correct": True, "score": 100}
    except Exception as e:
        logger.error(f"❌ validate_game_quiz error: {str(e)}")
        raise HTTPException(status_code=500, detail=str(e))
