<?php

namespace Database\Seeders;

use App\Models\task_status;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'منجزة',
            'غير منجزه',



        ];
   // for update data commit olde and open new and udate admin user
        foreach ($types as $type) {
             task_status::create(['status' => $type]);
        }
    }
}
