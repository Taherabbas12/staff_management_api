<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penalty;
use Illuminate\Support\Facades\Validator;

class PenaltyController extends Controller
{
    public function index()
    {
        $penalties = Penalty::all();
        return response()->json(['data' => $penalties], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'PenaltyType' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'PenaltyAmount' => 'required|numeric',
            'DateIssued' => 'required|date',
            'EmployeeID' => 'required|exists:clients,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $penalty = Penalty::create($request->all());

        return response()->json(['message' => 'Penalty created successfully', 'data' => $penalty], 201);
    }

    public function show($id)
    {
        $penalty = Penalty::find($id);

        if (!$penalty) {
            return response()->json(['message' => 'الجزاء غير موجود'], 404);
        }

        return response()->json(['data' => $penalty], 200);
    }

    public function update(Request $request, Penalty $penalty)
    {
        $validator = Validator::make($request->all(), [
            'PenaltyType' => 'string|max:255',
            'Description' => 'nullable|string',
            'PenaltyAmount' => 'numeric',
            'DateIssued' => 'date',
            'EmployeeID' => 'exists:clients,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $penalty->update($request->all());

        return response()->json(['message' => 'Penalty updated successfully', 'data' => $penalty], 200);
    }

    public function destroy(Penalty $penalty)
    {
        $penalty->delete();

        return response()->json(['message' => 'Penalty deleted successfully'], 200);
    }
}
