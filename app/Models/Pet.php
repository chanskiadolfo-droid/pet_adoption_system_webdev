<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'name',
        'type',
        'breed',
        'age',
        'gender',
        'description',
        'status',
    ];

    public function adoptionRequests()
    {
        return $this->hasMany(AdoptionRequest::class);
    }
}
