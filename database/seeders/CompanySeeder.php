<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\WorkUnit\Company::factory(10)->create();
        \App\Models\WorkUnit\Company::create(
            [
                'name' => 'PT Citra Marga Nusaphala Persada',
                'address' => 'Jalan Yos Sudarso Kavling No.28, RT.3/RW.11, Sunter Jaya, Tanjung Priok, RT.3/RW.11, Sunter Jaya, Kec. Tj. Priok, Jkt Utara, Daerah Khusus Ibukota Jakarta 14350',
                'slug' => str::slug('PT Citra Marga Nusaphala Persada'),
                'phone' => '021-12345678',
                'email' => 'info@legald doc.co.id',
            ],

        );

        \App\Models\WorkUnit\Company::create(

            [
                'name' => 'PT. XXXXX XXX XXX',
                'address' => 'Jl. Jend. Sudirman No.Kav. 52-53, RT.5/RW.3, Senayan, Kec. Kebayoran Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12190',
                'slug' => str::slug('PT. XXXXX XXX XXX'),
                'phone' => '021-12345678',
                'email' => 'info@legald doc.co.id',
            ],
        );
    }
}
