<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = [
        'contract_date',
        'type_id',
        'first_side_id',
        'second_side_id',
        'intro',
        'contract_items',
        'attatchment',
        'notes',
    ];
    public function firstSide()
    {
        return $this->belongsTo('App\Models\Person', 'first_side_id');
    }

    public function secondSide()
    {
        return $this->belongsTo('App\Models\Person', 'second_side_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Contract_type', 'type_id');
    }
}
