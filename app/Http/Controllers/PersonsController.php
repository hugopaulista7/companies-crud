<?php

namespace App\Http\Controllers;

use App\Company;
use App\Person;
use App\Phone;
use Illuminate\Http\Request;

class PersonsController extends Controller
{
    public function getAll()
    {
        return Person::get();
    }

    public function persons()
    {
        return view('admin.persons', ['persons' => $this->getAll()]);
    }

    public function create()
    {
        return view('admin.person.create', [
            'companies' => Company::all()
        ]);
    }

    public function getById($id)
    {
        return Person::where('id', $id)->with('company')->first();
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'company' => 'required'
        ]);
        $input = $request->all();
        $company = Company::where('id', $input['company'])->first();
        if (empty($company)) {
            flashMessage('Company field is required', 'alert-danger');
            return redirect()->route('persons');
        }
        $person = (new Person);
        $person->name = $input['name'];
        $person->company()->associate($company);
        $person->save();
        flashMessage('Person created successfuly!', 'alert-success');
        return redirect()->route('persons');
    }

    public function delete($id)
    {
        $person = $this->getById($id);
        if (!$person) {
            flashMessage('This person does not exist!', 'alert-danger');
            return redirect()->route('persons');
        }
        $person->delete();
        flashMessage('Person successfuly deleted!', 'alert-success');
        return redirect()->route('persons');
    }

    public function edit($id)
    {
        return view('admin.person.edit', [
            'person'    => $this->getById($id),
            'companies' => Company::all(),
            'phones'    => Phone::where('person_id', $id)->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $input = $request->all();
        $company = Company::where('id', $input['company'])->first();
        if (empty($company)) {
            flashMessage('Company cannot be empty!', 'alert-danger');
            return redirect()->route('persons');
        }
        $person = $this->getById($id);
        $person->name = $input['name'];
        $person->company()->associate($company);
        $person->save();
        flashMessage('Person updated successfuly', 'alert-success');
        return redirect()->route('persons');
    }

    public function addPhone(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required|string|max:255'
        ]);

        $input = $request->all();
        $person = $this->getById($id);
        if (empty($person)) {
            flashMessage('Person not found', 'alert-danger');
            return redirect()->route('persons');
        }
        $phone = (new Phone);
        $phone->phone = $input['phone'];

        $phone->person()->associate($person);

        $phone->save();
        flashMessage('Added Phone successfuly!', 'alert-success');
        return redirect()->route('persons.edit', $id);
    }

    public function deletePhone($id)
    {
        $phone = Phone::where('id', $id)->first();
        if (empty($phone)) {
            flashMessage('Phone not found', 'alert-danger');
            return redirect()->route('persons');
        }

        $phone->delete();

        flashMessage('Phone deleted successfuly', 'alert-success');
        return redirect()->route('persons.edit', $phone->person_id);
    }
}
