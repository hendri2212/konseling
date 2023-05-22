<?php

namespace Database\Seeders;

use App\Models\Skkpd;
use Illuminate\Database\Seeder;

class SkkpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skkpd::insert([
            [
                "id" => "84e29080-1481-404d-92a1-c223e082b22b",
                "name" => "landasan hidup religius",
                "introduction" => "mempelajari hal ihwal ibadah",
                "accommodation" => "Mengembangkan pemikiran tentang kehidupan beragama",
                "action" => "Melaksanakan ibadah atas keyakinan sendiri disertai sikap toleransi",
                "field_component_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "created_at" => round(microtime(true) * 1000),
                "updated_at" => null,
            ],
            [
                "id" => "d0bcd559-581e-4bd5-8751-c7ec6a3e2dc7",
                "name" => "Landasan Perilaku Etis",
                "introduction" => "Mengenal keragaman sumber norma yang berlaku di masyarakat",
                "accommodation" => "Menghargai Keragaman sumber norma sebagai rujukan pengambilan",
                "action" => "Berperilaku atas dasar keputusan yang mempertimbangkan aspek-aspek etis",
                "field_component_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "created_at" => round(microtime(true) * 1000),
                "updated_at" => null,
            ],
            [
                "id" => "a19ac4d2-30b9-49bf-b57c-0ffdab7d50ab",
                "name" => "Kematangan Emosi",
                "introduction" => "Mempelajari cara-cara menghindari konflik dengan orang lain",
                "accommodation" => "Bersikap toleran terhadap ragam ekspresi perasaan diri sendiri dan orang lain",
                "action" => "Mengekspresikan perasaan dalam cara-cara yang bebas,terbuka dan tidak  menimbulkan konflik",
                "field_component_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "created_at" => round(microtime(true) * 1000),
                "updated_at" => null,
            ],
            [
                "id" => "27729beb-8071-4b41-876f-906999baa426",
                "name" => "Pengembangan Pribadi",
                "introduction" => "Mempelajari keunikan diri dalam konteks kehidupan sosial",
                "accommodation" => "Menerima keunikan diri dengan segala kelebihan dan kekurangannya",
                "action" => "Menampilkan keunikan diri secara harmonis dalam keragaman",
                "field_component_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "created_at" => round(microtime(true) * 1000),
                "updated_at" => null,
            ],
            [
                "id" => "a214ff4e-a945-43b9-977b-29ebba8080d5",
                "name" => "Kesiapan Diri untuk Menikah dan Berkeluarga",
                "introduction" => "Mengenal norma- norma pernikahan dan berkeluarga",
                "accommodation" => "Mengharagai norma-norma pernikahan dan berkeluarga sebagai landasan bagi terciptanya kehidupan masyarakat yang harmonis",
                "action" => "Mengekspresikan keinginannya untuk mempelajari lebih intensif tentang norma pernikahan dan berkeluarga",
                "field_component_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "created_at" => round(microtime(true) * 1000),
                "updated_at" => null,
            ],
            [
                "id" => "ec7ccc3c-16f6-4fa6-a5e8-510f2636b082",
                "name" => "Kesadaran Tanggung Jawab Sosial",
                "introduction" => "Mempelajari keragaman interaksi sosial",
                "accommodation" => "Menyadari nilai-nilai persahabatan dan keharmonisan dalam konteks keragaman interaksi sosial",
                "action" => "Berinteraksi dengan orang lain atas dasar kesamaan",
                "field_component_id" => "a40879c0-7943-4b6e-9766-cfa0a2b64baa",
                "created_at" => round(microtime(true) * 1000),
                "updated_at" => null,
            ],
            [
                "id" => "9dea1b1f-6357-4aaf-b393-89f034c7ee48",
                "name" => "Kematangan Hubungan dengan Teman Sebaya",
                "introduction" => "Mempelajari cara-cara membina dan kerjasama dan toleransi dalam pergaulan dengan teman sebaya",
                "accommodation" => "Menghargai nilai-nilai kerjasama dan toleransi sebagai dasar untuk menjalin persahabatan dengan teman sebaya",
                "action" => "Mempererat jalinan persahabatan yang lebih akrab dengan memperhatikan norma yang berlaku",
                "field_component_id" => "a40879c0-7943-4b6e-9766-cfa0a2b64baa",
                "created_at" => round(microtime(true) * 1000),
                "updated_at" => null,
            ],
            [
                "id" => "3110ec6e-3757-49d4-8cf8-84c5239b2e5d",
                "name" => "Kesadaran Gender",
                "introduction" => "Mempelajari perilaku kolaborasi antar jenis dalam ragam kehidupan",
                "accommodation" => "Menghargai keragaman peraan laki-laki atau perempuan sebagai aset kolaborasi dan keharmonisan hidup",
                "action" => "Berkolaborasi secara harmonis dengan lain jenis dalam keragaman peran",
                "field_component_id" => "a40879c0-7943-4b6e-9766-cfa0a2b64baa",
                "created_at" => round(microtime(true) * 1000),
                "updated_at" => null,
            ],
            [
                "id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
                "name" => "Kematangan Intelektual",
                "introduction" => "Mempelajari cara-cara pengambilan keputusan dan pemecahan masalah secara objektif",
                "accommodation" => "Menyadari akan keragaman alternatif keputusan dan konsekuensi yang dihadapinya",
                "action" => "Mengambil keputusan dan pemecahan masalah atas dasar informasi/data secara obyektif",
                "field_component_id" => "b374344b-9e60-45b3-89c6-fe4d57220d58",
                "created_at" => round(microtime(true) * 1000),
                "updated_at" => null,
            ],
            [
                "id" => "d26c7621-ea85-4b94-96f5-7747ac4e90ed",
                "name" => "Perilaku Kewirausahaan/Kemandirian Perilaku Ekonomis",
                "introduction" => "Mempelajari strategi dan peluang untuk berperilaku hemat,ulet, sengguh-sungguh dan kompetitif dalam keragaman kehidupan",
                "accommodation" => "Menerima nilai-nilai hidup hemat,ulet sungguh-sungguh dan kompetitif sebagai aset untuk mencapai hidup mandiri",
                "action" => "Menampilkan hidup hemat, ulet, sungguh- sungguh dan kompetitif atas dasar kesadaran sendiri",
                "field_component_id" => "eeb613e4-4b46-4681-a28a-86f1a113237e",
                "created_at" => round(microtime(true) * 1000),
                "updated_at" => null,
            ],
            [
                "id" => "4aeb15f9-64e5-4e45-abfb-8bea715f1aca",
                "name" => "Wawasan dan Kesiapan Karir",
                "introduction" => "Mempelajari kemampuan diri, peluang dan ragam pekerjaan, pendidikan, dan aktifitas yang terfokus pada pengembangan alternatif karir yang lebih terarah",
                "accommodation" => "Internalisasi nilai- niolai yang melandasi pertimbangan pemilihan alternatif karir",
                "action" => "Mengembangkan alternatif perencanaan karir dengan mempertimbangkan kemampuan, peluang dan ragam karir",
                "field_component_id" => "eeb613e4-4b46-4681-a28a-86f1a113237e",
                "created_at" => round(microtime(true) * 1000),
                "updated_at" => null,
            ],
        ]);
    }
}
