<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'preson_type',
        'person_company_type',
        'identity_type_id',
        'identity_no',
        'nationality_id',
        'birth_date',
        'city_id',
        'mobile',
        'phone',
        'email',
        'fax',
        'job',
        'address',
        'attatchments',
    ];


    public function nationality()
    {
        return $this->belongsTo('App\Models\Nationality','nationality_id');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }
}
