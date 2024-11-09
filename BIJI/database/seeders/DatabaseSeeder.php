<?php

namespace Database\Seeders;
use App\Models\Faq;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {

            User::create([
                'username' => 'admin22',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password123'),
                'verified' => true,
                'role_id' => 1
            ]);
            User::create([
                'username' => 'BayuArdana',
                'email' => 'bayuardana213@gmail.com',
                'password' => bcrypt('password123'),
                'verified' => true,
                'role_id' => 0
            ]);
            Faq::create([
                'question' => 'Apa nama website ini?',
                'answer' => 'BIJI',
            ]);
            Faq::create([
                'question' => 'Kenapa bisa biji?',
                'answer' => 'Layaknya biji yang merupakan awal mula tumbuhan, perpustakaan adalah tempat untuk "menanam" ilmu dan pengetahuan. Setiap buku bisa dianggap sebagai sebuah biji yang, saat dibaca, menumbuhkan pengetahuan dalam pikiran kita. Nama "BIJI" mencerminkan misi perpustakaan untuk menjadi "bibit" dari setiap ilmu yang dipelajari dan dikembangkan oleh pembaca.',
            ]);
            Faq::create([
                'question' => 'Siapa kamu?',
                'answer' => 'Saya NexusBot, selalu siap membantu kamu kapan saja.',
            ]);
            Faq::create([
                'question' => 'Apa kepanjangan BIJI?',
                'answer' => 'Basis Informasi Jaringan Ilmu',
            ]);
            Faq::create([
                'question' => 'Apa kesingkatan BIJI?',
                'answer' => 'Basis Informasi Jaringan Ilmu',
            ]);
            Faq::create([
                'question' => 'Apa itu BIJI?',
                'answer' => 'Basis Informasi Jaringan Ilmu',
            ]);
            Faq::create([
                'question' => 'Siapa yang membuat kamu?',
                'answer' => 'Team Sahabat Petot',
            ]);
            Faq::create([
                'question' => 'Kamu dibuat oleh siapa?',
                'answer' => 'Team Sahabat Petot',
            ]);
            Faq::create([
                'question' => 'Siapa saja nama autor kamu?',
                'answer' => 'Bayu, Daniel, Dika',
            ]);
            Faq::create([
                'question' => 'Apa saja warna yang ada di website ini?',
                'answer' => 'Coklat tua, Cream, Abu Abu',
            ]);
    }
}
