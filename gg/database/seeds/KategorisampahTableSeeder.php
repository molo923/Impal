<?php

use Illuminate\Database\Seeder;

class KategorisampahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategorisampahs')->insert(
            array(
                0 => array('id' => '1', 'price_rec' => 5600, 'name' => 'PP Air Mineral Gelas Bersih', 'uom' => 'Kg', 'code' => 'P5', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/P5.jpg', 'jenissampah_id' => '1', 'description' => 'Gelas Plastik Kemasan Air Mineral(Warna Bening) Yang Sudah Dipotong Tube Gelasnya', 'status_id' => 5),
                1 => array('id' => '2', 'price_rec' => 2500, 'name' => 'PP Ember Warna', 'uom' => 'Kg', 'code' => 'P7', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/P7.jpg', 'jenissampah_id' => '1', 'description' => 'Ember, Botol Oli, Jerigen, Krat, Tutup Botol Air Minum Berwarna Selain Warna Hitam dan Abu-Abu', 'status_id' => 5),
                2 => array('id' => '3', 'price_rec' => 800, 'name' => 'PP Ember Hitam', 'uom' => 'Kg', 'code' => 'P8', 'img_url' => 'http://gonigoni.id/assets/img/kategori-sampah/p8.jpg', 'jenissampah_id' => '1', 'description' => 'Ember, Botol Oli, Jerigen, Tutup Botol Air Minum Berwarna  Warna Hitam dan Abu-Abu', 'status_id' => 5),
                3 => array('id' => '4', 'price_rec' => 2300, 'name' => 'Gelas Minuman Putih (ale-ale)', 'uom' => 'Kg', 'code' => 'P9', 'img_url' => 'http://gonigoni.id/assets/img/kategori-sampah/p9.jpg', 'jenissampah_id' => '1', 'description' => 'Gelas Plastik Kemasan Minuman Berwarna', 'status_id' => 5),
                4 => array('id' => '5', 'price_rec' => 3700, 'name' => 'PET Botol Bening Bersih', 'uom' => 'Kg', 'code' => 'P12', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/P12.jpg', 'jenissampah_id' => '1', 'description' => 'Botol Plastik PET Kemasan Air Mineral (bening) Yang Sudah Bebas Dari Label dan Tutup Botol', 'status_id' => 5),
                5 => array('id' => '6', 'price_rec' => 1500, 'name' => 'PET Botol Warna Bersih', 'uom' => 'Kg', 'code' => 'P14', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/P14.jpg', 'jenissampah_id' => '1', 'description' => 'Botol Plastik PET Kemasan Minuman Warna Abu-abu dan Hijau Yang Sudah Bebas Dari Label dan Tutup Botol', 'status_id' => 5),
                6 => array('id' => '7', 'price_rec' => 5000, 'name' => 'Plastik Kresek', 'uom' => 'Kg', 'code' => 'P17', 'img_url' => 'http://gonigoni.id/assets/img/kategori-sampah/p17.jpg', 'jenissampah_id' => '1', 'description' => 'Plastik HD Lembaran dan Kantong Plastik Kresek, Plastik Minyak', 'status_id' => 5),
                7 => array('id' => '8', 'price_rec' => 2006, 'name' => 'Kerasan', 'uom' => 'Kg', 'code' => 'P20', 'img_url' => 'http://gonigoni.id/assets/img/kategori-sampah/p20.jpg', 'jenissampah_id' => '1', 'description' => 'Sampah berbentuk padat', 'status_id' => 5),
                8 => array('id' => '9', 'price_rec' => 4000, 'name' => 'Plastik Keras Bening', 'uom' => 'Kg', 'code' => 'P21', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/P21.jpg', 'jenissampah_id' => '1', 'description' => 'Toples Kue, Kemasan CD/ Cassete (warna Putih Bening)', 'status_id' => 5),
                9 => array('id' => '10', 'price_rec' => 1000, 'name' => 'PVC-1', 'uom' => 'Kg', 'code' => 'P26', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/P26.jpg', 'jenissampah_id' => '1', 'description' => 'Pipa Paralon, Talang air', 'status_id' => 5),
                10 => array('id' => '11', 'price_rec' => 3600, 'name' => 'Nylex', 'uom' => 'Kg', 'code' => 'P27', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/P27.jpg', 'jenissampah_id' => '1', 'description' => 'Selang AirSepatu Boot (Merk Ap Boots)', 'status_id' => 5),
                11 => array('id' => '12', 'price_rec' => 4800, 'name' => 'Tutup Air Galon', 'uom' => 'Kg', 'code' => 'P29', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/P29.jpg', 'jenissampah_id' => '1', 'description' => 'Tutup Air Galon', 'status_id' => 5),
                12 => array('id' => '13', 'price_rec' => 5000, 'name' => 'Galon Retak /biji', 'uom' => 'Kg', 'code' => 'P31', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/P31.jpg', 'jenissampah_id' => '1', 'description' => 'Body Galon Utuh (Tidak Ada Yang Hilang Sebagian)', 'status_id' => 5),
                13 => array('id' => '14', 'price_rec' => 6300, 'name' => 'CD/DVD/MP3/Kaset PS', 'uom' => 'Kg', 'code' => 'P32', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/P32.jpg', 'jenissampah_id' => '1', 'description' => 'CD/DVD/MP3/Kaset PS', 'status_id' => 5),
                14 => array('id' => '15', 'price_rec' => 500, 'name' => 'Karung Plastik/Karung Jelek', 'uom' => 'Kg', 'code' => 'P33', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/P33.jpg', 'jenissampah_id' => '1', 'description' => 'Karung Plastik Segala Macam Ukuran', 'status_id' => 5),
                15 => array('id' => '16', 'price_rec' => 1800, 'name' => 'Plastik Bening Lembaran Campur', 'uom' => 'Kg', 'code' => 'P37', 'img_url' => 'http://gonigoni.id/assets/img/kategori-sampah/p37.jpg', 'jenissampah_id' => '1', 'description' => 'PE, PP, OPP, Plastik Sablon', 'status_id' => 5),
                16 => array('id' => '17', 'price_rec' => 2000, 'name' => 'Plastik Kemasan Minuman Campur', 'uom' => 'Kg', 'code' => 'P38', 'img_url' => 'http://gonigoni.id/assets/img/kategori-sampah/p38.jpg', 'jenissampah_id' => '1', 'description' => 'Campuran (Aqua Gelas Kotor, Ale-ale, PET Bening, PET warna, PET Toples, PET Label, dll)', 'status_id' => 5),
                17 => array('id' => '18', 'price_rec' => 500, 'name' => 'Sampah Plastik Campur', 'uom' => 'Kg', 'code' => 'P39', 'img_url' => 'http://gonigoni.id/assets/img/kategori-sampah/p39.jpg', 'jenissampah_id' => '1', 'description' => 'Campuran (Semua Jenis Sampah Plastik) (Harga Tergantung Kg)', 'status_id' => 5),
                18 => array('id' => '19', 'price_rec' => 1900, 'name' => 'Arsip', 'uom' => 'Kg', 'code' => 'K1', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/K1.jpg', 'jenissampah_id' => '2', 'description' => 'HVS, Buku Tulis Tanpa Cover, Kertas Warna Putih Yang Sudah Dicacah Panjang', 'status_id' => 5),
                19 => array('id' => '20', 'price_rec' => 1100, 'name' => 'Kertas Buram/Koran', 'uom' => 'Kg', 'code' => 'K3', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/K3.jpg', 'jenissampah_id' => '2', 'description' => 'Kertas Koran, Kertas Buram', 'status_id' => 5),
                20 => array('id' => '21', 'price_rec' => 500, 'name' => 'Majalah/Duplek', 'uom' => 'Kg', 'code' => 'K5', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/K5.jpg', 'jenissampah_id' => '2', 'description' => 'Kertas Kemasan Makanan, Kertas Warna, Majalah, Tabloid, Buku Cetak, Kertas Buram', 'status_id' => 5),
                21 => array('id' => '22', 'price_rec' => 1300, 'name' => 'Kardus/Karton', 'uom' => 'Kg', 'code' => 'K6', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/K6.jpg', 'jenissampah_id' => '2', 'description' => 'Kardus/karton kering tidak basah', 'status_id' => 5),
                22 => array('id' => '23', 'price_rec' => 450, 'name' => 'Kertas Campur', 'uom' => 'Kg', 'code' => 'K7', 'img_url' => 'http://gonigoni.id/assets/img/kategori-sampah/k7.jpg', 'jenissampah_id' => '2', 'description' => 'Campuran(Arsip, Duplek, Karton, Kertas Buram, Cones, Selongsong)', 'status_id' => 5),
                23 => array('id' => '24', 'price_rec' => 500, 'name' => 'Duplek Telur', 'uom' => 'Kg', 'code' => 'K9', 'img_url' => 'http://gonigoni.id/assets/img/kategori-sampah/k9.jpg', 'jenissampah_id' => '2', 'description' => 'Egg Tray Khusus Telur Ayam (Tidak Sobek)', 'status_id' => 5),
                24 => array('id' => '25', 'price_rec' => 1100, 'name' => 'Seng', 'uom' => 'Kg', 'code' => 'S1', 'img_url' => 'http://gonigoni.id/assets/img/kategori-sampah/s1.jpg', 'jenissampah_id' => '3', 'description' => 'Seng Lembaran, Kaleng Susu, Kaleng Sarden, Kaleng Bekas Pewangi Ruangan', 'status_id' => 5),
                25 => array('id' => '26', 'price_rec' => 2000, 'name' => 'Besi/Paku', 'uom' => 'Kg', 'code' => 'BS2', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/BS2.jpg', 'jenissampah_id' => '3', 'description' => 'Paku Atau Besi Yang Berkarat', 'status_id' => 5),
                26 => array('id' => '27', 'price_rec' => 9000, 'name' => 'Alumunium', 'uom' => 'Kg', 'code' => 'A3', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/A3.jpg', 'jenissampah_id' => '3', 'description' => 'Kaleng Minuman, Tutup BotolBotol Parfum', 'status_id' => 5),
                27 => array('id' => '28', 'price_rec' => 35000, 'name' => 'Tembaga', 'uom' => 'Kg', 'code' => 'T1', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/T1.jpg', 'jenissampah_id' => '3', 'description' => 'Kawat tembaga', 'status_id' => 5),
                28 => array('id' => '29', 'price_rec' => 200, 'name' => 'Beling', 'uom' => 'Kg', 'code' => 'B8', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/B8.jpg', 'jenissampah_id' => '4', 'description' => 'Segala Jenis Botol dan Kaca( Kecuali Kaca Mobil / Tempered glass)', 'status_id' => 5),
                29 => array('id' => '30', 'price_rec' => 7000, 'name' => 'Accu', 'uom' => 'Kg', 'code' => 'AK1', 'img_url' => 'http://gonigoni.id/assets/img/kategori-sampah/ak1.jpg', 'jenissampah_id' => '5', 'description' => 'Accu Motor dan Accu Mobil', 'status_id' => 5),
                30 => array('id' => '31', 'price_rec' => 500, 'name' => 'Ban Mobil', 'uom' => 'Buah', 'code' => 'BN1', 'img_url' => 'http://gonigoni.id/assets/img/kat-sampah/BN1.jpg', 'jenissampah_id' => '5', 'description' => 'Selain Ban Truk', 'status_id' => 5),
            )
        );
    }
}
