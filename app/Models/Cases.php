<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cases extends Model
{
    use HasFactory,SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes = ['member'];
    protected $fillable = [
        'name',
        'start_date',
        'description',
        'client_id',
        'opponent_id',
        'file_no',
        'branch_id',
        'current_resposible_id',
        'court_id',
        'exec_dision_no',
        'court_case_no',
        'client_low_description',
        'case_type_id',
        'police_escalation_no',
        'fees_type',
        'case_fees',
        'public_prosecutor_case_no',
        'circle_no',
        'expert_name',
        'case_status_id',
        'notes',
        'exec_Deed_date',
        'exec_Deed_no'
    ];
    public function type()
    {
        return $this->belongsTo('App\Models\Case_type', 'case_type_id');
    }
    public function client()
    {
        return $this->belongsTo('App\Models\Person', 'client_id');
    }

    public function oppon()
    {
        return $this->belongsTo('App\Models\Person', 'opponent_id');
    }

    public function current()
    {
        return $this->belongsTo('App\Models\User', 'current_resposible_id');
    }

    public function court()
    {
        return $this->belongsTo('App\Models\Court', 'court_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch', 'branch_id');
    }

    public function member()
    {
        return $this->hasMany('App\Models\Case_members','case_id','id');
    }

    // this is a recommended way to declare event handlers
    // public static function boot() {
    //     parent::boot();

    //     static::deleting(function($user) { // before delete() method call this
    //          $user->member()->delete();
    //          // do the rest of the cleanup...
    //     });
    // }
}
