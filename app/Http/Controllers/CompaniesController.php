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

    public function getAllWithRelations()
    {
        return Company::with(['entity', 'individual'])->get();
    }

    public function companies() {
        return view('admin.companies', ['companies' => $this->getAllWithRelations()]);
    }

    public function getById($id)
    {
        return Company::where('id', $id)->first();
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

    public function createIndividualCompany($input, $id = null)
    {
        $comp = $this->getById($id);
        if (empty($comp)) {
            $comp = $this->createCompany($input);
        }
        $individual = (new PrivateIndividual());
        $individual->cpf = $input['cpf'];
        $individual->rg = $input['rg'];
        $individual->birth_date = $input['birth_date'];
        $individual->company()->associate($comp);
        $individual->save();
        flashMessage('Company created successfuly!', 'alert-success');
        return redirect()->route('companies');
    }

    public function createEntityCompany($input, $id = null)
    {
        $comp = $this->getById($id);
        if (empty($comp)) {
            $comp = $this->createCompany($input);
        }

        $entity = (new LegalEntity());

        $entity->cnpj = $input['cnpj'];
        $entity->fantasy_name = $input['fantasy_name'];

        $entity->company()->associate($comp);

        $entity->save();

        return redirect()->route('companies');
    }

    public function delete($id)
    {
        $company = $this->getById($id);
        if (!$company) {
            flashMessage('This company does not exist!', 'alert-danger');
            return redirect()->route('companies');
        }
        $company->delete();
        flashMessage('Company successfuly deleted!', 'alert-success');
        return redirect()->route('companies');
    }

    public function edit($id)
    {
        $company = $this->getById($id);
        $relation = PrivateIndividual::where('company_id', $id)->first();
        if (!$relation) {
            $relation = LegalEntity::where('company_id', $id)->first();
        }

        return view('admin.company.edit', [
            'company'  => $company,
            'relation' => $relation
        ]);
    }

    public function updateIndividual($input, $id)
    {
        $individual = PrivateIndividual::where('company_id', $id)->first();
        if (empty($individual)) {
            return $this->createIndividualCompany($input , $id);
        }
        $individual->rg = $input['rg'];
        $individual->cpf = $input['cpf'];
        $individual->birth_date = $input['birth_date'];

        $individual->save();
    }

    public function updateEntity($input, $id)
    {
        $entity = LegalEntity::where('company_id', $id)->first();
        if (empty($entity)) {
            return $this->createEntityCompany($input, $id);
        }
        $entity->fantasy_name = $input['fantasy_name'];
        $entity->cnpj = $input['cnpj'];
        $entity->save();
    }


    public function handleDeleteType($input, $id)
    {
        if ($input['type'] === 'individual' && !empty($input['cnpj'])) {
            $entity = LegalEntity::where('company_id', $id)->first();
            $entity->delete();
        }
        if ($input['type'] === 'entity' && !empty($input['cpf'])) {
            $individual = PrivateIndividual::where('company_id', $id)->first();
            $individual->delete();
        }
    }

    public function handleCompanyType($input, $id)
    {
        $this->handleDeleteType($input, $id);
        if ($input['type'] === 'individual') {
            $this->updateIndividual($input, $id);
            return true;
        }
        if ($input['type'] === 'entity') {
            $this->updateEntity($input, $id);
            return true;
        }
        return false;
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'city' => 'required|max:255|string',
        ]);
        $input = $request->all();
        $company = $this->getById($id);
        $company->name = $input['name'];
        $company->city = $input['city'];
        $company->save();

        if(!$this->handleCompanyType($input, $id)) {
            flashMessage('Company type invalid', 'alert-danger');
            return redirect()->route('companies.edit', $id);
        }

        flashMessage('Comany updated successfuly!', 'alert-success');
        return redirect()->route('companies');
    }

    public function getByFilter(Request $request)
    {
        $input = $request->all();
        if ($input['type'] == 'name') {
            return response()->json(['companies' => $this->filterByName($input['value'])], 200);
        }

        return response()->json(['companies' => $this->filterByRelationDocument($input['value'], 200)]);
    }

    public function filterByName($value)
    {
        return Company::where('name', 'like', '%' . $value . '%')->with(['individual', 'entity'])->get();
    }

    public function filterByRelationDocument($value)
    {
        return Company::with([
            'individual' => function($query) use ($value) {
                $query->where('private_individuals.cpf', 'like', '%' . $value . '%');
            },
            'entity' => function ($query) use ($value) {
                $query->where('legal_entities.cnpj', 'like', '%' . $value . '%');
            }
        ])->get();
    }
}
