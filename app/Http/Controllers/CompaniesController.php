<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function getAll()
    {
        return Company::get();
    }

    public function companies() {
        return view('admin.companies', ['companies' => $this->getAll()]);
    }
}
