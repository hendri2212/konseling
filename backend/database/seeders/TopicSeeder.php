<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::insert([
            //1
            [
                "id" => "cae31f73-f13a-4601-b508-dfc92a32695d",
                "name" => "Implementasi Iman dan Taqwa dalam kehidupan modern",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //2
            [
                "id" => "a57adcf8-fcf0-4112-9d9b-f8a0742f750c",
                "name" => "Kejujuran dan Integritas",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //3
            [
                "id" => "a3203adc-7701-4dab-9f59-c41ec670b042",
                "name" => "Kebiasaan mencontek dan akibatnya",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //4
            [
                "id" => "40a9f7f3-d656-4cf8-85b9-31ed59277074",
                "name" => "Mengelola emosi dengan baik",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //5
            [
                "id" => "50909b92-0201-4ddb-b2d4-64f073991829",
                "name" => "Sikap dan Perilaku Asertif",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //6
            [
                "id" => "e19e3b53-00de-4349-9320-e9e679059a3d",
                "name" => "Konsep diri remaja",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //7
            [
                "id" => "3c88a868-a72e-4098-b712-b22e200a6307",
                "name" => "Potensi diri remaja",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //8
            [
                "id" => "b9bbce5c-2c3f-48f2-a7e2-70994d4c36ea",
                "name" => "Psikologi remaja dan permasalahannya",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //9
            [
                "id" => "a850c50a-b823-4280-bdcf-946f681fed1c",
                "name" => "Kepribadian Manusia",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //10
            [
                "id" => "34cb7322-2eb6-4b0c-88ab-e008fc82f5d2",
                "name" => "Membangun Rasa Percaya Diri",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //11
            [
                "id" => "a87bb85a-980d-40d5-b663-5c13d0e603e3",
                "name" => "Pola Hidup Bersih dan Sehat",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //12
            [
                "id" => "d1e7ea6b-61f0-4809-9a80-cae5f5a052f2",
                "name" => "Menjadi pribadi yang berkarakter",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //13
            [
                "id" => "eb3e7bd2-61f8-4cee-80f2-81070dafa81b",
                "name" => "Rasa tanggung jawab",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //14
            [
                "id" => "ac8fe989-1b1c-4257-9cbb-d53e6c8dc72a",
                "name" => "Mengatur jadwal kegiatan sehari-hari",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //15
            [
                "id" => "ea18fc46-3a8d-4628-9fad-280e32d52730",
                "name" => "Keluarga yang harmonis",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //16
            [
                "id" => "5251752f-4813-48b5-a82a-b036c53583e3",
                "name" => "Rumahku surgaku",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //17
            [
                "id" => "cc743347-96b6-4d04-afc5-b59f054f83d9",
                "name" => "Mengatasi masalah dengan anggota keluarga",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //18
            [
                "id" => "7591a443-cae4-483b-abc3-8c3e5ea01873",
                "name" => "Menjadi pribadi mandiri",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //19
            [
                "id" => "17e684c1-5ba8-4f3a-91dd-78cc5d13ef5c",
                "name" => "Kiat mengatasi konflik pribadi",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //20
            [
                "id" => "078643b3-79db-4659-a767-56753dbe8292",
                "name" => "Norma keluarga",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //21
            [
                "id" => "7c150e19-5f4c-4318-b043-4190e753efc4",
                "name" => "Penyesuaian Diri Remaja di Sekolah Baru",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //22
            [
                "id" => "570e587c-cfc1-4d1d-844b-29aa9aa2a944",
                "name" => "Kenakalan Remaja dan Cara Menghindarinya",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //23
            [
                "id" => "550d8ff6-318e-4e58-a11e-23cfbb060132",
                "name" => "Bahaya rokok dan dampaknya",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //24
            [
                "id" => "780691fb-7365-4a27-8e46-d784b5ad22ed",
                "name" => "Prilaku sosial yang bertanggung jawab",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //25
            [
                "id" => "102851fb-9780-4129-abbc-5e3f5edab138",
                "name" => "Stop Bullying !",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //26
            [
                "id" => "4e803a89-f816-4c17-8645-42c61abc7276",
                "name" => "Etika pergaulan dengan teman sebaya",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //27
            [
                "id" => "c1616597-5216-44e6-a533-258d29bb7a54",
                "name" => "Sikap sopan santun dalam kehidupan",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //28
            [
                "id" => "bdeb5ccd-cb78-4de5-a7c4-a93dc1fe9f62",
                "name" => "Dampak handphone (medsos)",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //29
            [
                "id" => "b258cd7c-930a-4f74-8b0b-085816a638c8",
                "name" => "Interaksi sebagai makhluk sosial",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //30
            [
                "id" => "376c9f86-acc1-4e40-8e5a-1a5b1a2e32f1",
                "name" => "Kiat mencari teman",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //31
            [
                "id" => "aa28ac1c-9c29-49a4-ba5a-781b55945f31",
                "name" => "Hubungan komunikasi dengan lawan jenis",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //32
            [
                "id" => "ce8166d8-4eb7-444b-b105-2184248916f4",
                "name" => "Kiat sukses belajar di SMK-MAK",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //33
            [
                "id" => "8668900e-8e65-4009-8916-59b8b0083b0e",
                "name" => "Motivasi berprestasi",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //34
            [
                "id" => "539158b5-eb4d-4d7c-8df2-556d18e05481",
                "name" => "Strategi belajar sesuai dengan gaya belajar",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //35
            [
                "id" => "75544ccd-4bad-41cb-8c44-3fd40e9f4faa",
                "name" => "Kepedulian orang tua terhadap belajar anak",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //36
            [
                "id" => "6aadc5ea-c4da-4e87-a2e6-bdf2050e3ffb",
                "name" => "Disiplin Mengerjakan Tugas",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //37
            [
                "id" => "e1d2a9a0-8cc9-4334-86ed-012b0c090adf",
                "name" => "Tips memahami pelajaran",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //38
            [
                "id" => "4efbe505-cabf-47aa-9161-4bdea63d0da4",
                "name" => "Manfaat sumber belajar",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //39
            [
                "id" => "84c564b2-6b33-4172-8a74-3567cc1d97d6",
                "name" => "Belajar sesuai jadwal",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //40
            [
                "id" => "eef0f5bd-2cc5-4ea4-b7e1-54e8fbdbe3b0",
                "name" => "Struktur  kurikulum sekolah",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //41
            [
                "id" => "4c30d517-4a17-4191-99f0-042b56419f96",
                "name" => "Motivasi belajar",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //42
            [
                "id" => "816c2f4d-24ee-4773-8ff8-c790635262d7",
                "name" => "Belajar kelompok yang efektif",
                "service_component_id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "created_at" => round(microtime(true) * 1000),
            ],
            //43
            [
                "id" => "fc5ac799-01f7-4697-84b1-4ae3cc6cb195",
                "name" => "Memilih lembaga bimbel yang tepat",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //44
            [
                "id" => "2152ae6c-bd96-4273-a480-897c2c839ddc",
                "name" => "Memanfaatkan IT untuk meraih prestasi",
                "service_component_id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "created_at" => round(microtime(true) * 1000),
            ],
            //45
            [
                "id" => "3ad0cdbf-8b58-415b-8ade-10d971636506",
                "name" => "Strategi memperoleh Beasiswa",
                "service_component_id" => "ca76c3d9-8725-4600-b169-d46bae871765",
                "created_at" => round(microtime(true) * 1000),
            ],
            //46
            [
                "id" => "7ad6ff09-b9ee-409a-b961-4ba3715cf12b",
                "name" => "Kiat belajar sambil bekerja",
                "service_component_id" => "ca76c3d9-8725-4600-b169-d46bae871765",
                "created_at" => round(microtime(true) * 1000),
            ],
            //47
            [
                "id" => "97114279-2ba8-4301-8a48-13fd820ef20f",
                "name" => "Cara memilih Ekskul",
                "service_component_id" => "ca76c3d9-8725-4600-b169-d46bae871765",
                "created_at" => round(microtime(true) * 1000),
            ],
            //48
            [
                "id" => "9d98815a-e7d7-4327-84ea-6db1c2cd112c",
                "name" => "Mantap pada pilihan peminatan",
                "service_component_id" => "ca76c3d9-8725-4600-b169-d46bae871765",
                "created_at" => round(microtime(true) * 1000),
            ],
            //49
            [
                "id" => "b7b8bb79-fe0a-4239-870c-966169ae547f",
                "name" => "Hobi, bakat, minat, kemamapuan dan Karir",
                "service_component_id" => "ca76c3d9-8725-4600-b169-d46bae871765",
                "created_at" => round(microtime(true) * 1000),
            ],
            //50
            [
                "id" => "c0e2adf2-f2fc-4992-aa07-8a8a9d08364c",
                "name" => "Perencanaan Karir Masa Depan",
                "service_component_id" => "ca76c3d9-8725-4600-b169-d46bae871765",
                "created_at" => round(microtime(true) * 1000),
            ],
        ]);
    }
}
