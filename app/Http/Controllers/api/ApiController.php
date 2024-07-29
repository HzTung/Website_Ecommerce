<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $query = $request->input('query');

        $results = Products::where('name_sp', 'LIKE', '%' . $query . '%')->limit(5)->get();

        return response()->json($results);
    }

    public function profile(Request $request): Response
    {

        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data['data'], [
            'fullname' => "required",
            'email' => "required|email",
            'sdt' => "required",
        ]);
        if ($validator->fails()) {
            // return new Response('Invalid data', Response::HTTP_BAD_REQUEST);
            return new Response(status: 400);
        }
        $id = $data['data']['id'];

        $validatedData = $validator->validated();
        User::where('id', $id)->update($validatedData);
        return new Response('Profile updated successfully', Response::HTTP_OK);
    }
}
