from fastapi import FastAPI
from pydantic import BaseModel
import json
import random

# Inisialisasi aplikasi FastAPI
app = FastAPI()

# Definisi skema data yang akan diterima dari Laravel
class UserResponse(BaseModel):
    user_id: int
    current_level: int
    answer: str

@app.post("/api/next-question")
def get_next_question(response: UserResponse):
    """
    Endpoint ini menerima jawaban dari Laravel dan mengembalikan soal baru
    dengan level yang ditingkatkan (simulasi mesin adaptif AI).
    """

    # 1. Dapatkan level saat ini
    current_level = response.current_level

    # 2. Hitung level baru (simulasi peningkatan)
    new_level = current_level + 1

    # 3. Tentukan kesulitan soal berikutnya berdasarkan level
    if new_level <= 5:
        difficulty = "EASY"
        question_text = f"Level {new_level}: Bacalah teks A. Apa makna kata yang digarisbawahi?"
    elif new_level <= 10:
        difficulty = "MEDIUM"
        question_text = f"Level {new_level}: Jelaskan kembali ide pokok teks A dengan bahasa Anda sendiri (min. 30 kata)."
    else:
        difficulty = "HARD"
        question_text = f"Level {new_level}: Tulis esai singkat 150 kata yang membandingkan teks A dan teks B."

    # 4. Kembalikan respons dalam format JSON yang diharapkan Laravel
    return {
        "new_level": new_level,
        "next_question": question_text,
        "difficulty": difficulty
    }

@app.get("/")
def read_root():
    """Endpoint untuk memastikan server Python berjalan."""
    return {"status": "AI Service Running", "framework": "FastAPI"}
