<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fees_installment extends Model
{
    use HasFactory;
    protected $fillable = [
        'case_id',
    'installment_no',
    'installment_date',
    'pay_amount',
    'paid',
    'controlled_by',
    'notes',
    ];
}
