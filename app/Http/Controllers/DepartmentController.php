<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::getList();

        return view('department', compact('departments'));
    }
}
