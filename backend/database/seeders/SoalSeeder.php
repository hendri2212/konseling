<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Soal;

class SoalSeeder extends Seeder
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
                "soal" => "Saya merasa belum disiplin dalam beribadah pada Tuhan YME",
                "rumusan_kebutuhan" => "Kesadaran untuk beriman dan bertakwa pada Tuhan YME",
                "materi" => "Implementasi Iman dan Taqwa dalam kehidupan modern",
                "tujuan_layanan" => "Peserta didik/konseli  mampu memahami pentingnya iman dan taqwa pada Tuhan YME serta dapat hidup rukun, damai dan saling menghormati antar umat beragama", 
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan  klasikal", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "84e29080-1481-404d-92a1-c223e082b22b",
            ],
            [
                "id" => "90c7bcfa-3464-46ad-befa-74e381f3590d",
                "soal" => "Saya kadang-kadang berperilaku dan bertutur kata tidak jujur",
                "rumusan_kebutuhan" => "Kebiasaan bersikap jujur",
                "materi" => "Kejujuran dan Integritas",
                "tujuan_layanan" => "Peserta didik/konseli  dapat menjadi individu yang memiliki integritas diri serta dapat memancarkan kepercayaan diri dan sikap yang tidak mementingkan diri sendiri", 
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan  klasikal", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "d0bcd559-581e-4bd5-8751-c7ec6a3e2dc7",
            ],
            [
                "id" => "2f5c0b7f-9067-4e88-9f1a-6bd29e5c5128",
                "soal" => "Saya kadang-kadang masih suka menyontek pada waktu tes",
                "rumusan_kebutuhan" => "Kemampuan memiliki kebiasaan jujur dan tidak mencontek saat tes",
                "materi" => "Kebiasaan mencontek dan akibatnya",
                "tujuan_layanan" => "Peserta didik/konseli  dapat menjadi individu yang memiliki sikap jujur dan tidak mencontek", 
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan Kelompok", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "d0bcd559-581e-4bd5-8751-c7ec6a3e2dc7",
            ],
            [
                "id" => "2e2a5062-7845-4861-8268-5e5ab424a809",
                "soal" => "Saya merasa belum bisa mengendalikan emosi dengan baik",
                "rumusan_kebutuhan" => "Kemampuan mengelola emosi dengan baik",
                "materi" => "Mengelola emosi dengan baik",
                "tujuan_layanan" => "Peserta didik/konseli  dapat menjadi individu yang mampu mengendalikan emosi", 
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "a19ac4d2-30b9-49bf-b57c-0ffdab7d50ab",
            ],
            [
                "id" => "c305e465-5ac5-4c4f-b2c1-bce287eda28b",
                "soal" => "Saya belum paham tentang sikap dan perilaku asertif",
                "rumusan_kebutuhan" => "Komunikasi yang jujur dan tetap menjaga perasaan",
                "materi" => "Sikap dan Perilaku Asertif",
                "tujuan_layanan" => "Peserta didik/konseli  mampu membedakan perilaku agresif dan asertif, menerapkan prilaku asertif dengan teman-temannya serta mengembangkan sikap asertif untuk menunjang prestasi", 
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan  klasikal", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "a19ac4d2-30b9-49bf-b57c-0ffdab7d50ab",
            ],
            [
                "id" => "491a00de-aeb1-477f-a25d-5fdfad38efd9",
                "soal" => "Saya belum tahu cara mengenal dan memahami diri sendiri",
                "rumusan_kebutuhan" => "Melakukan pengenalan/pemahaman diri",
                "materi" => "Konsep diri remaja",
                "tujuan_layanan" => "Peserta didik/konseli  dapat memahami dan menemukan unsur-unsur konsep diri serta memahami dan menerima kelebihan dan kekurangan secara wajar dan penuh rasa syukur", 
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan  klasikal", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "27729beb-8071-4b41-876f-906999baa426",
            ],
            [
                "id" => "9b2e6821-cff3-4829-a293-d0ac46ae7960",
                "soal" => "Saya belum memahami potensi diri",
                "rumusan_kebutuhan" => "Memahami potensi diri",
                "materi" => "Potensi diri remaja",
                "tujuan_layanan" => "Peserta didik/konseli  dapat mengenal dan menggali potensi diri serta berusaha mengoptimalkannya untuk meraih sukses masa depan",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan  klasikal", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "27729beb-8071-4b41-876f-906999baa426",
            ],
            [
                "id" => "b2f85d2f-0212-4781-9529-3e1e75dbf719",
                "soal" => "Saya belum tahu perubahan dan permasalahan yang terjadi pada masa remaja",
                "rumusan_kebutuhan" => "Masa perkembangan remaja dan permasalahannya",
                "materi" => "Psikologi remaja dan permasalahannya",
                "tujuan_layanan" => "Peserta didik/konseli  mampu mengenal ciri-ciri perkembangan remaja, dapat memahami tugas perkembangan, mengatasi masalah yang dihadapi dalam perkembangan",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan  klasikal", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "27729beb-8071-4b41-876f-906999baa426",
            ],
            //9
            [
                "id" => "708cd860-cb08-495a-9a97-e5fd1ed18a30",
                "soal" => "Saya belum mengenal tentang macam-macam kepribadian",
                "rumusan_kebutuhan" => "Mengenal kepribadian yang dimiliki manusia",
                "materi" => "Kepribadian Manusia",
                "tujuan_layanan" => "Peserta didik/konseli  mampu mengenal tipe-tipe kepribadian manusia, mengenal kepribadian yang dimiliki serta dapat tumbuh menjadi pribadi yang matang",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan  klasikal", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "27729beb-8071-4b41-876f-906999baa426",
            ],
            //10
            [
                "id" => "b4fd04aa-3c06-4015-8aa5-02f667be2a9f",
                "soal" => "Saya kurang memiliki rasa percaya diri",
                "rumusan_kebutuhan" => "Memiliki kepercayaan diri",
                "materi" => "Membangun Rasa Percaya Diri",
                "tujuan_layanan" => "Peserta didik/konseli  dapat memahami ciri-ciri pribadi yang memiliki rasa percaya diri serta dapat meningkatkan percaya diri dengan baik untuk mencapai tujuan hidupnya",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan  klasikal", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "27729beb-8071-4b41-876f-906999baa426",
            ],
            //11
            [
                "id" => "49ac98b1-afac-4b88-95fe-2c190ca3d7d4",
                "soal" => "Saya kadang kurang menjaga kesehatan diri",
                "rumusan_kebutuhan" => "Kemampuan menjaga kesehatan dengan baik",
                "materi" => "Pola Hidup Bersih dan Sehat",
                "tujuan_layanan" => "Peserta didik/konseli  mampu memahami pentingnya polah hidup bersih dan sehat serta dapat melakukan kebiasaan hidup bersih dan sehat sehari-hari yang dapat mempengaruhi kesehatan",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan  klasikal", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "27729beb-8071-4b41-876f-906999baa426",
            ],
            //12
            [
                "id" => "5605e638-a75b-4d92-800a-27e166834dd0",
                "soal" => "Saya belum tahu ciri-ciri/sifat/prilaku pribadi yang berkarakter",
                "rumusan_kebutuhan" => "Memiliki ciri-ciri/sifat pribadi yang berkarakter",
                "materi" => "Pola Hidup Bersih dan Sehat",
                "tujuan_layanan" => "Peserta didik/konseli  mampu memiliki perasaan positif untuk membangun pribadi yang berkarakter yang akan berkontribusi pada peningkatan mutu karakter bangsa",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan  klasikal", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "27729beb-8071-4b41-876f-906999baa426",
            ],
            //13
            [
                "id" => "6693c485-2cad-496c-bbdb-bd7ffc63716e",
                "soal" => "Saya merasa kurang memilki tanggung jawab  pada diri sendiri",
                "rumusan_kebutuhan" => "Memiliki rasa tanggung jawab",
                "materi" => "Rasa tanggung jawab",
                "tujuan_layanan" => "Peserta didik/konseli mampu memiliki rasa tanggung jawab pada diri sendiri dan orang lain",
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "27729beb-8071-4b41-876f-906999baa426",
            ],
            //14
            [
                "id" => "e3d3763e-6986-4487-83b0-c245fba16699",
                "soal" => "Saya kesulitan mengatur waktu belajar dan bermain",
                "rumusan_kebutuhan" => "Mengatur jadwal kegiatan sehari-hari",
                "materi" => "Mengatur  jadwal kegiatan sehari-hari",
                "tujuan_layanan" => "Peserta didik/konseli mampu mengatur jadwal kegiatan sehari-hari dengan baik",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan Kelompok", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "27729beb-8071-4b41-876f-906999baa426",
            ],
            //15
            [
                "id" => "c11a3b3a-3784-4f1a-a341-4685474f028d",
                "soal" => "Kondisi orang tua saya sedang tidak harmonis",
                "rumusan_kebutuhan" => "Memiliki keluarga yang harmonis",
                "materi" => "Keluarga yang harmonis",
                "tujuan_layanan" => "Peserta didik/konseli memiliki keluarga yang harmonis",
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "27729beb-8071-4b41-876f-906999baa426",
            ],
            //16
            [
                "id" => "c75069d1-ac34-4f1c-8915-6593c9106177",
                "soal" => "Saya merasa tidak betah tinggal di rumah sendiri",
                "rumusan_kebutuhan" => "Merasa nyaman,aman tinggal di rumah sendiri",
                "materi" => "Rumahku surgaku",
                "tujuan_layanan" => "Peserta didik/konseli merasa nyaman,aman tinggal di rumah sendiri",
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "27729beb-8071-4b41-876f-906999baa426",
            ],
            //17
            [
                "id" => "41f9d69b-e4ad-4838-a55f-bd57035d5e41",
                "soal" => "Saya mempunyai masalah dengan anggota keluarga di rumah",
                "rumusan_kebutuhan" => "Mampu menyelesaikan masalah dengan kekeluargaan",
                "materi" => "Mengatasi masalah dengan anggota keluarga",
                "tujuan_layanan" => "Peserta didik/konseli dapat menyelesaikan masalah dengan kekeluargaan",
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "27729beb-8071-4b41-876f-906999baa426",
            ],
            //18
            [
                "id" => "9e228033-e526-4c65-923b-c7d3c2402efa",
                "soal" => "Saya belum bisa menjadi pribadi yang mandiri",
                "rumusan_kebutuhan" => "Menjadi pribadi yang mandiri",
                "materi" => "Menjadi pribadi mandiri",
                "tujuan_layanan" => "Peserta didik/konseli mampu menjadi pribadi yang mandiri",
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "27729beb-8071-4b41-876f-906999baa426",
            ],
            //19
            [
                "id" => "7bd65c11-1648-49a7-bc96-1faa4aebfe35",
                "soal" => "Saya belum memahami tentang norma/cara membangun  berkeluarga",
                "rumusan_kebutuhan" => "Memiliki pengetahuan tentang norma berkeluarga",
                "materi" => "Norma keluarga",
                "tujuan_layanan" => "Peserta didik/konseli memiliki pengetahuan tentang norma berkeluarga",
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "27729beb-8071-4b41-876f-906999baa426",
            ],
            //20
            [
                "id" => "b1263bbb-f648-4387-a476-898f4d0603e8",
                "soal" => "Saya sedang memiliki konflik pribadi",
                "rumusan_kebutuhan" => "Mampu menyelesaikan konflik pribadi",
                "materi" => "Kiat mengatasi konflik pribadi",
                "tujuan_layanan" => "Peserta didik/konseli mampu menyelesaikan konflik pribadi",
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "3bdd628e-267c-469d-802f-14557fd0e622",
                "kompetensi_id" => "a214ff4e-a945-43b9-977b-29ebba8080d5",
            ],
            //21
            [
                "id" => "57568c9c-41d6-4586-8daf-d023cd26b66a",
                "soal" => "Saya belum banyak mengenal lingkungan sekolah baru",
                "rumusan_kebutuhan" => "Mengenal lingkungan sekolah baru",
                "materi" => "Penyesuaian Diri Remaja di Sekolah Baru",
                "tujuan_layanan" => "Peserta didik/konseli  dapat mengenal aspek-aspek penyesuaian diri serta dapat menerapkan sikap dan kebiasaan dengan lingkungannya",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan klasikal", 
                "bidang_id" => "a40879c0-7943-4b6e-9766-cfa0a2b64baa",
                "kompetensi_id" => "ec7ccc3c-16f6-4fa6-a5e8-510f2636b082",
            ],
            //22
            [
                "id" => "24a17919-28ac-42c4-8865-325f05ea4e09",
                "soal" => "Saya belum memahami tentang kenakalan remaja",
                "rumusan_kebutuhan" => "Memiliki pemahaman tentang kenakalan remaja",
                "materi" => "Kenakalan Remaja dan Cara Menghindarinya",
                "tujuan_layanan" => "Peserta didik/konseli  dapat mengetahui bentuk atau jenis kenakalan remaja, dampak terhadap pribadi dan lingkungan serta berusaha untuk menghindarinya",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan klasikal", 
                "bidang_id" => "a40879c0-7943-4b6e-9766-cfa0a2b64baa",
                "kompetensi_id" => "ec7ccc3c-16f6-4fa6-a5e8-510f2636b082",
            ],
            //23
            [
                "id" => "be7b07a6-238d-4ad0-aa5e-205758af2d3e",
                "soal" => "Saya masih sedikit mengetahui tentang dampak atau bahaya rokok",
                "rumusan_kebutuhan" => "Memiliki pemahaman tentang bahaya rokok",
                "materi" => "Bahaya rokok dan dampaknya",
                "tujuan_layanan" => "Peserta didik/konseli  memiliki pemahaman tentang bahaya dan dampak rokok bagi kesehatan tubuh dan lingkungan serta cara untuk menolak ajakan untuk merokok dalam bentuk apapun",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan klasikal", 
                "bidang_id" => "a40879c0-7943-4b6e-9766-cfa0a2b64baa",
                "kompetensi_id" => "ec7ccc3c-16f6-4fa6-a5e8-510f2636b082",
            ],
            //24
            [
                "id" => "b5d7d91f-b6ca-4ee8-aedf-7b991564dd5b",
                "soal" => "Saya belum banyak mengenal tentang perilaku sosial yang bertanggung jawab",
                "rumusan_kebutuhan" => "Memiliki perilaku sosial yang bertanggung jawab",
                "materi" => "Prilaku sosial yang bertanggung jawab",
                "tujuan_layanan" => "Peserta didik/konseli  mampu memahami pentingnya berprilaku sosial yang baik, serta memiliki sikap untuk hidup bersosial yang bertanggung jawab dalam sebuah masyarakat",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan klasikal", 
                "bidang_id" => "a40879c0-7943-4b6e-9766-cfa0a2b64baa",
                "kompetensi_id" => "ec7ccc3c-16f6-4fa6-a5e8-510f2636b082",
            ],
            //25
            [
                "id" => "c18f0995-38a5-4c04-a4d3-da9329383d25",
                "soal" => "Saya belum tahu tentang bullying dan cara mensikapinya",
                "rumusan_kebutuhan" => "Memahami tentang bullying",
                "materi" => "Stop Bullying !",
                "tujuan_layanan" => "Peserta didik/konseli  mampu memahami tentang bullying, bahaya prilaku bullying, sebab dan dampak bullying, serta berani cara melawan tindakan bullying",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan klasikal", 
                "bidang_id" => "a40879c0-7943-4b6e-9766-cfa0a2b64baa",
                "kompetensi_id" => "9dea1b1f-6357-4aaf-b393-89f034c7ee48",
            ],
            //26
            [
                "id" => "d02fe506-1005-4c3a-8027-55e302715b4d",
                "soal" => "Saya sukar bergaul dengan teman-teman di sekolah",
                "rumusan_kebutuhan" => "Memiliki etika bergaul dengan teman sebaya",
                "materi" => "Etika pergaulan dengan teman sebaya",
                "tujuan_layanan" => "Peserta didik/konseli  mampu memahami norma-norma dalam masyarakat serta dapat bersosialisasidan bergaul dengan teman sebaya sesuai dengan etika yang baik",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan klasikal", 
                "bidang_id" => "a40879c0-7943-4b6e-9766-cfa0a2b64baa",
                "kompetensi_id" => "9dea1b1f-6357-4aaf-b393-89f034c7ee48",
            ],
            //27
            [
                "id" => "ae69e788-2f6b-441c-b251-554592363b77",
                "soal" => "Sering saya dianggap tidak sopan pada orang lain",
                "rumusan_kebutuhan" => "Memiliki sikap sopan santun pada orang lain",
                "materi" => "Sikap sopan santun dalam kehidupan",
                "tujuan_layanan" => "Peserta didik/konseli  mampu memahami nilai-nilai dan cara bertingkah laku sopan santun dalam kehidupan di luar kelompok teman sebaya",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan klasikal", 
                "bidang_id" => "a40879c0-7943-4b6e-9766-cfa0a2b64baa",
                "kompetensi_id" => "9dea1b1f-6357-4aaf-b393-89f034c7ee48",
            ],
            //28
            [
                "id" => "ea2dee21-5ba1-4883-9f44-46d146389240",
                "soal" => "Saya kurang memahami dampak dari media sosial",
                "rumusan_kebutuhan" => "Memiliki pemahaman tentang dampak dari media sosial",
                "materi" => "Dampak handphone (medsos)",
                "tujuan_layanan" => "Peserta didik/konseli dapat memahami dampak positif dan negatif bermain handphone atau media sosial",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan klasikal", 
                "bidang_id" => "a40879c0-7943-4b6e-9766-cfa0a2b64baa",
                "kompetensi_id" => "9dea1b1f-6357-4aaf-b393-89f034c7ee48",
            ],
            //29
            [
                "id" => "f053c86d-ed6e-4f4c-9091-bcda8cbe060a",
                "soal" => "Saya jarang bermain/berteman di lingkungan tempat saya tinggal",
                "rumusan_kebutuhan" => "Kesadaran sebagai makhluk sosial yang harus berinteraksi",
                "materi" => "Interaksi sebagai makhluk sosial",
                "tujuan_layanan" => "Peserta didik/konseli memiliki Kesadaran sebagai makhluk sosial yang harus berinteraksi",
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "a40879c0-7943-4b6e-9766-cfa0a2b64baa",
                "kompetensi_id" => "9dea1b1f-6357-4aaf-b393-89f034c7ee48",
            ],
            //30
            [
                "id" => "94b4cc73-3b08-44df-882a-3a7864bbf939",
                "soal" => "Saya belum banyak teman atau sahabat",
                "rumusan_kebutuhan" => "Kemudahan mencari dan disenangi teman",
                "materi" => "Kiat mencari teman",
                "tujuan_layanan" => "Peserta didik/konseli mudah mencari dan disenangi teman",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan Kelompok", 
                "bidang_id" => "a40879c0-7943-4b6e-9766-cfa0a2b64baa",
                "kompetensi_id" => "9dea1b1f-6357-4aaf-b393-89f034c7ee48",
            ],
            //31
            [
                "id" => "2495c1d3-93c9-4730-8aef-fb73e4536c82",
                "soal" => "Saya kurang suka  berkomunikasi dengan teman lawan jenis",
                "rumusan_kebutuhan" => "Memiliki pemahaman tentang hubungan komunikasi dengan lawan jenis",
                "materi" => "Hubungan komunikasi dengan lawan jenis",
                "tujuan_layanan" => "Peserta didik/konseli memiliki pemahaman tentang norma hubungan komunikasi dengan lawan jenis",
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "a40879c0-7943-4b6e-9766-cfa0a2b64baa",
                "kompetensi_id" => "3110ec6e-3757-49d4-8cf8-84c5239b2e5d",
            ],
            //32
            [
                "id" => "4249a6f8-4c7a-4a15-9947-678db0a9e823",
                "soal" => "Saya belum tahu cara belajar yang baik dan benar di SMK/MAK",
                "rumusan_kebutuhan" => "Memahami belajar yang benar di SMK/MAK",
                "materi" => "Kiat sukses belajar di SMK-MAK",
                "tujuan_layanan" => "Peserta didik/konseli  dapat mengenal sikap dalam belajar serta menerapkan sikap dan kebiasaan dalam belajar yang baik di SMK-MAK hingga mencapai prestasi yang lebih luas",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan  klasikal", 
                "bidang_id" => "b374344b-9e60-45b3-89c6-fe4d57220d58",
                "kompetensi_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
            ],
            //33
            [
                "id" => "4d308107-d4a1-4e65-87c1-3795879135d7",
                "soal" => "Saya belum tahu cara meraih prestasi di sekolah",
                "rumusan_kebutuhan" => "Memiliki motivasi untuk berprestasi",
                "materi" => "Motivasi berprestasi",
                "tujuan_layanan" => "Peserta didik/konseli  mampu memahami pengertian motivasi berprestasi, mengetahui dan menerapkan cara untuk meningkatkan motivasi berprestasi",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan  klasikal", 
                "bidang_id" => "b374344b-9e60-45b3-89c6-fe4d57220d58",
                "kompetensi_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
            ],
            //34
            [
                "id" => "944530a8-1f78-4783-925c-9c9a37246356",
                "soal" => "Saya belum paham tentang gaya belajar dan strategi yang sesuai dengannya",
                "rumusan_kebutuhan" => "Menemukan cara belajar yang sesuai dengan gaya belajar",
                "materi" => "Strategi belajar sesuai dengan gaya belajar",
                "tujuan_layanan" => "Peserta didik/konseli  dapat memahami dan mengetahui tentang gaya belajar serta strategi belajarnya untuk masing-masing gaya belajar tersebut",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan  klasikal", 
                "bidang_id" => "b374344b-9e60-45b3-89c6-fe4d57220d58",
                "kompetensi_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
            ],
            //35
            [
                "id" => "5ade17f5-e0f5-411c-8039-c1901cdc39f5",
                "soal" => "Orang tua saya tidak peduli dengan kegiatan belajar saya",
                "rumusan_kebutuhan" => "Kepedulian orang tua pada kegiatan belajar",
                "materi" => "Kepedulian orang tua terhadap belajar anak",
                "tujuan_layanan" => "Peserta didik/konseli  selalu mendapat perhatian orang tua dalam belajarnya",
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "b374344b-9e60-45b3-89c6-fe4d57220d58",
                "kompetensi_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
            ],
            //36
            [
                "id" => "e7cbdae9-ce39-4472-97fb-9c8e55b8de2a",
                "soal" => "Saya masih sering menunda-nunda tugas sekolah/pekerjaan rumah (PR)",
                "rumusan_kebutuhan" => "Melaksanakan Tugas Sekolah / PR tepat waktu",
                "materi" => "Disiplin Mengerjakan Tugas",
                "tujuan_layanan" => "Peserta didik/konseli  memiliki kedisiplinan dalam belajar",
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "b374344b-9e60-45b3-89c6-fe4d57220d58",
                "kompetensi_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
            ],
            //37
            [
                "id" => "7cb0b518-5e97-43dc-83e8-0c4889621c1f",
                "soal" => "Saya merasa kesulitan dalam memahami pelajaran tertentu",
                "rumusan_kebutuhan" => "Mudah memahami pelajaran",
                "materi" => "Tips memahami pelajaran",
                "tujuan_layanan" => "Peserta didik/konseli  dapat memahami teknik memahami pelajaran",
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "b374344b-9e60-45b3-89c6-fe4d57220d58",
                "kompetensi_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
            ],
            //38
            [
                "id" => "7a1ffca4-7fa4-4b8f-9923-6aa0f672d723",
                "soal" => "Saya belum tahu cara memanfaatkan sumber belajar",
                "rumusan_kebutuhan" => "Mampu memanfaatkan sumber belajar",
                "materi" => "Manfaat sumber belajar",
                "tujuan_layanan" => "Peserta didik/konseli  dapat memanfaatkan sumber belajar dalam kegiatan belajarnya",
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "b374344b-9e60-45b3-89c6-fe4d57220d58",
                "kompetensi_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
            ],
            //39
            [
                "id" => "b696a51a-4fcf-4af1-8e20-d64b7a34257e",
                "soal" => "Saya belajarnya jika akan ada tes  atau ujian saja",
                "rumusan_kebutuhan" => "Kesadaran belajar sesuai jadwal",
                "materi" => "Belajar sesuai jadwal",
                "tujuan_layanan" => "Peserta didik/konseli  dapat mengatur waktu belajarnya",
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "b374344b-9e60-45b3-89c6-fe4d57220d58",
                "kompetensi_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
            ],
            //40
            [
                "id" => "e681d9c2-89ff-4307-a382-556941075c76",
                "soal" => "Saya belum tahu tentang struktur kurikulum yang ada di sekolah",
                "rumusan_kebutuhan" => "Memahami struktru kurikulum sekolah",
                "materi" => "Srtuktur  kurikulum sekolah",
                "tujuan_layanan" => "Peserta didik/konseli  dapat memahami tentang struktur kurikulum sekolah",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Lintas Kelas", 
                "bidang_id" => "b374344b-9e60-45b3-89c6-fe4d57220d58",
                "kompetensi_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
            ],
            //41
            [
                "id" => "04827ba5-09b1-4ad0-b825-08e719a0676a",
                "soal" => "Saya merasa malas belajar dan kalau belajar sering ngantuk",
                "rumusan_kebutuhan" => "Memiliki semangat belajar",
                "materi" => "Motivasi belajar",
                "tujuan_layanan" => "Peserta didik/konseli  memiliki motivasi dalam belajar",
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "b374344b-9e60-45b3-89c6-fe4d57220d58",
                "kompetensi_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
            ],
            //42
            [
                "id" => "7e21bee2-6dc2-4d63-be2e-3b9290afdaed",
                "soal" => "Saya belum terbiasa belajar bersama atau belajar kelompok",
                "rumusan_kebutuhan" => "Membentuk belajar kelompok",
                "materi" => "Belajar kelompok yang efektif",
                "tujuan_layanan" => "Peserta didik/konseli  dapat belajar kelompok dengan temannya",
                "komponen_layanan" => "Dasar",
                "strategi_layanan" => "Bimbingan Kelompok", 
                "bidang_id" => "b374344b-9e60-45b3-89c6-fe4d57220d58",
                "kompetensi_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
            ],
            //43
            [
                "id" => "f647721f-421d-4737-95ce-32afcf91e8e8",
                "soal" => "Saya belum paham cara memilih lembaga bimbingan belajar yang baik",
                "rumusan_kebutuhan" => "Mengetahui cara memilih lembaga bimbil yang baik",
                "materi" => "Memilih lembaga bimbel yang tepat",
                "tujuan_layanan" => "Peserta didik/konseli  dapat memilih  lembaga bimbingan belajar yang tepat",
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "b374344b-9e60-45b3-89c6-fe4d57220d58",
                "kompetensi_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
            ],
            //44
            [
                "id" => "241b79e3-8eee-402c-b5c6-8e69214b07a9",
                "soal" => "Saya belum dapat memanfaatkan teknologi informasi untuk belajar",
                "rumusan_kebutuhan" => "Pemanfaatan perkembangan teknologi informasi",
                "materi" => "Memanfaatkan IT untuk meraih prestasi",
                "tujuan_layanan" => "Peserta didik/konseli  dapat memanfaatkan teknologi informasi  untuk belajar",
                "komponen_layanan" => "Responsif",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "b374344b-9e60-45b3-89c6-fe4d57220d58",
                "kompetensi_id" => "264e8c59-e7fb-4670-8738-e7f355cd83e9",
            ],
            //45
            [
                "id" => "0e7b4866-f755-49cb-8ee6-3c7a924e49b2",
                "soal" => "Saya belum tahu cara memperoleh bantuan pendidikan (beasiswa)",
                "rumusan_kebutuhan" => "Memperoleh informasi bantuan/beasiswa",
                "materi" => "Strategi memperoleh Beasiswa",
                "tujuan_layanan" => "Peserta didik/konseli  dapat memanfaatkan peluang beasiswa yang ada",
                "komponen_layanan" => "Pem&Perenc Indv",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "eeb613e4-4b46-4681-a28a-86f1a113237e",
                "kompetensi_id" => "d26c7621-ea85-4b94-96f5-7747ac4e90ed",
            ],
            //46
            [
                "id" => "eb4c5c5b-492f-4a05-be5a-14f12155e941",
                "soal" => "Saya terpaksa harus bekerja untuk mencukupi kebutuhan hidup",
                "rumusan_kebutuhan" => "Memperoleh penghasilan untuk biaya hidup",
                "materi" => "Kiat belajar sambil bekerja",
                "tujuan_layanan" => "Peserta didik/ konseli mampu mengatur kegiatan antara belajar sambil bekerja",
                "komponen_layanan" => "Pem&Perenc Indv",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "eeb613e4-4b46-4681-a28a-86f1a113237e",
                "kompetensi_id" => "d26c7621-ea85-4b94-96f5-7747ac4e90ed",
            ],
            //47
            [
                "id" => "8590f607-f1a4-492b-ba99-ec7acefd361b",
                "soal" => "Saya merasa bingung memilih kegiatan esktrakurikuler di sekolah",
                "rumusan_kebutuhan" => "Memiliki kemampuan untuk memilih kegiatan ekstra kurikuler",
                "materi" => "Cara memilih Ekskul",
                "tujuan_layanan" => "Peserta didik/konseli  mampu memilih kegiatan ekstra kurikuler yang sesuai dengan bakat, minat dan kemampuannya",
                "komponen_layanan" => "Pem&Perenc Indv",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "eeb613e4-4b46-4681-a28a-86f1a113237e",
                "kompetensi_id" => "4aeb15f9-64e5-4e45-abfb-8bea715f1aca",
            ],
            //48
            [
                "id" => "54bcdb3f-896a-496e-83ba-d7596857e2b3",
                "soal" => "Saya merasa belum mantap pada pilihan peminatan yang diambil",
                "rumusan_kebutuhan" => "Memiliki kemantapan  pada pilihan peminatan yang diambil",
                "materi" => "Mantap pada pilihan peminatan",
                "tujuan_layanan" => "Peserta didik/konseli  mantap pada pilihan peminatan yang telah diambil",
                "komponen_layanan" => "Pem&Perenc Indv",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "eeb613e4-4b46-4681-a28a-86f1a113237e",
                "kompetensi_id" => "4aeb15f9-64e5-4e45-abfb-8bea715f1aca",
            ],
            //49
            [
                "id" => "bebc078d-96d9-4faa-8c13-559ced28268f",
                "soal" => "Saya merasa belum paham hubungan antara hobi, bakat, minat, kemampuan dan karir",
                "rumusan_kebutuhan" => "Memahami hubungan hobi, bakat, minat, kemampuan dan karir",
                "materi" => "Hobi, bakat, minat, kemamapuan dan Karir",
                "tujuan_layanan" => "Peserta didik/konseli  mampu memahami peranan hobi, bakat, minat  dalam karir masa depannya",
                "komponen_layanan" => "Pem&Perenc Indv",
                "strategi_layanan" => "Konseling Individual", 
                "bidang_id" => "eeb613e4-4b46-4681-a28a-86f1a113237e",
                "kompetensi_id" => "4aeb15f9-64e5-4e45-abfb-8bea715f1aca",
            ],
            //50
            [
                "id" => "d950d832-71cc-4b1c-aaff-b0eabb17765d",
                "soal" => "Saya belum memiliki perencanaan karir masa depan",
                "rumusan_kebutuhan" => "Memiliki perencanaan karir yang baik",
                "materi" => "Perencanaan Karir Masa Depan",
                "tujuan_layanan" => "Peserta didik/konseli  mampu memahami pentingnya perencanaan karir, langkah-langkah dalam merencanakan karir serta mililiki sikap positif dalam meraih kesuksesan masa depan",
                "komponen_layanan" => "Pem&Perenc Indv",
                "strategi_layanan" => "Bimbingan  klasikal", 
                "bidang_id" => "eeb613e4-4b46-4681-a28a-86f1a113237e",
                "kompetensi_id" => "4aeb15f9-64e5-4e45-abfb-8bea715f1aca",
            ],
        
        ];
        for ($i=0; $i < count($data); $i++) { 
            $insert = new Soal;
            $insert->id                 = $data[$i]['id'];
            $insert->soal               = $data[$i]['soal'];
            $insert->rumusan_kebutuhan  = $data[$i]['rumusan_kebutuhan'];
            $insert->materi             = $data[$i]['materi'];
            $insert->tujuan_layanan     = $data[$i]['tujuan_layanan'];
            $insert->komponen_layanan   = $data[$i]['komponen_layanan'];
            $insert->strategi_layanan   = $data[$i]['strategi_layanan'];
            $insert->bidang_id          = $data[$i]['bidang_id'];
            $insert->kompetensi_id      = $data[$i]['kompetensi_id'];
            $insert->save();
        }
    }
}
