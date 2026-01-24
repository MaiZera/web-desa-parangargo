<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsData = [
            [
                'title' => 'Pembangunan Jalan Desa Parangargo Dimulai',
                'summary' => 'Pemerintah desa mulai pembangunan jalan sepanjang 2 kilometer untuk meningkatkan aksesibilitas warga.',
                'content' => "Desa Parangargo - Pemerintah Desa Parangargo resmi memulai proyek pembangunan jalan desa sepanjang 2 kilometer yang menghubungkan Dusun Utara dengan Dusun Selatan.\n\nKepala Desa Parangargo menyampaikan bahwa proyek ini merupakan prioritas utama untuk meningkatkan aksesibilitas dan mobilitas warga. Dana pembangunan berasal dari Dana Desa tahun 2026.\n\nProyek ini diperkirakan akan selesai dalam 3 bulan ke depan dan akan sangat membantu warga dalam aktivitas sehari-hari.",
                'category' => 'Pembangunan',
                'is_featured' => true,
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Pelatihan UMKM untuk Warga Desa',
                'summary' => 'Dinas Koperasi mengadakan pelatihan pengembangan UMKM bagi pelaku usaha di Desa Parangargo.',
                'content' => "Sebanyak 30 pelaku UMKM di Desa Parangargo mengikuti pelatihan pengembangan usaha yang diselenggarakan oleh Dinas Koperasi dan UMKM Kabupaten.\n\nPelatihan ini mencakup manajemen keuangan, pemasaran digital, dan strategi pengembangan produk. Para peserta terlihat antusias mengikuti setiap sesi pelatihan.\n\nDiharapkan setelah pelatihan ini, UMKM di desa dapat berkembang lebih pesat dan mampu bersaing di pasar yang lebih luas.",
                'category' => 'Ekonomi',
                'is_featured' => true,
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Posyandu Balita Rutin Bulan Ini',
                'summary' => 'Kegiatan Posyandu balita dilaksanakan setiap minggu pertama setiap bulan di Balai Desa.',
                'content' => "Kegiatan Posyandu balita kembali dilaksanakan di Balai Desa Parangargo. Kegiatan yang rutin dilakukan setiap minggu pertama ini dihadiri oleh puluhan ibu dan balita.\n\nPelayanan yang diberikan meliputi penimbangan, pemberian vitamin, imunisasi, dan konsultasi kesehatan. Petugas kesehatan dari Puskesmas juga hadir untuk memberikan edukasi kesehatan.\n\nKepala Desa mengajak seluruh orangtua untuk aktif membawa anaknya ke Posyandu demi tumbuh kembang optimal.",
                'category' => 'Kesehatan',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Gotong Royong Bersih Desa',
                'summary' => 'Seluruh warga bergotong royong membersihkan lingkungan desa dalam rangka menyambut HUT RI.',
                'content' => "Dalam rangka menyambut HUT Kemerdekaan RI, warga Desa Parangargo menggelar gotong royong bersih desa secara serentak.\n\nKegiatan ini meliputi pembersihan selokan, pengecatan fasilitas umum, dan penataan taman desa. Antusiasme warga sangat tinggi, bahkan anak-anak ikut membantu.\n\nKegiatan gotong royong ini menunjukkan tingginya rasa kebersamaan dan kepedulian warga terhadap kebersihan lingkungan.",
                'category' => 'Kegiatan',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Penyaluran Bantuan Sosial kepada Warga Kurang Mampu',
                'summary' => 'Pemerintah desa menyalurkan bantuan sosial berupa sembako kepada 150 keluarga kurang mampu.',
                'content' => "Pemerintah Desa Parangargo menyalurkan bantuan sosial berupa paket sembako kepada 150 keluarga kurang mampu yang terdampak ekonomi.\n\nSetiap paket berisi beras 10 kg, minyak goreng, gula, dan kebutuhan pokok lainnya. Penyaluran dilakukan secara langsung di Balai Desa dengan menerapkan protokol kesehatan.\n\nKepala Desa berharap bantuan ini dapat meringankan beban masyarakat yang sedang mengalami kesulitan ekonomi.",
                'category' => 'Sosial',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'Festival Budaya Desa Parangargo 2026',
                'summary' => 'Desa menggelar festival budaya yang menampilkan kesenian tradisional dan kuliner khas daerah.',
                'content' => "Festival Budaya Desa Parangargo 2026 sukses digelar dengan meriah. Acara ini menampilkan berbagai kesenian tradisional seperti tari, musik gamelan, dan wayang.\n\nSelain pertunjukan seni, festival ini juga menghadirkan bazar kuliner khas daerah yang menawarkan berbagai makanan tradisional. Pengunjung dari desa tetangga juga turut memeriahkan acara.\n\nFestival budaya ini bertujuan untuk melestarikan budaya lokal dan memperkenalkannya kepada generasi muda.",
                'category' => 'Budaya',
                'is_featured' => true,
                'status' => 'published',
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => 'Sosialisasi Program Desa Digital',
                'summary' => 'Pemerintah desa mengadakan sosialisasi program digitalisasi layanan publik desa.',
                'content' => "Pemerintah Desa Parangargo menggelar sosialisasi Program Desa Digital yang bertujuan untuk meningkatkan kualitas layanan publik.\n\nProgram ini meliputi pembuatan website desa, sistem pengajuan surat online, dan digitalisasi data kependudukan. Sosialisasi dihadiri oleh perangkat desa dan tokoh masyarakat.\n\nDiharapkan dengan program ini, pelayanan kepada masyarakat akan lebih cepat, transparan, dan efisien.",
                'category' => 'Teknologi',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(18),
            ],
            [
                'title' => 'Musyawarah Perencanaan Pembangunan Desa',
                'summary' => 'Musrenbangdes digelar untuk menyusun prioritas pembangunan desa tahun depan.',
                'content' => "Musyawarah Perencanaan Pembangunan Desa (Musrenbangdes) telah dilaksanakan di Balai Desa Parangargo. Acara ini dihadiri oleh perwakilan dari setiap dusun, RT/RW, dan tokoh masyarakat.\n\nDalam forum ini, warga menyampaikan usulan dan aspirasi terkait pembangunan desa untuk tahun depan. Beberapa usulan prioritas yang muncul antara lain perbaikan jalan, pembangunan balai dusun, dan pengadaan sarana olahraga.\n\nHasil Musrenbangdes ini akan menjadi acuan dalam penyusunan Rencana Kerja Pemerintah Desa (RKPDes) tahun mendatang.",
                'category' => 'Pemerintahan',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(20),
            ],
            [
                'title' => 'Launching Bank Sampah Desa',
                'summary' => 'Desa meluncurkan program bank sampah untuk mengelola sampah dan meningkatkan ekonomi warga.',
                'content' => "Program Bank Sampah Desa Parangargo resmi diluncurkan sebagai upaya mengelola sampah sekaligus meningkatkan ekonomi warga.\n\nMelalui bank sampah ini, warga dapat menukarkan sampah yang dapat didaur ulang dengan uang atau barang kebutuhan. Sistem pengelolaan menggunakan aplikasi digital untuk memudahkan pencatatan.\n\nProgram ini diharapkan dapat mengurangi volume sampah dan meningkatkan kesadaran warga akan pentingnya pengelolaan sampah yang baik.",
                'category' => 'Lingkungan',
                'is_featured' => true,
                'status' => 'published',
                'published_at' => now()->subDays(23),
            ],
            [
                'title' => 'Rencana Pengembangan Objek Wisata Desa',
                'summary' => 'Pemerintah desa merencanakan pengembangan objek wisata alam untuk meningkatkan PADes.',
                'content' => "Pemerintah Desa Parangargo tengah menyusun rencana pengembangan objek wisata alam yang ada di wilayah desa.\n\nObjek wisata yang akan dikembangkan meliputi air terjun, area persawahan, dan spot foto instagramable. Pengembangan ini bertujuan untuk meningkatkan Pendapatan Asli Desa (PADes) dan menciptakan lapangan kerja bagi warga.\n\nSaat ini sedang dilakukan studi kelayakan dan perencanaan detail. Diharapkan objek wisata dapat beroperasi dalam waktu satu tahun ke depan.",
                'category' => 'Pariwisata',
                'is_featured' => false,
                'status' => 'draft',
                'published_at' => null,
            ],
        ];

        foreach ($newsData as $news) {
            News::create([
                'title' => $news['title'],
                'slug' => Str::slug($news['title']),
                'summary' => $news['summary'],
                'content' => $news['content'],
                'category' => $news['category'],
                'is_featured' => $news['is_featured'],
                'status' => $news['status'],
                'view_count' => rand(50, 500),
                'author_id' => 1, // Super Admin
                'published_at' => $news['published_at'],
            ]);
        }
    }
}
