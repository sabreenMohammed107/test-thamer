<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Interceptions_regulation extends Model
{
    use HasFactory,SoftDeletes, CascadeSoftDeletes;
    //Instead of SoftDeletes
    // use CascadeSoftDeletes;

    //Remove immideately comments
    protected $cascadeDeletes = ['task'];
    protected $fillable = [
        'case_id',
        'member_id',
        'regulation_date',
        'facts',
        'defenses',
        'requirements',
        'text',
        'notes',
    ];

    public function member()
    {
        return $this->belongsTo('App\Models\User','member_id');
    }
    public function task()
    {
        return $this->hasMany('App\Models\Case_members_task','member_id','id');
    }

}
