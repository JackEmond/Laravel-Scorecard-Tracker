<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $guarded = [];

    public function tees()
    {
        return $this->hasMany(Tees::class);
    }
}
