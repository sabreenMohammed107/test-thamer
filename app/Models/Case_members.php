<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Case_members extends Model
{
    use HasFactory,SoftDeletes, CascadeSoftDeletes;
//Instead of SoftDeletes
// use CascadeSoftDeletes;

//Remove immideately comments
protected $cascadeDeletes = ['diary','regulation','letter','petition','task'];
    protected $fillable = [
        'case_id',
    'member_id',
    'incharge_type',
    'incharge_date',
    'active',
    'controlled_by',
    'notes',
    'case_id',
    ];
    public function case()
    {
        return $this->belongsTo('App\Models\Cases','case_id');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\User','member_id');
    }
    public function diary()
    {
        return $this->hasMany('App\Models\Diary','member_id','id');
    }
    public function regulation()
    {
        return $this->hasMany('App\Models\Interceptions_regulation','member_id','id');
    }
    public function letter()
    {
        return $this->hasMany('App\Models\Letter','member_id','id');
    }
    public function petition()
    {
        return $this->hasMany('App\Models\Petition','member_id','id');
    }
    public function task()
    {
        return $this->hasMany('App\Models\Case_members_task','member_id','id');
    }

}
