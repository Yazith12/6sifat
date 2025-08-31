<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Arrays containing titles, contents, and image URLs 
        $titles = [
            "Kalimah Toyyibah",
            "Solat Khusyuk & Khudu",
            "Ilmu dan Zikir",
            "Ikram Muslimin", 
            "Ikhlas & Niat",
            "Dakwah & Tabligh"
        ];

        $contents = [
            "Untuk keluarkan keyakinan yang salah daripada hati kita bahawa makhluk tidak berkuasa dan masukkan keyakinan yang betul ke dalam hati kita bahawa hanya Allah Taa'la yang berkuasa.",
            "Untuk mendapat manfaat langsung daripada kudrat Allah swt kita hendaklah mentaati segala perintah Allah swt dengan cara Nabi saw. Amalan yang paling penting dan paling asas di antara perintah-perintah Allah swt ialah solat.",
            "Untuk mendapat manfaat langsung daripada zat Allah swt kita hendaklah mentaati segala perintah Allah swt dengan cara yang ditunjukkan Nabi saw. Untuk itu, kita mesti mempelajari ilmu agama yakni memastikan bahawa dalam keadaan tertentu ini, apakah yang Allah swt inginkan dari saya?",
            "Menyempurnakan dengan penuh tanggungjawab perintah-perintah Allah swt yang ber-kaitan dengan hamba-hamba Allah swt yang lain dengan cara Nabi saw dan dalam hal itu hendaklah mengambil kira kedudukan dan kemuliaan orang Islam.",
            "Menyempurnakan perintah-perintah Allah swt semata-mata untuk mendapat keredaanNya.",
            "Kita nak  bawa dakwah cara nabi saw ke seluruh pelusuk alam untuk islah yakin dan amal kita dengan mengajak orang lain untuk maksud dan tujuan yang sama."
        ];

        $img_urls = [
            "https://www.editormalaysia.com/wp-content/uploads/2018/08/tab1.jpg",
            "https://newsroom.iium.edu.my/wp-content/uploads/2021/03/Screenshot_8-2.jpg",
            "https://res.cloudinary.com/ddhaiaedw/image/upload/v1756137196/rumman-amin-i1bfxi1cFBY-unsplash_lxwe0i.jpg",
            "https://res.cloudinary.com/ddhaiaedw/image/upload/v1756395666/9e46ac22b3ff3a4f15dfdbea8ba5c523_tlgsbp.jpg",
            "https://res.cloudinary.com/ddhaiaedw/image/upload/v1756396670/744c186f5f463c771b55514ede1c5ff4_mj1mda.jpg",
            "https://res.cloudinary.com/ddhaiaedw/image/upload/v1756396670/744c186f5f463c771b55514ede1c5ff4_mj1mda.jpg"
        ];
        
        $captions = [
            "Sifat 1",
            "Sifat 2",
            "Sifat 3",
            "Sifat 4",
            "Sifat 5",
            "Sifat 6"
        ];

        $video_urls = [
        "Laa ilaaha illallah muhammadurrasulullah

            (Maksud): Tiada yang berhak disembah melainkan Allah SWT, dan Nabi Muhammad SAW adalah utusan Allah.

            (Maksud) Laa ilaaha illallah: Mengeluarkan keyakinan makhluk dari dalam hati, dan memasukkan keyakinan hanya kepada Allah SWT dalam hati.

            Kelebihan (Fadhilat):

            1. Daripada Abu Dzar r.a, Nabi SAW bersabda: “Tidak ada seorang hamba pun yang mengucapkan Laa ilaaha illallah, kemudian dia mati di atas keyakinan tersebut, melainkan dia akan masuk syurga.” (HR. Bukhari)
            2. Daripada Abu Bakar As-Siddiq r.a, Nabi SAW bersabda: “Barangsiapa yang bersaksi tiada tuhan yang berhak disembah melainkan Allah dengan sepenuh hatinya, maka dia akan masuk syurga dari mana-mana pintu yang dia kehendaki.” (HR. Abu Ya’la)
            3. Daripada Ali r.a, Nabi SAW bersabda: Allah SWT berfirman dalam hadis qudsi: “Sesungguhnya Aku adalah Allah, tiada yang berhak disembah melainkan Aku. Barangsiapa mengakui ke-Esaan-Ku maka dia masuk dalam benteng-Ku. Barangsiapa masuk dalam benteng-Ku, maka dia selamat daripada azab-Ku.” (HR. Sairoji)
            4. Sekecil-kecil iman dalam hati, Allah akan berikan syurga yang luasnya sepuluh kali dunia.

            (Cara untuk memperolehnya):

            1. Berdakwah tentang pentingnya iman dan keyakinan.
            2. Berlatih dengan memperbanyakkan halaqah atau majlis iman dan keyakinan (sama ada dengan berbicara atau mendengar).
            3. Berdoa kepada Allah agar dikurniakan hakikat iman dan keyakinan.
            
            (Maksud) Muhammadarrasulullah

            Meyakini hanya satu-satunya jalan untuk mencapai kejayaan dunia dan akherat hanya
            dengan cara ikut sunnah Rasulullah Saw.

            (Fadhilah) :

            1. Dari Itban Ibnu Malik ra.dari Nabi Saw bersabda : Tidak akan masuk
            neraka atau dimakan api neraka orang yg bersaksi bahwa tidak ada yg
            berhak disembah selain Allah dan sesungguhnya saya (Muhammad saw)
            adalah utusan Allah (HR. Muslim).

            2. Dari Abu Hurairah ra.Nabi saw bersabda : Barangsiapa berpegang teguh
            dg sunahku dikala rusaknya umatku, maka baginya pahala satu orang mati
            syahid (HR.Thobrani).

            3. Barangsiapa menghidupkan sunahku, maka sungguh dia telah cinta
            padaku, dan barangsiapa telah cinta padaku, maka dia bersama aku
            didalam surga (HR. Tirmidzi)

            (Cara untuk memperolehnya) :
            1. Dakwahkan pentingnya menghidupkan sunnah Rasulullah Saw.
            2. Latihan , yaitu dengan cara menghidupkan sunnah Rasulullah Saw. Dalam
            kehidupan kita selama 24 jam.
            3. Berdoa kepada Allah agar diberikan kekuatan untuk menghidupkan
            sunnah.",
        "https://example.com/videos/solat.mp4",
        "https://example.com/videos/ilmu.mp4",
        "https://example.com/videos/ikram.mp4",
        "https://example.com/videos/ikhlas.mp4",
        "https://example.com/videos/dakwah.mp4"
        ];

        foreach ($titles as $index => $title) {
            Post::create([
                'title' => $title,
                'text' => $contents[$index],  // Changed from 'content' to 'text'
                'img_url' => $img_urls[$index],
                'video_url' => $video_urls[$index],
                'caption' => $captions[$index],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
