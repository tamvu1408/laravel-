<?php

namespace App\Repositories\Department;

use App\Models\Department;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DepartmentRepository
{
    protected Department $department;

    public function __construct(Department $department)
    {
        $this->department = $department;
    }

    public function getAll()
    {
        // $departments = Department::with([
        //     'manager' => function ($query) {
        //         $query->select('username');
        //     }
        // ])->get();
        $departments = Department::with('manager')->get();
        return $departments;
    }

    public function show($id)
    {
        try {
            $department = Department::findOrFail($id);
            $data = $department->employees;
            return $data;
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }
}
