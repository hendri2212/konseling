<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Soal;
use Illuminate\Support\Str;

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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
                "soal" => "Saya  belum bisa menjadi pribadi yang mandiri",
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
                "id" => Str::uuid(),
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
