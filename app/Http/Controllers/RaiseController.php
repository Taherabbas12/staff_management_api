<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Raise;

class RaiseController extends Controller
{

    public function index()
    {
        $raises = Raise::all();
        return response()->json($raises);
    }


    public function store(Request $request)
    {
        $request->validate([
            'EmployeeID' => 'required|exists:clients,id',
            'Amount' => 'required|numeric|min:0',
            'DateIssued' => 'required|date',
        ]);

        $raise = new Raise;
        $raise->EmployeeID = $request->input('EmployeeID');
        $raise->Amount = $request->input('Amount');
        $raise->DateIssued = $request->input('DateIssued');
        $raise->save();

        return response()->json(['message' => 'تم إنشاء رقم مرتفع جديد بنجاح']);
    }


    public function show($id)
    {
        $raise = Raise::findOrFail($id);
        return response()->json($raise);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'EmployeeID' => 'exists:clients,id',
            'Amount' => 'numeric|min:0',
            'DateIssued' => 'date',
        ]);

        $raise = Raise::findOrFail($id);
        $raise->fill($request->all());
        $raise->save();

        return response()->json(['message' => 'تم تحديث تفاصيل الرقم المرتفع بنجاح']);
    }

    public function destroy($id)
    {
        $raise = Raise::findOrFail($id);
        $raise->delete();

        return response()->json(['message' => 'تم حذف الرقم المرتفع بنجاح']);
    }
}
