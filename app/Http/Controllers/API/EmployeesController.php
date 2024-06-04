<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return response()->json(['data' => $employees], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'salary' => 'required|numeric',
            'nominal_salary' => 'required|numeric',
            'number_of_children' => 'required|integer',
            'appointment_type' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $employee = Employee::create($request->all());
        return response()->json(['message' => 'Employee created successfully', 'data' => $employee], 201);
    }

    public function show(Employee $employee)
    {
        return response()->json(['data' => $employee], 200);
    }

    public function update(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(), [
            'salary' => 'required|numeric',
            'nominal_salary' => 'required|numeric',
            'number_of_children' => 'required|integer',
            'appointment_type' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $employee->update($request->all());
        return response()->json(['message' => 'Employee updated successfully', 'data' => $employee], 200);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(['message' => 'Employee deleted successfully'], 200);
    }
}
