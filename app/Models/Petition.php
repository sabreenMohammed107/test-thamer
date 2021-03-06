<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id',
    'member_id',
    'petition_date',
    'title',
    'text',
    'notes',
    ];

    public function member()
    {
        return $this->belongsTo('App\Models\User','member_id');
    }
}
