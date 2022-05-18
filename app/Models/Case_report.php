<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Case_report extends Model
{
    use HasFactory;
    protected $fillable = [
        'case_id',
    'text',
    'report_date',
    ];

    public function case()
    {
        return $this->belongsTo('App\Models\Cases','case_id');
    }

}
