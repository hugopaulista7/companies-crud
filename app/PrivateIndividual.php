<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivateIndividual extends Model
{
    protected $table = 'private_individuals';

    protected $fillable = ['rg', 'cpf', 'birth_date'];

    protected $timestamps = true;

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
