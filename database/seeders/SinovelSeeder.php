<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Genre;
use App\Models\Novel;
use Illuminate\Database\Seeder;

class SinovelSeeder extends Seeder
{
    public function run(): void
    {
        // Genre untuk halaman "Pilih Genre" saat register
        $genreList = [
            'Romansa',
            'Fiksi Remaja',
            'Fiksi Penggemar',
            'Fantasi',
            'Acak',
            'Cerita Pendek',
            'Fiksi Umum',
            'ChickLit',
            'Humor',
            'Aksi',
            'Misteri',
            'Thriller',
            'Spiritual',
            'Fiksi Sejarah',
            'Nonfiksi',
            'Fiksi Ilmiah',
            'Petualangan',
            'Horor',
            'Vampir',
            'Manusia Serigala',
            'Paranormal',
            'Puisi',
            'Klasik',
        ];
        foreach ($genreList as $name) {
            Genre::firstOrCreate(['name' => $name]);
        }

        // Data novel (sama dengan data dummy di aplikasi Flutter)
        $novels = [
            [
                'title' => 'Ruang Untuk Pulang',
                'author' => 'Sena Mahardika',
                'cover' => 'ruang_untuk_pulang.png',
                'status' => 'Semua Umur • Bersambung',
                'views' => 128000,
                'likes' => 12000,
                'rating' => 4.7,
                'synopsis' => 'Bagi Sena, apartemen kecil di lantai tiga itu bukan sekadar tempat berteduh — ada Milo si kucing belang, rak buku penuh cerita, dan aroma kopi yang selalu menemani senja. Sampai suatu hari dia sadar, rumah sebenarnya bukan soal empat dinding, tapi soal siapa yang membuatnya merasa pulang.',
                'genres' => ['Slice of Life', 'Healing', 'Family'],
                'chapters' => [
                    ['Bab 1: Jendela yang Sama', 'Sena menyandarkan dagu di atas tumpukan bantal, mengamati Milo yang duduk tenang di ambang jendela, seolah ikut menunggu matahari tenggelam. Langit sore itu berwarna jingga keemasan, menyusup lewat sela dedaunan yang menjuntai dari pot gantung.

Di atas meja kerja, secangkir kopi masih mengepul pelan. Sena tersenyum kecil, mengingat perkataan ibunya bertahun-tahun lalu: rumah bukan tentang seberapa besar ruangnya, tapi seberapa hangat rasanya saat kau kembali.'],
                    ['Bab 2: Surat Lama', 'Bab ini akan segera hadir. Nantikan kelanjutannya!'],
                    ['Bab 3: Percakapan di Dapur', 'Bab ini akan segera hadir. Nantikan kelanjutannya!'],
                ],
            ],
            [
                'title' => 'Langit Setelah Senja',
                'author' => 'Alya Pramesti',
                'cover' => 'langit_setelah_senja.png',
                'status' => 'Semua Umur • Bersambung',
                'views' => 540000,
                'likes' => 38000,
                'rating' => 4.8,
                'synopsis' => 'Kala dan Raga bertemu tanpa sengaja di atap gedung yang sama, dua kali dalam hidup yang berbeda. Antara deru kota dan langit yang perlahan berubah warna, mereka belajar bahwa beberapa pertemuan memang butuh waktu untuk menemukan momennya yang tepat.',
                'genres' => ['Romance', 'Drama', 'School Life'],
                'chapters' => [
                    ['Bab 1: Pertemuan Kedua', 'Raga tidak menyangka akan berdiri di tempat yang sama lagi — atap gedung tempat dulu ia dan Kala pertama kali bicara, tiga tahun lalu. Kini langit di atas kota mulai berganti warna, dari biru gelap menuju jingga keunguan yang menyilaukan.

"Kamu masih suka ke sini?" suara Kala mengejutkannya dari belakang. Raga menoleh, dan untuk sesaat, waktu terasa berhenti — seolah kota di bawah mereka menunggu jawaban yang sama-sama mereka takutkan.'],
                    ['Bab 2: Nomor yang Hilang', 'Bab ini akan segera hadir. Nantikan kelanjutannya!'],
                    ['Bab 3: Hujan Pertama', 'Bab ini akan segera hadir. Nantikan kelanjutannya!'],
                ],
            ],
            [
                'title' => 'Someone Like You',
                'author' => 'Nara Putri',
                'cover' => 'someone_like_you.png',
                'status' => 'Semua Umur • Bersambung',
                'views' => 1020000,
                'likes' => 44000,
                'rating' => 4.7,
                'synopsis' => 'Tujuh tahun setelah perpisahan yang canggung, Alika dan Damar dipertemukan kembali di pernikahan sahabat mereka. Di antara tawa tamu dan lagu yang mengalun pelan, keduanya harus memutuskan: membiarkan masa lalu tetap masa lalu, atau memberi cinta mereka kesempatan kedua.',
                'genres' => ['Teen Fiction', 'Romance', 'Friendship'],
                'chapters' => [
                    ['Bab 1: Tamu Tak Terduga', 'Alika nyaris menjatuhkan gelasnya saat melihat Damar berdiri di seberang ruangan, mengenakan jas abu-abu yang membuatnya terlihat lebih dewasa dari yang Alika ingat. Tujuh tahun berlalu, tapi caranya menyisir rambut ke belakang dengan jari masih sama persis.

"Aku nggak nyangka kita bakal ketemu lagi kayak gini," ucap Damar sambil mendekat, senyumnya sedikit ragu. Alika menahan napas, mencoba mencari kata yang tepat di antara ribuan yang selama ini tak pernah sempat ia ucapkan.'],
                    ['Bab 2: Dansa Terakhir', 'Bab ini akan segera hadir. Nantikan kelanjutannya!'],
                    ['Bab 3: Pesan yang Tertunda', 'Bab ini akan segera hadir. Nantikan kelanjutannya!'],
                ],
            ],
            [
                'title' => 'Jejak yang Tertinggal',
                'author' => 'Dimas Arka',
                'cover' => 'jejak_yang_tertinggal.png',
                'status' => 'Semua Umur • Bersambung',
                'views' => 86000,
                'likes' => 9000,
                'rating' => 4.6,
                'synopsis' => 'Arka berhenti di sebuah stasiun kecil tengah malam, menunggu kereta terakhir yang tak kunjung datang. Di peron yang basah oleh hujan, ingatan-ingatan yang selama ini ia hindari perlahan kembali, memaksanya menghadapi apa yang selama ini ia tinggalkan.',
                'genres' => ['Drama', 'Slice of Life', 'Mystery'],
                'chapters' => [
                    ['Bab 1: Peron Kosong', 'Jam di peron menunjukkan pukul sebelas malam lebih tujuh menit. Arka menyelipkan tangan ke dalam saku jaketnya, menahan dingin yang menyusup lewat rel basah bekas hujan sore tadi. Kereta terakhir seharusnya sudah lewat sepuluh menit lalu.

Ia menatap papan pengumuman keberangkatan, lalu ke arah rel yang menghilang di kegelapan. Entah kenapa, stasiun sepi ini mengingatkannya pada satu malam lain, bertahun-tahun lalu, saat ia memutuskan pergi tanpa sempat berpamitan.'],
                    ['Bab 2: Panggilan Tak Terjawab', 'Bab ini akan segera hadir. Nantikan kelanjutannya!'],
                    ['Bab 3: Kembali ke Kota Lama', 'Bab ini akan segera hadir. Nantikan kelanjutannya!'],
                ],
            ],
            [
                'title' => 'Nebula Hati',
                'author' => 'Keisha Anindya',
                'cover' => 'nebula_hati.png',
                'status' => 'Semua Umur • Bersambung',
                'views' => 212000,
                'likes' => 21000,
                'rating' => 4.9,
                'synopsis' => 'Bagi Luna, atap rumah neneknya adalah satu-satunya tempat ia bisa benar-benar jujur — pada langit, dan pada dirinya sendiri. Di bawah taburan bintang dan serpihan galaksi yang terlihat samar, ia mulai belajar mengenali perasaan yang selama ini ia sembunyikan.',
                'genres' => ['Fantasy', 'Romance', 'Adventure'],
                'chapters' => [
                    ['Bab 1: Langit yang Mendengarkan', 'Luna berbaring di atas genteng yang masih hangat sisa siang, menatap langit yang perlahan dipenuhi bintang. Dari kejauhan, lampu-lampu kota berkelip pelan, seolah ikut menjawab pertanyaan-pertanyaan yang tak pernah ia ucapkan pada siapa pun.

Ia menghela napas panjang. Ada nama yang terus muncul di pikirannya belakangan ini, dan untuk pertama kalinya, Luna tidak buru-buru menepisnya. Mungkin, pikirnya, bintang jatuh bukan cuma soal harapan — tapi juga soal keberanian untuk mengakui apa yang sebenarnya kau inginkan.'],
                    ['Bab 2: Teleskop Tua', 'Bab ini akan segera hadir. Nantikan kelanjutannya!'],
                    ['Bab 3: Nama di Buku Harian', 'Bab ini akan segera hadir. Nantikan kelanjutannya!'],
                ],
            ],
            [
                'title' => 'Aurora Purnama',
                'author' => 'Farel Nandana',
                'cover' => 'aurora_purnama.png',
                'status' => 'Semua Umur • Bersambung',
                'views' => 305000,
                'likes' => 27000,
                'rating' => 4.8,
                'synopsis' => 'Putri Aurora dari Kerajaan Waharaja selalu diajarkan bahwa purnama membawa berkah. Namun malam ini, di bawah cahaya bulan penuh yang sama, ia menemukan rahasia lama kerajaannya — rahasia yang akan mengubah segalanya, termasuk takdirnya sendiri.',
                'genres' => ['Fantasy', 'Magic', 'Adventure'],
                'chapters' => [
                    ['Bab 1: Cahaya di Balkon Utara', 'Aurora berdiri di balkon utara istana, membiarkan angin malam menerbangkan ujung gaunnya. Purnama malam itu tampak lebih besar dari biasanya, menyinari seluruh kota di bawah kaki bukit hingga ke tepi laut.

Di tangannya tergenggam sepucuk surat tua yang baru saja ia temukan di perpustakaan kerajaan — surat yang seharusnya tak pernah ia baca. Tapi sekarang, dengan cahaya bulan sebagai saksi, Aurora tahu ia tidak bisa lagi berpura-pura tidak tahu.'],
                    ['Bab 2: Ramalan yang Terkubur', 'Bab ini akan segera hadir. Nantikan kelanjutannya!'],
                    ['Bab 3: Jubah Sang Penjaga', 'Bab ini akan segera hadir. Nantikan kelanjutannya!'],
                ],
            ],
        ];

        foreach ($novels as $data) {
            $novel = Novel::updateOrCreate(
                ['title' => $data['title']],
                [
                    'author' => $data['author'],
                    'cover' => $data['cover'],
                    'status' => $data['status'],
                    'views' => $data['views'],
                    'likes' => $data['likes'],
                    'rating' => $data['rating'],
                    'synopsis' => $data['synopsis'],
                ]
            );

            $genreIds = [];
            foreach ($data['genres'] as $name) {
                $genreIds[] = Genre::firstOrCreate(['name' => $name])->id;
            }
            $novel->genres()->sync($genreIds);

            foreach ($data['chapters'] as $i => [$title, $content]) {
                Chapter::updateOrCreate(
                    ['novel_id' => $novel->id, 'number' => $i + 1],
                    ['title' => $title, 'content' => $content]
                );
            }
        }
    }
}