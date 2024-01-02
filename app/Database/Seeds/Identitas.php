<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Identitas extends Seeder
{
    public function run()
    {
        $data = [
            [
                'type' => "section1-headline",
                'data' => '{"title": "Selamat Datang di DS Motor Cinangsi", "subtitle": "Kami menyediakan layanan perbaikan sepeda motor yang profesional dengan harga terjangkau."}',
                'visibility' => 1
            ],
            [
                'type' => "section2-headline",
                'data' => '{"title": "Layanan Kami", "subtitle": "Kami menawarkan berbagai layanan perbaikan dan perawatan sepeda motor."}',
                'visibility' => 1
            ],
            [
                'type' => "section3-headline",
                'data' => '{"title": "Kenapa Memilih Kami?", "subtitle": "Berikut adalah beberapa alasan mengapa Anda harus memilih bengkel motor kami."}',
                'visibility' => 1
            ],
            [
                'type' => "section4-headline",
                'data' => '{"title": "Hubungi Kami", "subtitle": "Setelah menghubungi kami, jangan lupa untuk datang!"}',
                'visibility' => 1
            ],
            [
                'type' => "section4-map",
                'data' => '{"map": "<iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1129.5904466700697!2d107.796212227274!3d-6.558723483832988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e693b0ef729f41f%3A0x42cd2271c5b36889!2sDS%20Motor!5e0!3m2!1sid!2sid!4v1701957963491!5m2!1sid!2sid" style="border:0;" height="300" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>"}',
                'visibility' => 1
            ],
            [
                'type' => "section4-item",
                'data' => '{"icon": "fas fa-phone fa-xl", "image": "", "small": "", "title": "Alamat", "subtitle": "Jalan Cinangsi, Kec. Cibogo, Kabupaten Subang, Jawa Barat 41285"}',
                'visibility' => 1
            ],
            [
                'type' => "section4-item",
                'data' => '{"icon": "fas fa-phone fa-xl", "title": "No Handphone", "subtitle": "+6285-3242-32492"}',
                'visibility' => 1
            ],
            [
                'type' => "section4-item",
                'data' => '{"icon": "fas fa-envelope fa-xl", "title": "Email", "subtitle": "dsmotor@gmail.com"}',
                'visibility' => 1
            ],
        ];

        foreach ($data as $item) {
            $this->db->table('identitas')->insert($item);
        }
    }
}
