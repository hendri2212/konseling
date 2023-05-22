<?php

namespace Database\Seeders;

use App\Models\RequirementFormulation;
use Illuminate\Database\Seeder;

class RequirementFormulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RequirementFormulation::insert([
            //1
            [
                "id" => "0b5e8c70-890b-4bec-892d-f9889287abfd",
                "name" => "Kesadaran untuk beriman dan bertakwa pada Tuhan YME",
                "service_objective" => "Saya merasa belum disiplin dalam beribadah pada Tuhan YME",
                "topic_id" => "cae31f73-f13a-4601-b508-dfc92a32695d",
                "skkpd_id" => "84e29080-1481-404d-92a1-c223e082b22b",
                "created_at" => round(microtime(true) * 1000),
            ],
            //2
            [
                "id" => "3b71b8a7-8fbb-4b53-9a24-f87e19c6f879",
                "name" => "Kebiasaan bersikap jujur",
                "service_objective" => "Saya kadang-kadang berperilaku dan bertutur kata tidak jujur",
                "topic_id" => "a57adcf8-fcf0-4112-9d9b-f8a0742f750c",
                "skkpd_id" => "d0bcd559-581e-4bd5-8751-c7ec6a3e2dc7",
                "created_at" => round(microtime(true) * 1000),
            ],
            //3
            [
                "id" => "13d6bab1-e60b-46ef-ba0c-c2e141a737df",
                "name" => "Kemampuan memiliki kebiasaan jujur dan tidak mencontek saat tes",
                "service_objective" => "Saya kadang-kadang masih suka menyontek pada waktu tes",
                "topic_id" => "a3203adc-7701-4dab-9f59-c41ec670b042",
                "skkpd_id" => "d0bcd559-581e-4bd5-8751-c7ec6a3e2dc7",
                "created_at" => round(microtime(true) * 1000),
            ],
            //4
            [
                "id" => "5f99f3e6-00aa-4abb-b4f6-7546826ed5a0",
                "name" => "Kemampuan mengelola emosi dengan baik",
                "service_objective" => "Saya merasa belum bisa mengendalikan emosi dengan baik",
                "topic_id" => "40a9f7f3-d656-4cf8-85b9-31ed59277074",
                "skkpd_id" => "a19ac4d2-30b9-49bf-b57c-0ffdab7d50ab",
                "created_at" => round(microtime(true) * 1000),
            ],
            //5
            [
                "id" => "b26980d2-d735-4cc7-a6e9-bb157ad93c85",
                "name" => "Komunikasi yang jujur dan tetap menjaga perasaan",
                "service_objective" => "Saya belum paham tentang sikap dan perilaku asertif",
                "topic_id" => "50909b92-0201-4ddb-b2d4-64f073991829",
                "skkpd_id" => "a19ac4d2-30b9-49bf-b57c-0ffdab7d50ab",
                "created_at" => round(microtime(true) * 1000),
            ],
            //6
            [
                "id" => "b975d753-1915-4009-87ea-443ccd2b4368",
                "name" => "Melakukan pengenalan/pemahaman diri",
                "service_objective" => "Saya belum tahu cara mengenal dan memahami diri sendiri",
                "topic_id" => "e19e3b53-00de-4349-9320-e9e679059a3d",
                "skkpd_id" => "27729beb-8071-4b41-876f-906999baa426",
                "created_at" => round(microtime(true) * 1000),
            ],
            //7
            [
                "id" => "bbbf2c32-40c5-4d8e-b36d-95b7e3bea8a0",
                "name" => "Memahami potensi diri",
                "service_objective" => "Saya belum memahami potensi diri",
                "topic_id" => "3c88a868-a72e-4098-b712-b22e200a6307",
                "skkpd_id" => "27729beb-8071-4b41-876f-906999baa426",
                "created_at" => round(microtime(true) * 1000),
            ],
            //8
            [
                "id" => "47b51de6-8e42-4dfd-9a19-5fde329df847",
                "name" => "Masa perkembangan remaja dan permasalahannya",
                "service_objective" => "Saya belum tahu perubahan dan permasalahan yang terjadi pada masa remaja",
                "topic_id" => "b9bbce5c-2c3f-48f2-a7e2-70994d4c36ea",
                "skkpd_id" => "27729beb-8071-4b41-876f-906999baa426",
                "created_at" => round(microtime(true) * 1000),
            ],
            //9
            [
                "id" => "1f573154-2ab0-46a0-b848-7d85ca0a6d03",
                "name" => "Mengenal kepribadian yang dimiliki manusia",
                "service_objective" => "Saya belum mengenal tentang macam-macam kepribadian",
                "topic_id" => "a850c50a-b823-4280-bdcf-946f681fed1c",
                "skkpd_id" => "27729beb-8071-4b41-876f-906999baa426",
                "created_at" => round(microtime(true) * 1000),
            ],
            //10
            [
                "id" => "222d6ef3-f55a-46ce-ad78-9774b0a0079f",
                "name" => "Memiliki kepercayaan diri ",
                "service_objective" => "Saya kurang memiliki rasa percaya diri",
                "topic_id" => "34cb7322-2eb6-4b0c-88ab-e008fc82f5d2",
                "skkpd_id" => "27729beb-8071-4b41-876f-906999baa426",
                "created_at" => round(microtime(true) * 1000),
            ],
            //11
            [
                "id" => "d3c515ba-89bc-4dd1-bec1-5a9b4e54d266",
                "name" => "Kemampuan menjaga kesehatan dengan baik",
                "service_objective" => "Saya kadang kurang menjaga kesehatan diri",
                "topic_id" => "a87bb85a-980d-40d5-b663-5c13d0e603e3",
                "skkpd_id" => "27729beb-8071-4b41-876f-906999baa426",
                "created_at" => round(microtime(true) * 1000),
            ],
            //12
            [
                "id" => "ef7b8043-bef1-428b-b034-7c23656b7099",
                "name" => "Memiliki ciri-ciri/sifat pribadi yang berkarakter",
                "service_objective" => "Saya belum tahu ciri-ciri/sifat/prilaku pribadi yang berkarakter",
                "topic_id" => "d1e7ea6b-61f0-4809-9a80-cae5f5a052f2",
                "skkpd_id" => "27729beb-8071-4b41-876f-906999baa426",
                "created_at" => round(microtime(true) * 1000),
            ],
            //13
            [
                "id" => "f5db6696-c592-4669-8b2f-ff46a7165a30",
                "name" => "Memiliki rasa tanggung jawab",
                "service_objective" => "Saya merasa kurang memilki tanggung jawab  pada diri sendiri",
                "topic_id" => "eb3e7bd2-61f8-4cee-80f2-81070dafa81b",
                "skkpd_id" => "27729beb-8071-4b41-876f-906999baa426",
                "created_at" => round(microtime(true) * 1000),
            ],
            //14
            [
                "id" => "7bd99bd7-d6b6-4c25-a926-3e53c4ebc0c8",
                "name" => "Mengatur jadwal kegiatan sehari-hari ",
                "service_objective" => "Saya kesulitan mengatur waktu belajar dan bermain",
                "topic_id" => "ac8fe989-1b1c-4257-9cbb-d53e6c8dc72a",
                "skkpd_id" => "27729beb-8071-4b41-876f-906999baa426",
                "created_at" => round(microtime(true) * 1000),
            ],
            //15
            [
                "id" => "ec732542-35e4-46b7-90e9-bd2f6d0f849c",
                "name" => "Memiliki keluarga yang harmonis",
                "service_objective" => "Kondisi orang tua saya sedang tidak harmonis",
                "topic_id" => "ea18fc46-3a8d-4628-9fad-280e32d52730",
                "skkpd_id" => "27729beb-8071-4b41-876f-906999baa426",
                "created_at" => round(microtime(true) * 1000),
            ],
            //16
            [
                "id" => "3fe4a9c4-0add-420f-8e6c-bbe27c6689b6",
                "name" => "Merasa nyaman,aman tinggal di rumah sendiri",
                "service_objective" => "Saya merasa tidak betah tinggal di rumah sendiri",
                "topic_id" => "5251752f-4813-48b5-a82a-b036c53583e3",
                "skkpd_id" => "27729beb-8071-4b41-876f-906999baa426",
                "created_at" => round(microtime(true) * 1000),
            ],
            //17
            [
                "id" => "9e9157d9-673c-495a-a8d3-832297d1c9b7",
                "name" => "Mampu menyelesaikan masalah dengan kekeluargaan",
                "service_objective" => "Saya mempunyai masalah dengan anggota keluarga di rumah",
                "topic_id" => "cc743347-96b6-4d04-afc5-b59f054f83d9",
                "skkpd_id" => "27729beb-8071-4b41-876f-906999baa426",
                "created_at" => round(microtime(true) * 1000),
            ],
            //18
            [
                "id" => "6a567632-1120-4c9e-acce-92f2df0d737e",
                "name" => "Menjadi pribadi yang mandiri",
                "service_objective" => "Saya belum bisa menjadi pribadi yang mandiri",
                "topic_id" => "7591a443-cae4-483b-abc3-8c3e5ea01873",
                "skkpd_id" => "27729beb-8071-4b41-876f-906999baa426",
                "created_at" => round(microtime(true) * 1000),
            ],
            //19
            [
                "id" => "ce8d0f37-3517-4438-a647-f2ca316d1302",
                "name" => "Mampu menyelesaikan konflik pribadi",
                "service_objective" => "Saya belum memahami tentang norma/cara membangun  berkeluarga",
                "topic_id" => "17e684c1-5ba8-4f3a-91dd-78cc5d13ef5c",
                "skkpd_id" => "27729beb-8071-4b41-876f-906999baa426",
                "created_at" => round(microtime(true) * 1000),
            ],
            //20
            [
                "id" => "ce725bf2-af6a-4d81-8a8d-228b94d1a471",
                "name" => "Memiliki pengetahuan tentang norma berkeluarga",
                "service_objective" => "Saya sedang memiliki konflik pribadi",
                "topic_id" => "078643b3-79db-4659-a767-56753dbe8292",
                "skkpd_id" => "a214ff4e-a945-43b9-977b-29ebba8080d5",
                "created_at" => round(microtime(true) * 1000),
            ],
            //21
            [
                "id" => "f37d3ce1-bf0c-4e33-a246-edf258839c85",
                "name" => "Mengenal lingkungan sekolah baru",
                "service_objective" => "Saya belum banyak mengenal lingkungan sekolah baru",
                "topic_id" => "7c150e19-5f4c-4318-b043-4190e753efc4",
                "skkpd_id" => "ec7ccc3c-16f6-4fa6-a5e8-510f2636b082",
                "created_at" => round(microtime(true) * 1000),
            ],
            //22
            [
                "id" => "b9197ebc-fbec-4c8e-a414-ee32251416dd",
                "name" => "Memiliki pemahaman tentang kenakalan remaja",
                "service_objective" => "Saya belum memahami tentang kenakalan remaja",
                "topic_id" => "570e587c-cfc1-4d1d-844b-29aa9aa2a944",
                "skkpd_id" => "ec7ccc3c-16f6-4fa6-a5e8-510f2636b082",
                "created_at" => round(microtime(true) * 1000),
            ],
            //23
            [
                "id" => "47cdbd37-5a5d-4d89-98df-8e1cc1221630",
                "name" => "Memiliki pemahaman tentang bahaya rokok",
                "service_objective" => "Saya masih sedikit mengetahui tentang dampak atau bahaya rokok",
                "topic_id" => "550d8ff6-318e-4e58-a11e-23cfbb060132",
                "skkpd_id" => "ec7ccc3c-16f6-4fa6-a5e8-510f2636b082",
                "created_at" => round(microtime(true) * 1000),
            ],
            //24
            [
                "id" => "79f2e0d5-1031-42f6-8821-a50053e5e955",
                "name" => "Memiliki perilaku sosial yang bertanggung jawab",
                "service_objective" => "Saya belum banyak mengenal tentang perilaku sosial yang bertanggung jawab",
                "topic_id" => "780691fb-7365-4a27-8e46-d784b5ad22ed",
                "skkpd_id" => "ec7ccc3c-16f6-4fa6-a5e8-510f2636b082",
                "created_at" => round(microtime(true) * 1000),
            ],
            //25
            [
                "id" => "12de6a56-deb5-447c-bd1f-f72a87841a96",
                "name" => "Memahami tentang bullying",
                "service_objective" => "Saya belum tahu tentang bullying dan cara mensikapinya",
                "topic_id" => "102851fb-9780-4129-abbc-5e3f5edab138",
                "skkpd_id" => "9dea1b1f-6357-4aaf-b393-89f034c7ee48",
                "created_at" => round(microtime(true) * 1000),
            ],
            //26
            [
                "id" => "4f5083d0-9420-49ce-9323-4ddb2e93e5b0",
                "name" => "Memiliki etika bergaul dengan teman sebaya",
                "service_objective" => "Saya sukar bergaul dengan teman-teman di sekolah",
                "topic_id" => "4e803a89-f816-4c17-8645-42c61abc7276",
                "skkpd_id" => "9dea1b1f-6357-4aaf-b393-89f034c7ee48",
                "created_at" => round(microtime(true) * 1000),
            ],
            //27
            [
                "id" => "7f080cb6-7daa-4803-8128-3059c667aa1d",
                "name" => "Memiliki sikap sopan santun pada orang lain",
                "service_objective" => "Sering saya dianggap tidak sopan pada orang lain",
                "topic_id" => "c1616597-5216-44e6-a533-258d29bb7a54",
                "skkpd_id" => "9dea1b1f-6357-4aaf-b393-89f034c7ee48",
                "created_at" => round(microtime(true) * 1000),
            ],
            //28
            [
                "id" => "a938ccae-1e0b-4078-a6d2-ff91b8a0f34f",
                "name" => "Memiliki pemahaman tentang dampak dari media sosial",
                "service_objective" => "Saya kurang memahami dampak dari media sosial",
                "topic_id" => "bdeb5ccd-cb78-4de5-a7c4-a93dc1fe9f62",
                "skkpd_id" => "9dea1b1f-6357-4aaf-b393-89f034c7ee48",
                "created_at" => round(microtime(true) * 1000),
            ],
            //29
            [
                "id" => "8105feb5-3732-4211-a1f0-02cf7266c82c",
                "name" => "Kesadaran sebagai makhluk sosial yang harus berinteraksi",
                "service_objective" => "Saya jarang bermain/berteman di lingkungan tempat saya tinggal",
                "topic_id" => "b258cd7c-930a-4f74-8b0b-085816a638c8",
                "skkpd_id" => "9dea1b1f-6357-4aaf-b393-89f034c7ee48",
                "created_at" => round(microtime(true) * 1000),
            ],
            //30
            [
                "id" => "5d2c6f62-2e3d-4ed8-badb-feb49b2c39bb",
                "name" => "Kemudahan mencari dan disenangi teman",
                "service_objective" => "Saya belum banyak teman atau sahabat",
                "topic_id" => "376c9f86-acc1-4e40-8e5a-1a5b1a2e32f1",
                "skkpd_id" => "9dea1b1f-6357-4aaf-b393-89f034c7ee48",
                "created_at" => round(microtime(true) * 1000),
            ],
            //31
            [
                "id" => "9895153d-6031-4ee6-9ea2-271dd0d94310",
                "name" => "Memiliki pemahaman tentang hubungan komunikasi dengan lawan jenis",
                "service_objective" => "Saya kurang suka  berkomunikasi dengan teman lawan jenis",
                "topic_id" => "aa28ac1c-9c29-49a4-ba5a-781b55945f31",
                "skkpd_id" => "3110ec6e-3757-49d4-8cf8-84c5239b2e5d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //32
            [
                "id" => "ec5c7775-24fc-47ac-bfc1-811edec4619d",
                "name" => "Memahami belajar yang benar di SMK/MAK",
                "service_objective" => "Saya belum tahu cara belajar yang baik dan benar di SMK/MAK",
                "topic_id" => "ce8166d8-4eb7-444b-b105-2184248916f4",
                "skkpd_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
                "created_at" => round(microtime(true) * 1000),
            ],
            //33
            [
                "id" => "000a7965-dab7-4f42-a154-81e124c655af",
                "name" => "Memiliki motivasi untuk berprestasi",
                "service_objective" => "Saya belum tahu cara meraih prestasi di sekolah",
                "topic_id" => "8668900e-8e65-4009-8916-59b8b0083b0e",
                "skkpd_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
                "created_at" => round(microtime(true) * 1000),
            ],
            //34
            [
                "id" => "283b3b53-dc73-4b34-9378-265edbdfc4c3",
                "name" => "Menemukan cara belajar yang sesuai dengan gaya belajar",
                "service_objective" => "Saya belum paham tentang gaya belajar dan strategi yang sesuai dengannya",
                "topic_id" => "539158b5-eb4d-4d7c-8df2-556d18e05481",
                "skkpd_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
                "created_at" => round(microtime(true) * 1000),
            ],
            //35
            [
                "id" => "13171a0d-9bfb-4550-a642-d40c57f36af2",
                "name" => "Kepedulian orang tua pada kegiatan belajar",
                "service_objective" => "Orang tua saya tidak peduli dengan kegiatan belajar saya",
                "topic_id" => "75544ccd-4bad-41cb-8c44-3fd40e9f4faa",
                "skkpd_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
                "created_at" => round(microtime(true) * 1000),
            ],
            //36
            [
                "id" => "d1e25262-32e6-4405-9ccb-e7067ee48430",
                "name" => "Melaksanakan Tugas Sekolah / PR tepat waktu",
                "service_objective" => "Saya masih sering menunda-nunda tugas sekolah/pekerjaan rumah (PR)",
                "topic_id" => "6aadc5ea-c4da-4e87-a2e6-bdf2050e3ffb",
                "skkpd_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
                "created_at" => round(microtime(true) * 1000),
            ],
            //37
            [
                "id" => "e0598880-acd4-40d9-ae7a-0746d105f30a",
                "name" => "Mudah memahami pelajaran",
                "service_objective" => "Saya merasa kesulitan dalam memahami pelajaran tertentu",
                "topic_id" => "e1d2a9a0-8cc9-4334-86ed-012b0c090adf",
                "skkpd_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
                "created_at" => round(microtime(true) * 1000),
            ],
            //38
            [
                "id" => "806022ae-1adc-4bab-8f19-e049d22c4bb9",
                "name" => "Mampu memanfaatkan sumber belajar",
                "service_objective" => "Saya belum tahu cara memanfaatkan sumber belajar",
                "topic_id" => "4efbe505-cabf-47aa-9161-4bdea63d0da4",
                "skkpd_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
                "created_at" => round(microtime(true) * 1000),
            ],
            //39
            [
                "id" => "a428ce52-0994-4a43-9cc3-f64167b32e2e",
                "name" => "Kesadaran belajar sesuai jadwal",
                "service_objective" => "Saya belajarnya jika akan ada tes atau ujian saja",
                "topic_id" => "84c564b2-6b33-4172-8a74-3567cc1d97d6",
                "skkpd_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
                "created_at" => round(microtime(true) * 1000),
            ],
            //40
            [
                "id" => "0e5acca5-00f6-44c7-864c-638fa5e650a6",
                "name" => "Memahami struktur kurikulum sekolah",
                "service_objective" => "Saya belum tahu tentang struktur kurikulum yang ada di sekolah",
                "topic_id" => "eef0f5bd-2cc5-4ea4-b7e1-54e8fbdbe3b0",
                "skkpd_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
                "created_at" => round(microtime(true) * 1000),
            ],
            //41
            [
                "id" => "2777738e-4e45-4d92-81de-eba651762ce5",
                "name" => "Memiliki semangat belajar",
                "service_objective" => "Saya merasa malas belajar dan kalau belajar sering ngantuk",
                "topic_id" => "4c30d517-4a17-4191-99f0-042b56419f96",
                "skkpd_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
                "created_at" => round(microtime(true) * 1000),
            ],
            //42
            [
                "id" => "d2a59f24-66e6-4391-87ff-b54183e0cfe7",
                "name" => "Membentuk belajar kelompok",
                "service_objective" => "Saya belum terbiasa belajar bersama atau belajar kelompok",
                "topic_id" => "816c2f4d-24ee-4773-8ff8-c790635262d7",
                "skkpd_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
                "created_at" => round(microtime(true) * 1000),
            ],
            //43
            [
                "id" => "ab4b005a-48a2-448c-a131-4dad8c778ffa",
                "name" => "Mengetahui cara memilih lembaga bimbel yang baik",
                "service_objective" => "Saya belum paham cara memilih lembaga bimbingan belajar yang baik",
                "topic_id" => "fc5ac799-01f7-4697-84b1-4ae3cc6cb195",
                "skkpd_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
                "created_at" => round(microtime(true) * 1000),
            ],
            //44
            [
                "id" => "93b82ed8-1e5c-44e7-814f-2873c239547a",
                "name" => "Pemanfaatan perkembangan teknologi informasi",
                "service_objective" => "Saya belum dapat memanfaatkan teknologi informasi untuk belajar",
                "topic_id" => "2152ae6c-bd96-4273-a480-897c2c839ddc",
                "skkpd_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
                "created_at" => round(microtime(true) * 1000),
            ],
            //45
            [
                "id" => "1d5f16fa-ce7a-4830-a0e8-6a38025c1a46",
                "name" => "Memperoleh informasi bantuan/beasiswa",
                "service_objective" => "Saya belum tahu cara memperoleh bantuan pendidikan (beastudents)",
                "topic_id" => "3ad0cdbf-8b58-415b-8ade-10d971636506",
                "skkpd_id" => "d26c7621-ea85-4b94-96f5-7747ac4e90ed",
                "created_at" => round(microtime(true) * 1000),
            ],
            //46
            [
                "id" => "969a1ab5-667d-4982-94ea-3adf5d5965e8",
                "name" => "Memperoleh penghasilan untuk biaya hidup",
                "service_objective" => "Saya terpaksa harus bekerja untuk mencukupi kebutuhan hidup",
                "topic_id" => "7ad6ff09-b9ee-409a-b961-4ba3715cf12b",
                "skkpd_id" => "d26c7621-ea85-4b94-96f5-7747ac4e90ed",
                "created_at" => round(microtime(true) * 1000),
            ],
            //47
            [
                "id" => "a52e541d-004d-4696-9b11-c16e4cd3f25e",
                "name" => "Memiliki kemampuan untuk memilih kegiatan ekstra kurikuler",
                "service_objective" => "Saya merasa bingung memilih kegiatan esktrakurikuler di sekolah",
                "topic_id" => "97114279-2ba8-4301-8a48-13fd820ef20f",
                "skkpd_id" => "4aeb15f9-64e5-4e45-abfb-8bea715f1aca",
                "created_at" => round(microtime(true) * 1000),
            ],
            //48
            [
                "id" => "4d246405-ea43-41e6-b7d2-92cbe9cc26ca",
                "name" => "Memiliki kemantapan  pada pilihan peminatan yang diambil",
                "service_objective" => "Saya merasa belum mantap pada pilihan peminatan yang diambil",
                "topic_id" => "9d98815a-e7d7-4327-84ea-6db1c2cd112c",
                "skkpd_id" => "4aeb15f9-64e5-4e45-abfb-8bea715f1aca",
                "created_at" => round(microtime(true) * 1000),
            ],
            //49
            [
                "id" => "c0347041-5a71-48e4-a8e8-c5607464679d",
                "name" => "Memahami hubungan hobi, bakat, minat, kemampuan dan karir",
                "service_objective" => "Saya merasa belum paham hubungan antara hobi, bakat, minat, kemampuan dan karir",
                "topic_id" => "b7b8bb79-fe0a-4239-870c-966169ae547f",
                "skkpd_id" => "4aeb15f9-64e5-4e45-abfb-8bea715f1aca",
                "created_at" => round(microtime(true) * 1000),
            ],
            //50
            [
                "id" => "32b84b11-2995-43e5-94fd-1805cca96286",
                "name" => "Memiliki perencanaan karir yang baik",
                "service_objective" => "Saya belum memiliki perencanaan karir masa depan",
                "topic_id" => "c0e2adf2-f2fc-4992-aa07-8a8a9d08364c",
                "skkpd_id" => "4aeb15f9-64e5-4e45-abfb-8bea715f1aca",
                "created_at" => round(microtime(true) * 1000),
            ],
        ]);
    }
}
