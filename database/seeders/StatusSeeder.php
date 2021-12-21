<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'مفعلة',
            ' تم تحويلها للارشيف',



        ];
   // for update data commit olde and open new and udate admin user
        foreach ($types as $type) {
             Status::create(['status' => $type]);
        }
    }
}
