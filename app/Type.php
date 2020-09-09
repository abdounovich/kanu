<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function appointments()
    {
        return $this->hasOneThrought(Appointment::class);
    }
}
