<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Grade;

class Subject extends Model
{
    protected $fillable = ['name'];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
