<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incentive;
use Illuminate\Support\Facades\Validator;

class IncentiveController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $incentives = Incentive::all();
        return response()->json(['data' => $incentives], 200);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'IncentiveType' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Amount' => 'required|numeric',
            'DateIssued' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $incentive = Incentive::create($request->all());

        return response()->json(['message' => 'تم إضافة الحافز بنجاح', 'data' => $incentive], 201);
    }

  /**
 *
 * @param  int  $id
 * @return \Illuminate\Http\JsonResponse
 */
public function show($id)
{
    $incentive = Incentive::find($id);

    if (!$incentive) {
        return response()->json(['message' => 'الحافز غير موجود'], 404);
    }

    return response()->json(['data' => $incentive], 200);
}
    /**
  
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incentive  $incentive
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Incentive $incentive)
    {
       
        $incentive->update($request->all());

        return response()->json(['message' => 'تم تحديث الحافز بنجاح', 'data' => $incentive], 200);
    }

    /**
   
     *
     * @param  \App\Models\Incentive  $incentive
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Incentive $incentive)
    {
        $incentive->delete();

        return response()->json(['message' => 'تم حذف الحافز بنجاح'], 200);
    }
}
