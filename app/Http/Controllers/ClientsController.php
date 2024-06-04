<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return response()->json(['data' => $clients], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone1' => 'required|string',
            'phone2' => 'required|string',
            'landline' => 'required|string',
            'pager_number' => 'required|string',
            'profile_image' => 'required|image',
            'id_front_image' => 'required|image',
            'id_back_image' => 'required|image',
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
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return response()->json(['data' => $client], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'email|unique:clients,email,' . $client->id,
            'phone1' => 'nullable|string',
            'phone2' => 'nullable|string',
            'landline' => 'nullable|string',
            'pager_number' => 'nullable|string',
            'profile_image' => 'nullable|image',
            'id_front_image' => 'nullable|image',
            'id_back_image' => 'nullable|image',
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
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json(['message' => 'Client deleted successfully'], 200);
    }

    /**
     * Upload an image if it exists in the request.
     */
    private function uploadImageIfExists($request, &$client, $fieldName)
    {
        if ($request->hasFile($fieldName)) {
            $client->$fieldName = $request->file($fieldName)->store('images');
        }
    }
}

