<?php

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MakeBanksampahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        DB::table('statuses')->insert([
            ['name' => 'Bronze'],
            ['name' => 'Silver'],
            ['name' => 'Gold'],
            ['name' => 'Platinum'],
            ['name' => 'Aktif'],
            ['name' => 'Non-aktif'],
            ['name' => 'Dijemput'],
            ['name' => 'Diproses'],
            ['name' => 'Selesai'],
            ['name' => 'Belum Selesai'],
            ['name' => 'Reject'],
            ['name' => 'Belum Dikonfirmasi'],
            ['name' => 'Belum Dijemput'],
            ['name' => 'Ditolak'],
            ['name' => 'Menunggu Pembayaran'],
            ['name' => 'Dibatalkan'],
            ['name' => 'Tertunda'],
        ]);

        DB::table('jenissampahs')->insert([
            ['type' => 'Plastik', 'description' => 'Bahan-bahan yang terbuat dari plastik baik itu jenis PP, PET, HDPE, dll.'],
            ['type' => 'Kertas', 'description' => 'Bahan-bahan yang terbuat dari kertas contohnya kertas putih, kertas buram, arsip dll.'],
            ['type' => 'Logam', 'description' => 'Bahan-bahan yang terbuat dari logam seperti besi, alumunium, seng dll.'],
            ['type' => 'Kaca/Beling', 'description' => 'Bahan-bahan yang terbuat dari kaca.'],
            ['type' => 'Lain-lain', 'description' => 'Bahan-bahan selain jenis yang disebutkan.'],
        ]);

        DB::table('alamats')->insert([
            /*[
                'address' => 'GBA I 48',
                'postal_code' => '40288',
                'city' => 'Kab. Bandung',
                'urban' => 'Bojongsoang',
                'districts' => 'Bojongsoang',
                'longitude' => 107.654053,
                'latitude' => -6.968590,
                'postal_code' => 40288,
                'created_at' => now(),
                'updated_at' => now(),
            ],*/
            [
                'address' => 'Fakultas Ilmu Terapan',
                'postal_code' => '40245',
                'city' => 'Kab. Bandung',
                'urban' => 'Sukapura',
                'districts' => 'Dayeuhkolot',
                'longitude' => 107.632584,
                'latitude' => -6.973212,
                'postal_code' => 40388,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'Fakultas Ilmu Terapan',
                'postal_code' => '40245',
                'city' => 'Kab. Bandung',
                'urban' => 'Sukapura',
                'districts' => 'Dayeuhkolot',
                'longitude' => 107.632584,
                'latitude' => -6.973212,
                'postal_code' => 40388,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'Fakultas Ilmu Terapan',
                'postal_code' => '40245',
                'city' => 'Kab. Bandung',
                'urban' => 'Sukapura',
                'districts' => 'Dayeuhkolot',
                'longitude' => 107.632584,
                'latitude' => -6.973212,
                'postal_code' => 40388,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'Fakultas Ilmu Terapan',
                'postal_code' => '40245',
                'city' => 'Kab. Bandung',
                'urban' => 'Sukapura',
                'districts' => 'Dayeuhkolot',
                'longitude' => 107.632584,
                'latitude' => -6.973212,
                'postal_code' => 40388,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'Fakultas Ilmu Terapan',
                'postal_code' => '40245',
                'city' => 'Kab. Bandung',
                'urban' => 'Sukapura',
                'districts' => 'Dayeuhkolot',
                'longitude' => 107.632584,
                'latitude' => -6.973212,
                'postal_code' => 40388,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'Fakultas Ilmu Terapan',
                'postal_code' => '40245',
                'city' => 'Kab. Bandung',
                'urban' => 'Sukapura',
                'districts' => 'Dayeuhkolot',
                'longitude' => 107.632584,
                'latitude' => -6.973212,
                'postal_code' => 40388,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'Fakultas Ilmu Terapan',
                'postal_code' => '40245',
                'city' => 'Kab. Bandung',
                'urban' => 'Sukapura',
                'districts' => 'Dayeuhkolot',
                'longitude' => 107.632584,
                'latitude' => -6.973212,
                'postal_code' => 40388,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            /*[
                'address' => 'Jl. Terusan Bojongsoang No.174',
                'postal_code' => '40375',
                'city' => 'Kab. Bandung',
                'urban' => 'Bojongsoang',
                'districts' => 'Bojongsoang',
                'longitude' => 107.6306021,
                'latitude' => -6.9944206,
                'postal_code' => 40488,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'kp.curug dog dog gang.H.Sarbini Rt.01/02 no.23',
                'postal_code' => '40227',
                'city' => 'Kab. Bandung',
                'urban' => 'Sukamenak',
                'districts' => 'Margahayu',
                'postal_code' => 40588,
                'longitude' => 107.5790024,
                'latitude' => -6.9728639,
                'created_at' => now(),
                'updated_at' => now(),
            ],*/
        ]);

        DB::table('users')->insert([
            [
                'username' => 'fitberseri',
                'email' => 'andihabil1004@gmail.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '08134567890',
                'email_verified_at' => now(),
                'status_id' => 5,
                'alamat_id' => 1,
            ],
            [
                'username' => 'banksampah1',
                'email' => 'bs1@gmail.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '08123456789',
                'email_verified_at' => now(),
                'status_id' => 5,
                'alamat_id' => 2,
            ],
            [
                'username' => 'banksampah2',
                'email' => 'bs2@gmail.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '08112345678',
                'email_verified_at' => now(),
                'status_id' => 5,
                'alamat_id' => 3,
            ],
            [
                'username' => 'banksampah3',
                'email' => 'bs3@gmail.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '08156985884',
                'email_verified_at' => now(),
                'status_id' => 5,
                'alamat_id' => 4,
            ],
            [
                'username' => 'banksampah4',
                'email' => 'bs4@gmail.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '08174455434',
                'email_verified_at' => now(),
                'status_id' => 5,
                'alamat_id' => 5,
            ],
            [
                'username' => 'banksampah5',
                'email' => 'bs5@gmail.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '08166664444',
                'email_verified_at' => now(),
                'status_id' => 5,
                'alamat_id' => 6,
            ],
            /*[
                'username' => 'ecovillage',
                'email' => 'bpj@bj.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '081342232322',
                'email_verified_at' => now(),
                'status_id' => 5,
                'alamat_id' => 4,
            ],*/
            /*[
                'username' => 'pualam',
                'email' => 'pual@lam.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '081340282873',
                'email_verified_at' => now(),
                'status_id' => 5,
                'alamat_id' => 1,
            ],
            [
                'username' => 'steven',
                'email' => 'ste@ven.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '081320282873',
                'email_verified_at' => now(),
                'status_id' => 5,
                'alamat_id' => 2,
            ],*/
        ]);

        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@ven.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
            'activated_at' => now(),
            'status_id' => 5,
        ]);

        /*DB::table('nasabahs')->insert([
            [
                'name' => 'Pualam',
                'gender' => 'L',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Steven',
                'gender' => 'L',
                'user_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);*/

        DB::table('banksampahs')->insert([
            [
                'name' => 'Bank Sampah FIT Berseri',
                'user_id' => 1,
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bank Sampah 1',
                'user_id' => 2,
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bank Sampah 2',
                'user_id' => 3,
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bank Sampah 3',
                'user_id' => 4,
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bank Sampah 4',
                'user_id' => 5,
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bank Sampah 5',
                'user_id' => 6,
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            /*[
                'name' => 'Bank Sampah Eco Village Sukaberseri',
                'user_id' => 2,
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],*/
        ]);

        /*DB::table('jadwals')->insert([
            [
                'weeks' => '1;3',
                'days' => '2,4;1,3',
                'nasabah_id' => 1,
                'banksampah_id' => 1,
                'status_id' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'weeks' => '2;4',
                'days' => '2;3',
                'nasabah_id' => 2,
                'banksampah_id' => 1,
                'status_id' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);*/

        DB::table('banks')->insert([
            [
                "name" => "BANK BRI",
                "code" => "002"
            ],
            [
                "name" => "BANK EKSPOR INDONESIA",
                "code" => "003"
            ],
            [
                "name" => "BANK MANDIRI",
                "code" => "008"
            ],
            [
                "name" => "BANK BNI",
                "code" => "009"
            ],
            [
                "name" => "BANK DANAMON",
                "code" => "011"
            ],
            [
                "name" => "PERMATA BANK",
                "code" => "013"
            ],
            [
                "name" => "BANK BCA",
                "code" => "014"
            ],
            [
                "name" => "BANK BII",
                "code" => "016"
            ],
            [
                "name" => "BANK PANIN",
                "code" => "019"
            ],
            [
                "name" => "BANK ARTA NIAGA KENCANA",
                "code" => "020"
            ],
            [
                "name" => "BANK NIAGA",
                "code" => "022"
            ],
            [
                "name" => "BANK BUANA IND",
                "code" => "023"
            ],
            [
                "name" => "BANK LIPPO",
                "code" => "026"
            ],
            [
                "name" => "BANK NISP",
                "code" => "028"
            ],
            [
                "name" => "AMERICAN EXPRESS BANK LTD",
                "code" => "030"
            ],
            [
                "name" => "CITIBANK N.A.",
                "code" => "031"
            ],
            [
                "name" => "JP. MORGAN CHASE BANK, N.A.",
                "code" => "032"
            ],
            [
                "name" => "BANK OF AMERICA, N.A",
                "code" => "033"
            ],
            [
                "name" => "ING INDONESIA BANK",
                "code" => "034"
            ],
            [
                "name" => "BANK MULTICOR TBK.",
                "code" => "036"
            ],
            [
                "name" => "BANK ARTHA GRAHA",
                "code" => "037"
            ],
            [
                "name" => "BANK CREDIT AGRICOLE INDOSUEZ",
                "code" => "039"
            ],
            [
                "name" => "THE BANGKOK BANK COMP. LTD",
                "code" => "040"
            ],
            [
                "name" => "THE HONGKONG & SHANGHAI B.C.",
                "code" => "041"
            ],
            [
                "name" => "THE BANK OF TOKYO MITSUBISHI UFJ LTD",
                "code" => "042"
            ],
            [
                "name" => "BANK SUMITOMO MITSUI INDONESIA",
                "code" => "045"
            ],
            [
                "name" => "BANK DBS INDONESIA",
                "code" => "046"
            ],
            [
                "name" => "BANK RESONA PERDANIA",
                "code" => "047"
            ],
            [
                "name" => "BANK MIZUHO INDONESIA",
                "code" => "048"
            ],
            [
                "name" => "STANDARD CHARTERED BANK",
                "code" => "050"
            ],
            [
                "name" => "BANK ABN AMRO",
                "code" => "052"
            ],
            [
                "name" => "BANK KEPPEL TATLEE BUANA",
                "code" => "053"
            ],
            [
                "name" => "BANK CAPITAL INDONESIA, TBK.",
                "code" => "054"
            ],
            [
                "name" => "BANK BNP PARIBAS INDONESIA",
                "code" => "057"
            ],
            [
                "name" => "BANK UOB INDONESIA",
                "code" => "058"
            ],
            [
                "name" => "KOREA EXCHANGE BANK DANAMON",
                "code" => "059"
            ],
            [
                "name" => "RABOBANK INTERNASIONAL INDONESIA",
                "code" => "060"
            ],
            [
                "name" => "ANZ PANIN BANK",
                "code" => "061"
            ],
            [
                "name" => "DEUTSCHE BANK AG.",
                "code" => "067"
            ],
            [
                "name" => "BANK WOORI INDONESIA",
                "code" => "068"
            ],
            [
                "name" => "BANK OF CHINA LIMITED",
                "code" => "069"
            ],
            [
                "name" => "BANK BUMI ARTA",
                "code" => "076"
            ],
            [
                "name" => "BANK EKONOMI",
                "code" => "087"
            ],
            [
                "name" => "BANK ANTARDAERAH",
                "code" => "088"
            ],
            [
                "name" => "BANK HAGA",
                "code" => "089"
            ],
            [
                "name" => "BANK IFI",
                "code" => "093"
            ],
            [
                "name" => "BANK CENTURY, TBK.",
                "code" => "095"
            ],
            [
                "name" => "BANK MAYAPADA",
                "code" => "097"
            ],
            [
                "name" => "BANK JABAR",
                "code" => "110"
            ],
            [
                "name" => "BANK DKI",
                "code" => "111"
            ],
            [
                "name" => "BPD DIY",
                "code" => "112"
            ],
            [
                "name" => "BANK JATENG",
                "code" => "113"
            ],
            [
                "name" => "BANK JATIM",
                "code" => "114"
            ],
            [
                "name" => "BPD JAMBI",
                "code" => "115"
            ],
            [
                "name" => "BPD ACEH",
                "code" => "116"
            ],
            [
                "name" => "BANK SUMUT",
                "code" => "117"
            ],
            [
                "name" => "BANK NAGARI",
                "code" => "118"
            ],
            [
                "name" => "BANK RIAU",
                "code" => "119"
            ],
            [
                "name" => "BANK SUMSEL",
                "code" => "120"
            ],
            [
                "name" => "BANK LAMPUNG",
                "code" => "121"
            ],
            [
                "name" => "BPD KALSEL",
                "code" => "122"
            ],
            [
                "name" => "BPD KALIMANTAN BARAT",
                "code" => "123"
            ],
            [
                "name" => "BPD KALTIM",
                "code" => "124"
            ],
            [
                "name" => "BPD KALTENG",
                "code" => "125"
            ],
            [
                "name" => "BPD SULSEL",
                "code" => "126"
            ],
            [
                "name" => "BANK SULUT",
                "code" => "127"
            ],
            [
                "name" => "BPD NTB",
                "code" => "128"
            ],
            [
                "name" => "BPD BALI",
                "code" => "129"
            ],
            [
                "name" => "BANK NTT",
                "code" => "130"
            ],
            [
                "name" => "BANK MALUKU",
                "code" => "131"
            ],
            [
                "name" => "BPD PAPUA",
                "code" => "132"
            ],
            [
                "name" => "BANK BENGKULU",
                "code" => "133"
            ],
            [
                "name" => "BPD SULAWESI TENGAH",
                "code" => "134"
            ],
            [
                "name" => "BANK SULTRA",
                "code" => "135"
            ],
            [
                "name" => "BANK NUSANTARA PARAHYANGAN",
                "code" => "145"
            ],
            [
                "name" => "BANK SWADESI",
                "code" => "146"
            ],
            [
                "name" => "BANK MUAMALAT",
                "code" => "147"
            ],
            [
                "name" => "BANK MESTIKA",
                "code" => "151"
            ],
            [
                "name" => "BANK METRO EXPRESS",
                "code" => "152"
            ],
            [
                "name" => "BANK SHINTA INDONESIA",
                "code" => "153"
            ],
            [
                "name" => "BANK MASPION",
                "code" => "157"
            ],
            [
                "name" => "BANK HAGAKITA",
                "code" => "159"
            ],
            [
                "name" => "BANK GANESHA",
                "code" => "161"
            ],
            [
                "name" => "BANK WINDU KENTJANA",
                "code" => "162"
            ],
            [
                "name" => "HALIM INDONESIA BANK",
                "code" => "164"
            ],
            [
                "name" => "BANK HARMONI INTERNATIONAL",
                "code" => "166"
            ],
            [
                "name" => "BANK KESAWAN",
                "code" => "167"
            ],
            [
                "name" => "BANK TABUNGAN NEGARA (PERSERO)",
                "code" => "200"
            ],
            [
                "name" => "BANK HIMPUNAN SAUDARA 1906, TBK .",
                "code" => "212"
            ],
            [
                "name" => "BANK TABUNGAN PENSIUNAN NASIONAL",
                "code" => "213"
            ],
            [
                "name" => "BANK SWAGUNA",
                "code" => "405"
            ],
            [
                "name" => "BANK JASA ARTA",
                "code" => "422"
            ],
            [
                "name" => "BANK MEGA",
                "code" => "426"
            ],
            [
                "name" => "BANK JASA JAKARTA",
                "code" => "427"
            ],
            [
                "name" => "BANK BUKOPIN",
                "code" => "441"
            ],
            [
                "name" => "BANK SYARIAH MANDIRI",
                "code" => "451"
            ],
            [
                "name" => "BANK BISNIS INTERNASIONAL",
                "code" => "459"
            ],
            [
                "name" => "BANK SRI PARTHA",
                "code" => "466"
            ],
            [
                "name" => "BANK JASA JAKARTA",
                "code" => "472"
            ],
            [
                "name" => "BANK BINTANG MANUNGGAL",
                "code" => "484"
            ],
            [
                "name" => "BANK BUMIPUTERA",
                "code" => "485"
            ],
            [
                "name" => "BANK YUDHA BHAKTI",
                "code" => "490"
            ],
            [
                "name" => "BANK MITRANIAGA",
                "code" => "491"
            ],
            [
                "name" => "BANK AGRO NIAGA",
                "code" => "494"
            ],
            [
                "name" => "BANK INDOMONEX",
                "code" => "498"
            ],
            [
                "name" => "BANK ROYAL INDONESIA",
                "code" => "501"
            ],
            [
                "name" => "BANK ALFINDO",
                "code" => "503"
            ],
            [
                "name" => "BANK SYARIAH MEGA",
                "code" => "506"
            ],
            [
                "name" => "BANK INA PERDANA",
                "code" => "513"
            ],
            [
                "name" => "BANK HARFA",
                "code" => "517"
            ],
            [
                "name" => "PRIMA MASTER BANK",
                "code" => "520"
            ],
            [
                "name" => "BANK PERSYARIKATAN INDONESIA",
                "code" => "521"
            ],
            [
                "name" => "BANK AKITA",
                "code" => "525"
            ],
            [
                "name" => "LIMAN INTERNATIONAL BANK",
                "code" => "526"
            ],
            [
                "name" => "ANGLOMAS INTERNASIONAL BANK",
                "code" => "531"
            ],
            [
                "name" => "BANK DIPO INTERNATIONAL",
                "code" => "523"
            ],
            [
                "name" => "BANK KESEJAHTERAAN EKONOMI",
                "code" => "535"
            ],
            [
                "name" => "BANK UIB",
                "code" => "536"
            ],
            [
                "name" => "BANK ARTOS IND",
                "code" => "542"
            ],
            [
                "name" => "BANK PURBA DANARTA",
                "code" => "547"
            ],
            [
                "name" => "BANK MULTI ARTA SENTOSA",
                "code" => "548"
            ],
            [
                "name" => "BANK MAYORA",
                "code" => "553"
            ],
            [
                "name" => "BANK INDEX SELINDO",
                "code" => "555"
            ],
            [
                "name" => "BANK VICTORIA INTERNATIONAL",
                "code" => "566"
            ],
            [
                "name" => "BANK EKSEKUTIF",
                "code" => "558"
            ],
            [
                "name" => "CENTRATAMA NASIONAL BANK",
                "code" => "559"
            ],
            [
                "name" => "BANK FAMA INTERNASIONAL",
                "code" => "562"
            ],
            [
                "name" => "BANK SINAR HARAPAN BALI",
                "code" => "564"
            ],
            [
                "name" => "BANK HARDA",
                "code" => "567"
            ],
            [
                "name" => "BANK FINCONESIA",
                "code" => "945"
            ],
            [
                "name" => "BANK MERINCORP",
                "code" => "946"
            ],
            [
                "name" => "BANK MAYBANK INDOCORP",
                "code" => "947"
            ],
            [
                "name" => "BANK OCBC – INDONESIA",
                "code" => "948"
            ],
            [
                "name" => "BANK CHINA TRUST INDONESIA",
                "code" => "949"
            ],
            [
                "name" => "BANK COMMONWEALTH",
                "code" => "950"
            ]
        ]);
    }
}
