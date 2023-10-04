<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Department\DepartmentRepository;

class DepartmentController extends Controller
{
    private DepartmentRepository $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function index()
    {
        $departments = $this->departmentRepository->getAll();
        return response()->json([
            'status' => 200,
            'data' => $departments,
        ]);
    }

    public function show($id)
    {
        $data = $this->departmentRepository->show($id);
        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }
}
