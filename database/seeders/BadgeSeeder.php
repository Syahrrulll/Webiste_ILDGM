<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge; // Pastikan model di-import

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cara aman untuk "truncate" koleksi (tabel) di MongoDB
        // Ini akan menghapus semua badge lama sebelum memasukkan yang baru.
        Badge::query()->delete();

        // Koleksi untuk 'badge_user' (pivot) akan dibuat
        // dan dikelola secara otomatis oleh relasi.
        // Jika Anda perlu membersihkannya, Anda bisa melakukannya
        // melalui model User (misal user->badges()->detach()),
        // tapi untuk seeder badge, ini tidak perlu.

        // Ikon SVG (diambil dari versi SQL Anda)
        $icon_star = '<path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.31h5.418a.563.563 0 01.321.988l-4.386 3.179a.562.562 0 00-.192.51l1.638 5.378a.563.563 0 01-.84.62l-4.796-3.482a.563.563 0 00-.576 0l-4.796 3.482a.563.563 0 01-.84-.62l1.638-5.378a.562.562 0 00-.192-.51l-4.386-3.179a.563.563 0 01.321-.988h5.418a.563.563 0 00.475-.31L11.48 3.5z" />';
        $icon_check = '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />';
        $icon_book = '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />';
        $icon_trophy = '<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9a2.25 2.25 0 00-2.25 2.25v.01c0 .69.56 1.25 1.25 1.25h12.5c.69 0 1.25-.56 1.25-1.25v-.01a2.25 2.25 0 00-2.25-2.25zM12.75 6.031a9 9 0 00-9.191 9.192h18.382a9 9 0 00-9.191-9.192zM12.75 6.031V3.75m0 2.281l-3.233-3.232m3.233 3.232l3.233-3.232m-3.233 3.232v6.75A2.25 2.25 0 0110.5 15h-3a2.25 2.25 0 01-2.25-2.25v-6.75m7.5 0v6.75A2.25 2.25 0 0015 15h3a2.25 2.25 0 002.25-2.25v-6.75m-7.5 0h7.5" />';
        $icon_search = '<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />';
        $icon_pencil = '<path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />';

        // Daftar badge lengkap (diambil dari versi SQL Anda)
        $badges = [
            // Badge Awal
            ['name' => 'Anggota Baru', 'description' => 'Berhasil bergabung dengan Literise!', 'icon_svg' => $icon_star, 'icon_color' => 'text-gray-400', 'criteria_code' => 'NEW_USER'],

            // Badge Game Pertama
            ['name' => 'Pembaca Pertama', 'description' => 'Menyelesaikan 1 Reading Mission.', 'icon_svg' => $icon_check, 'icon_color' => 'text-blue-500', 'criteria_code' => 'GAME_PLAY_1'],
            ['name' => 'Penyelidik Pertama', 'description' => 'Menyelesaikan 1 kuis Hoax or Not?.', 'icon_svg' => $icon_check, 'icon_color' => 'text-red-500', 'criteria_code' => 'HOAX_PLAY_1'],
            ['name' => 'Pustakawan Junior', 'description' => 'Menyelesaikan 1 game Library Hub.', 'icon_svg' => $icon_check, 'icon_color' => 'text-indigo-500', 'criteria_code' => 'LIB_PLAY_1'],
            ['name' => 'Korektor Pemula', 'description' => 'Menyelesaikan 1 game Zona Tata Bahasa.', 'icon_svg' => $icon_check, 'icon_color' => 'text-teal-500', 'criteria_code' => 'GRAMMAR_PLAY_1'],

            // Badge Kuantitas
            ['name' => 'Maraton Membaca', 'description' => 'Menyelesaikan 10 Reading Mission.', 'icon_svg' => $icon_book, 'icon_color' => 'text-blue-600', 'criteria_code' => 'GAME_PLAY_10'],
            ['name' => 'Pencari Fakta', 'description' => 'Menyelesaikan 10 kuis Hoax or Not?.', 'icon_svg' => $icon_search, 'icon_color' => 'text-red-600', 'criteria_code' => 'HOAX_PLAY_10'],
            ['name' => 'Master Tata Bahasa', 'description' => 'Menyelesaikan 10 game Zona Tata Bahasa.', 'icon_svg' => $icon_pencil, 'icon_color' => 'text-teal-600', 'criteria_code' => 'GRAMMAR_PLAY_10'],

            // Badge Skor
            ['name' => 'Skor Sempurna', 'description' => 'Mendapatkan skor 100 di game apapun.', 'icon_svg' => $icon_trophy, 'icon_color' => 'text-yellow-500', 'criteria_code' => 'SCORE_100'],
            ['name' => 'Kolektor Poin', 'description' => 'Mencapai total 5000 poin.', 'icon_svg' => $icon_trophy, 'icon_color' => 'text-yellow-600', 'criteria_code' => 'SCORE_5000'],
        ];

        // Masukkan data ke koleksi 'badges'
        foreach ($badges as $badge) {
            Badge::create($badge);
        }
    }
}
