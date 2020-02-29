<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = ['name', 'city'];

    public $timestamps = true;

    public function individual()
    {
        return $this->hasOne(PrivateIndividual::class);
    }

    public function entity()
    {
        return $this->hasOne(LegalEntity::class);
    }
}
