<?php

namespace Database\Seeders;

use App\Models\task_type;
use Illuminate\Database\Seeder;

class TaskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            // 'لايحة إعتراضيه',
            // 'مذكرة',
            // 'خطاب',
            // 'إلتماس إعادة النظر',

'جلسات',
'مرفقات',
        ];
   // for update data commit olde and open new and udate admin user
        foreach ($types as $type) {
             task_type::create(['type' => $type]);
        }
    }
}
