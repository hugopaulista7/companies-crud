<?php

namespace App\Http\Controllers;

use App\Company;
use App\LegalEntity;
use App\PrivateIndividual;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CompaniesController extends Controller
{
    public const INDIVIDUAL = 'individual';
    public const ENTITY = 'entity';
    public function getAll()
    {
        return Company::get();
    }

    public function companies() {
        return view('admin.companies', ['companies' => $this->getAll()]);
    }

    public function create()
    {
        return view('admin.company.create');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'city' => 'required|max:255|string',
        ]);

        $input = $request->all();

        if($input['type'] === 'individual') {
            return $this->createIndividualCompany($input);
        }
        if ($input['type'] === 'entity') {
            return $this->createEntityCompany($input);
        }
    }

    public function createCompany($input)
    {
        $comp = (new Company());

        $comp->name = $input['name'];
        $comp->city = $input['city'];

        $comp->save();
        return $comp;
    }

    public function createIndividualCompany($input)
    {
        $comp = $this->createCompany($input);

        $individual = (new PrivateIndividual());
        $individual->cpf = $input['cpf'];
        $individual->rg = $input['rg'];
        $individual->birth_date = $input['birth_date'];
        $individual->company()->associate($comp);
        $individual->save();

        return redirect()->route('companies');
    }

    public function createEntityCompany($input)
    {
        $comp = $this->createCompany($input);

        $entity = (new LegalEntity());

        $entity->cnpj = $input['cnpj'];
        $entity->fantasy_name = $input['fantasy_name'];

        $entity->company()->associate($comp);

        $entity->save();

        return redirect()->route('companies');
    }
}
