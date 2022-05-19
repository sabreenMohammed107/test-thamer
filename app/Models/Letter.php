<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id',
        'member_id',
        'letter_no',
        'title',
        'letter_date',
        'text',
        'notes',
    ];
    public function member()
    {
        return $this->belongsTo('App\Models\User','member_id');
    }
}
