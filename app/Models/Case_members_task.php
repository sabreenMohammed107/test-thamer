<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Case_members_task extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id',
        'member_id',
        'task_description',
        'task_type_id',
        'task_date',
        'task_status_id',
        'end_date',
        'notes',
    ];
    public function case()
    {
        return $this->belongsTo('App\Models\Cases','case_id');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\User','member_id');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\task_type','task_type_id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\task_status','task_status_id');
    }
}
