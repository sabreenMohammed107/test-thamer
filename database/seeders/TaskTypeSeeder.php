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
            'لايحة إعتراضيه',
            'مذكرة',
            'خطاب',
            'إلتماس إعادة النظر',
            'جلسات',
            'مرفقات',
            'احاله',
        ];
        // for update data commit olde and open new and udate admin user
        foreach ($types as $type) {
            task_type::create(['id'=>1,'type' => 'لايحة إعتراضيه']);
            task_type::create(['id'=>2,'type' => 'مذكرة']);
            task_type::create(['id'=>3,'type' => 'خطاب']);
            task_type::create(['id'=>4,'type' => 'إلتماس إعادة النظر']);
            task_type::create(['id'=>5,'type' => 'جلسات']);
            task_type::create(['id'=>6,'type' => 'مرفقات']);
            task_type::create(['id'=>7,'type' => 'احاله']);
        }
    }
}
