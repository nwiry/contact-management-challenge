<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{
    public function auth(LoginRequest $request)
    {
        $user = User::where("email", $request->email)->first();
        if (!$user) return Response::json(["message" => "E-mail not found"], HttpResponse::HTTP_NOT_FOUND);
        if (!Hash::check($request->password, $user->password))
            return Response::json(["message" => "Invalid password"], HttpResponse::HTTP_BAD_REQUEST);

        $request->session()->put("user", $user->id);
        return Response::json(["redirect_url" => route("contacts")]);
    }

    public function index()
    {
        return view("login");
    }
}
