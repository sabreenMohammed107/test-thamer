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
        'regulation_id',
        'attachment_id',
        'diary_id',
        'letter_id',
        'petition_id',
        'transfer_case_id',
        'session_id',
        'control_by_id'
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

    public function regulation()
    {
        return $this->belongsTo('App\Models\Interceptions_regulation','regulation_id');
    }

    public function attachment()
    {
        return $this->belongsTo('App\Models\Attachment','attachment_id');
    }
    public function diary()
    {
        return $this->belongsTo('App\Models\Diary','diary_id');
    }

    public function letter()
    {
        return $this->belongsTo('App\Models\Letter','letter_id');
    }

    public function petition()
    {
        return $this->belongsTo('App\Models\Petition','petition_id');
    }

    public function transfer()
    {
        return $this->belongsTo('App\Models\User','transfer_case_id');
    }
    public function session()
    {
        return $this->belongsTo('App\Models\Session','session_id');
    }

    public function control()
    {
        return $this->belongsTo('App\Models\User','control_by_id');
    }
}
