<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ClientsController extends Controller
{
    /**
     * Get all clients
     */
    public function index()
    {
        $clients = Client::all();
        return response()->json(['data' => $clients], 200);
    }

    /**
     * Store a new client
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'password' => 'required|string',
            'email' => 'required|email|unique:clients,email',
            'phone1' => 'required|string',
            'phone2' => 'required|string',
            'landline' => 'required|string',
            'pager_number' => 'required|string',
            'profile_image' => 'required|image',
            'id_front_image' => 'required|image',
            'id_back_image' => 'required|image',
            'salary' => 'required|numeric',
            'basic_salary' => 'required|numeric',
            'number_of_wives' => 'required|integer',
            'number_of_children' => 'required|integer',
            'employment_type' => 'required|string',
            'salary_increase' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $client = new Client();
        $client->fill($request->all());

        $this->uploadImageIfExists($request, $client, 'profile_image');
        $this->uploadImageIfExists($request, $client, 'id_front_image');
        $this->uploadImageIfExists($request, $client, 'id_back_image');

        $client->save();

        return response()->json(['message' => 'Client created successfully', 'data' => $client], 201);
    }

    /**
     * Show a specific client
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        return response()->json(['data' => $client], 200);
    }

    /**
     * Update a specific client
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'location' => 'nullable|string',
            'email' => 'email|unique:clients,email,' . $client->id,
            'password' => 'nullable|string',
            'phone1' => 'nullable|string',
            'phone2' => 'nullable|string',
            'landline' => 'nullable|string',
            'pager_number' => 'nullable|string',
            'profile_image' => 'nullable|image',
            'id_front_image' => 'nullable|image',
            'id_back_image' => 'nullable|image',
            'salary' => 'nullable|numeric',
            'basic_salary' => 'nullable|numeric',
            'number_of_wives' => 'nullable|integer',
            'number_of_children' => 'nullable|integer',
            'employment_type' => 'nullable|string',
            'salary_increase' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $client->update($request->all());

        $this->uploadImageIfExists($request, $client, 'profile_image');
        $this->uploadImageIfExists($request, $client, 'id_front_image');
        $this->uploadImageIfExists($request, $client, 'id_back_image');

        return response()->json(['message' => 'Client updated successfully', 'data' => $client], 200);
    }

    /**
     * Delete a specific client
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json(['message' => 'Client deleted successfully'], 200);
    }

    /**
     * Upload an image if it exists in the request
     */
    private function uploadImageIfExists($request, &$client, $fieldName)
    {
        if ($request->hasFile($fieldName)) {
            $client->$fieldName = $request->file($fieldName)->store('images', 'public');
        }
    }
}
