<?php

namespace App\Http\Controllers;

use App\Person;
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
}
