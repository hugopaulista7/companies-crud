<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LegalEntity extends Model
{
    protected $table = 'legal_entities';

    protected $fillable = ['cnpj', 'fantasy_name'];

    public $timestamps = false;

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
