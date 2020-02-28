<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phones';

    protected $fillable = ['phone'];

    public $timestamps = true;

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

}
