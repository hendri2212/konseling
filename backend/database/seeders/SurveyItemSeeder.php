<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SurveyItem;

class SurveyItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "id" => "2ed1f816-390c-4e0c-9b39-2cdac785b519",
                "question" => "Saya merasa belum disiplin dalam beribadah pada Tuhan YME",
                "order" => 1,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            [
                "id" => "90c7bcfa-3464-46ad-befa-74e381f3590d",
                "question" => "Saya kadang-kadang berperilaku dan bertutur kata tidak jujur",
                "order" => 2,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            [
                "id" => "2f5c0b7f-9067-4e88-9f1a-6bd29e5c5128",
                "question" => "Saya kadang-kadang masih suka menyontek pada waktu tes",
                "order" => 3,
                "service_strategy" => "kelompok",
                "created_at" => round(microtime(true) * 1000),
            ],
            [
                "id" => "2e2a5062-7845-4861-8268-5e5ab424a809",
                "question" => "Saya merasa belum bisa mengendalikan emosi dengan baik",
                "order" => 4,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            [
                "id" => "c305e465-5ac5-4c4f-b2c1-bce287eda28b",
                "question" => "Saya belum paham tentang sikap dan perilaku asertif",
                "order" => 5,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            [
                "id" => "491a00de-aeb1-477f-a25d-5fdfad38efd9",
                "question" => "Saya belum tahu cara mengenal dan memahami diri sendiri",
                "order" => 6,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            [
                "id" => "9b2e6821-cff3-4829-a293-d0ac46ae7960",
                "question" => "Saya belum memahami potensi diri",
                "order" => 7,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            [
                "id" => "b2f85d2f-0212-4781-9529-3e1e75dbf719",
                "question" => "Saya belum tahu perubahan dan permasalahan yang terjadi pada masa remaja",
                "order" => 8,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            //9
            [
                "id" => "708cd860-cb08-495a-9a97-e5fd1ed18a30",
                "question" => "Saya belum mengenal tentang macam-macam kepribadian",
                "order" => 9,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            //10
            [
                "id" => "b4fd04aa-3c06-4015-8aa5-02f667be2a9f",
                "question" => "Saya kurang memiliki rasa percaya diri",
                "order" => 10,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            //11
            [
                "id" => "49ac98b1-afac-4b88-95fe-2c190ca3d7d4",
                "question" => "Saya kadang kurang menjaga kesehatan diri",
                "order" => 11,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            //12
            [
                "id" => "5605e638-a75b-4d92-800a-27e166834dd0",
                "question" => "Saya belum tahu ciri-ciri/sifat/prilaku pribadi yang berkarakter",
                "order" => 12,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            //13
            [
                "id" => "6693c485-2cad-496c-bbdb-bd7ffc63716e",
                "question" => "Saya merasa kurang memilki tanggung jawab  pada diri sendiri",
                "order" => 13,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //14
            [
                "id" => "e3d3763e-6986-4487-83b0-c245fba16699",
                "question" => "Saya kesulitan mengatur waktu belajar dan bermain",
                "order" => 14,
                "service_strategy" => "kelompok",
                "created_at" => round(microtime(true) * 1000),
            ],
            //15
            [
                "id" => "c11a3b3a-3784-4f1a-a341-4685474f028d",
                "question" => "Kondisi orang tua saya sedang tidak harmonis",
                "order" => 15,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //16
            [
                "id" => "c75069d1-ac34-4f1c-8915-6593c9106177",
                "question" => "Saya merasa tidak betah tinggal di rumah sendiri",
                "order" => 16,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //17
            [
                "id" => "41f9d69b-e4ad-4838-a55f-bd57035d5e41",
                "question" => "Saya mempunyai masalah dengan anggota keluarga di rumah",
                "order" => 17,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //18
            [
                "id" => "9e228033-e526-4c65-923b-c7d3c2402efa",
                "question" => "Saya belum bisa menjadi pribadi yang mandiri",
                "order" => 18,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //19
            [
                "id" => "7bd65c11-1648-49a7-bc96-1faa4aebfe35",
                "question" => "Saya belum memahami tentang norma/cara membangun  berkeluarga",
                "order" => 19,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //20
            [
                "id" => "b1263bbb-f648-4387-a476-898f4d0603e8",
                "question" => "Saya sedang memiliki konflik pribadi",
                "order" => 20,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //21
            [
                "id" => "57568c9c-41d6-4586-8daf-d023cd26b66a",
                "question" => "Saya belum banyak mengenal lingkungan sekolah baru",
                "order" => 21,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            //22
            [
                "id" => "24a17919-28ac-42c4-8865-325f05ea4e09",
                "question" => "Saya belum memahami tentang kenakalan remaja",
                "order" => 22,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            //23
            [
                "id" => "be7b07a6-238d-4ad0-aa5e-205758af2d3e",
                "question" => "Saya masih sedikit mengetahui tentang dampak atau bahaya rokok",
                "order" => 23,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            //24
            [
                "id" => "b5d7d91f-b6ca-4ee8-aedf-7b991564dd5b",
                "question" => "Saya belum banyak mengenal tentang perilaku sosial yang bertanggung jawab",
                "order" => 24,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            //25
            [
                "id" => "c18f0995-38a5-4c04-a4d3-da9329383d25",
                "question" => "Saya belum tahu tentang bullying dan cara mensikapinya",
                "order" => 25,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            //26
            [
                "id" => "d02fe506-1005-4c3a-8027-55e302715b4d",
                "question" => "Saya sukar bergaul dengan teman-teman di sekolah",
                "order" => 26,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            //27
            [
                "id" => "ae69e788-2f6b-441c-b251-554592363b77",
                "question" => "Sering saya dianggap tidak sopan pada orang lain",
                "order" => 27,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            //28
            [
                "id" => "ea2dee21-5ba1-4883-9f44-46d146389240",
                "question" => "Saya kurang memahami dampak dari media sosial",
                "order" => 28,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            //29
            [
                "id" => "f053c86d-ed6e-4f4c-9091-bcda8cbe060a",
                "question" => "Saya jarang bermain/berteman di lingkungan tempat saya tinggal",
                "order" => 29,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //30
            [
                "id" => "94b4cc73-3b08-44df-882a-3a7864bbf939",
                "question" => "Saya belum banyak teman atau sahabat",
                "order" => 30,
                "service_strategy" => "kelompok",
                "created_at" => round(microtime(true) * 1000),
            ],
            //31
            [
                "id" => "2495c1d3-93c9-4730-8aef-fb73e4536c82",
                "question" => "Saya kurang suka  berkomunikasi dengan teman lawan jenis",
                "order" => 31,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //32
            [
                "id" => "4249a6f8-4c7a-4a15-9947-678db0a9e823",
                "question" => "Saya belum tahu cara belajar yang baik dan benar di SMK/MAK",
                "order" => 32,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            //33
            [
                "id" => "4d308107-d4a1-4e65-87c1-3795879135d7",
                "question" => "Saya belum tahu cara meraih prestasi di sekolah",
                "order" => 33,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            //34
            [
                "id" => "944530a8-1f78-4783-925c-9c9a37246356",
                "question" => "Saya belum paham tentang gaya belajar dan strategi yang sesuai dengannya",
                "order" => 34,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],
            //35
            [
                "id" => "5ade17f5-e0f5-411c-8039-c1901cdc39f5",
                "question" => "Orang tua saya tidak peduli dengan kegiatan belajar saya",
                "order" => 35,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //36
            [
                "id" => "e7cbdae9-ce39-4472-97fb-9c8e55b8de2a",
                "question" => "Saya masih sering menunda-nunda tugas sekolah/pekerjaan rumah (PR)",
                "order" => 36,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //37
            [
                "id" => "7cb0b518-5e97-43dc-83e8-0c4889621c1f",
                "question" => "Saya merasa kesulitan dalam memahami pelajaran tertentu",
                "order" => 37,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //38
            [
                "id" => "7a1ffca4-7fa4-4b8f-9923-6aa0f672d723",
                "question" => "Saya belum tahu cara memanfaatkan sumber belajar",
                "order" => 38,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //39
            [
                "id" => "b696a51a-4fcf-4af1-8e20-d64b7a34257e",
                "question" => "Saya belajarnya jika akan ada tes  atau ujian saja",
                "order" => 39,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //40
            [
                "id" => "e681d9c2-89ff-4307-a382-556941075c76",
                "question" => "Saya belum tahu tentang struktur kurikulum yang ada di sekolah",
                "order" => 40,
                "service_strategy" => "lintas_kelas",
                "created_at" => round(microtime(true) * 1000),
            ],
            //41
            [
                "id" => "04827ba5-09b1-4ad0-b825-08e719a0676a",
                "question" => "Saya merasa malas belajar dan kalau belajar sering ngantuk",
                "order" => 41,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //42
            [
                "id" => "7e21bee2-6dc2-4d63-be2e-3b9290afdaed",
                "question" => "Saya belum terbiasa belajar bersama atau belajar kelompok",
                "order" => 42,
                "service_strategy" => "kelompok",
                "created_at" => round(microtime(true) * 1000),
            ],
            //43
            [
                "id" => "f647721f-421d-4737-95ce-32afcf91e8e8",
                "question" => "Saya belum paham cara memilih lembaga bimbingan belajar yang baik",
                "order" => 43,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //44
            [
                "id" => "241b79e3-8eee-402c-b5c6-8e69214b07a9",
                "question" => "Saya belum dapat memanfaatkan teknologi informasi untuk belajar",
                "order" => 44,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //45
            [
                "id" => "0e7b4866-f755-49cb-8ee6-3c7a924e49b2",
                "question" => "Saya belum tahu cara memperoleh bantuan pendidikan (beastudents)",
                "order" => 45,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //46
            [
                "id" => "eb4c5c5b-492f-4a05-be5a-14f12155e941",
                "question" => "Saya terpaksa harus bekerja untuk mencukupi kebutuhan hidup",
                "order" => 46,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //47
            [
                "id" => "8590f607-f1a4-492b-ba99-ec7acefd361b",
                "question" => "Saya merasa bingung memilih kegiatan esktrakurikuler di sekolah",
                "order" => 47,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //48
            [
                "id" => "54bcdb3f-896a-496e-83ba-d7596857e2b3",
                "question" => "Saya merasa belum mantap pada pilihan peminatan yang diambil",
                "order" => 48,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //49
            [
                "id" => "bebc078d-96d9-4faa-8c13-559ced28268f",
                "question" => "Saya merasa belum paham hubungan antara hobi, bakat, minat, kemampuan dan karir",
                "order" => 49,
                "service_strategy" => "individual",
                "created_at" => round(microtime(true) * 1000),
            ],
            //50
            [
                "id" => "d950d832-71cc-4b1c-aaff-b0eabb17765d",
                "question" => "Saya belum memiliki perencanaan karir masa depan",
                "order" => 50,
                "service_strategy" => "klasikal",
                "created_at" => round(microtime(true) * 1000),
            ],

        ];

        for ($i = 0; $i < count($data); $i++) {
            $insert = new SurveyItem;
            $insert->id                 = $data[$i]['id'];
            $insert->question               = $data[$i]['question'];
            $insert->order               = $data[$i]['order'];
            $insert->service_strategy               = $data[$i]['service_strategy'];
            $insert->created_at               = $data[$i]['created_at'];
            $insert->save();
        }
    }
}
