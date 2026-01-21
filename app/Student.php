<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'grade',
        'address',
        'img_path',
        'comment',
    ];


    public function grades()
{
    return $this->hasMany(Grade::class);
}

}

