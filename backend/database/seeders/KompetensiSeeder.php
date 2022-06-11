<?php

namespace Database\Seeders;

use App\Models\Kompetensi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KompetensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kompetensi::insert([
            [
                "id" => "84e29080-1481-404d-92a1-c223e082b22b", 
                "skkpd" => "landasan hidup religius",
                "pengenalan" => "mempelajari hal ihwal ibadah",
                "akomodasi" => "Mengembangkan pemikiran tentang kehidupan beragama",
                "tindakan" => "Melaksanakan ibadah atas keyakinan sendiri disertai sikap toleransi",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => "d0bcd559-581e-4bd5-8751-c7ec6a3e2dc7", 
                "skkpd" => "Landasan Perilaku Etis",
                "pengenalan" => "Mengenal keragaman sumber norma yang berlaku di masyarakat",
                "akomodasi" => "Menghargai Keragaman sumber norma sebagai rujukan pengambilan",
                "tindakan" => "Berperilaku atas dasar keputusan yang mempertimbangkan aspek-aspek etis",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => "a19ac4d2-30b9-49bf-b57c-0ffdab7d50ab", 
                "skkpd" => "Kematangan Emosi",
                "pengenalan" => "Mempelajari cara-cara menghindari konflik dengan orang lain",
                "akomodasi" => "Bersikap toleran terhadap ragam ekspresi perasaan diri sendiri dan orang lain",
                "tindakan" => "Mengekspresikan perasaan dalam cara-cara yang bebas,terbuka dan tidak  menimbulkan konflik",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => "27729beb-8071-4b41-876f-906999baa426", 
                "skkpd" => "Pengembangan Pribadi",
                "pengenalan" => "Mempelajari keunikan diri dalam konteks kehidupan sosial",
                "akomodasi" => "Menerima keunikan diri dengan segala kelebihan dan kekurangannya",
                "tindakan" => "Menampilkan keunikan diri secara harmonis dalam keragaman",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => "a214ff4e-a945-43b9-977b-29ebba8080d5", 
                "skkpd" => "Kesiapan Diri untuk Menikah dan Berkeluarga",
                "pengenalan" => "Mengenal norma- norma pernikahan dan berkeluarga",
                "akomodasi" => "Mengharagai norma-norma pernikahan dan berkeluarga sebagai landasan bagi terciptanya kehidupan masyarakat yang harmonis",
                "tindakan" => "Mengekspresikan keinginannya untuk mempelajari lebih intensif tentang norma pernikahan dan berkeluarga",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => "ec7ccc3c-16f6-4fa6-a5e8-510f2636b082", 
                "skkpd" => "Kesadaran Tanggung Jawab Sosial",
                "pengenalan" => "Mempelajari keragaman interaksi sosial",
                "akomodasi" => "Menyadari nilai-nilai persahabatan dan keharmonisan dalam konteks keragaman interaksi sosial",
                "tindakan" => "Berinteraksi dengan orang lain atas dasar kesamaan",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => "9dea1b1f-6357-4aaf-b393-89f034c7ee48", 
                "skkpd" => "Kematangan Hubungan dengan Teman Sebaya",
                "pengenalan" => "Mempelajari cara-cara membina dan kerjasama dan toleransi dalam pergaulan dengan teman sebaya",
                "akomodasi" => "Menghargai nilai-nilai kerjasama dan toleransi sebagai dasar untuk menjalin persahabatan dengan teman sebaya",
                "tindakan" => "Mempererat jalinan persahabatan yang lebih akrab dengan memperhatikan norma yang berlaku",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => "3110ec6e-3757-49d4-8cf8-84c5239b2e5d", 
                "skkpd" => "Kesadaran Gender",
                "pengenalan" => "Mempelajari perilaku kolaborasi antar jenis dalam ragam kehidupan",
                "akomodasi" => "Menghargai keragaman peraan laki-laki atau perempuan sebagai aset kolaborasi dan keharmonisan hidup",
                "tindakan" => "Berkolaborasi secara harmonis dengan lain jenis dalam keragaman peran",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9", 
                "skkpd" => "Kematangan Intelektual",
                "pengenalan" => "Mempelajari cara-cara pengambilan keputusan dan pemecahan masalah secara objektif",
                "akomodasi" => "Menyadari akan keragaman alternatif keputusan dan konsekuensi yang dihadapinya",
                "tindakan" => "Mengambil keputusan dan pemecahan masalah atas dasar informasi/data secara obyektif",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => "d26c7621-ea85-4b94-96f5-7747ac4e90ed", 
                "skkpd" => "Perilaku Kewirausahaan/Kemandirian Perilaku Ekonomis",
                "pengenalan" => "Mempelajari strategi dan peluang untuk berperilaku hemat,ulet, sengguh-sungguh dan kompetitif dalam keragaman kehidupan",
                "akomodasi" => "Menerima nilai-nilai hidup hemat,ulet sungguh-sungguh dan kompetitif sebagai aset untuk mencapai hidup mandiri",
                "tindakan" => "Menampilkan hidup hemat, ulet, sungguh- sungguh dan kompetitif atas dasar kesadaran sendiri",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => "4aeb15f9-64e5-4e45-abfb-8bea715f1aca", 
                "skkpd" => "Wawasan dan Kesiapan Karir",
                "pengenalan" => "Mempelajari kemampuan diri, peluang dan ragam pekerjaan, pendidikan, dan aktifitas yang terfokus pada pengembangan alternatif karir yang lebih terarah",
                "akomodasi" => "Internalisasi nilai- niolai yang melandasi pertimbangan pemilihan alternatif karir",
                "tindakan" => "Mengembangkan alternatif perencanaan karir dengan mempertimbangkan kemampuan, peluang dan ragam karir",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
        ]);
    }
}
