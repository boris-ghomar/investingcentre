<?php

namespace App\Http\Controllers;

use App\Contracts\EmailCipherContract;
use App\Http\Requests\AuthorizeCustomerRequest;
use App\Http\Requests\CustomerRegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Exception;

class CustomerController extends Controller
{
    public function index()
    {
        return Inertia::render("Dashboard", []);
    }

    public function register(CustomerRegistrationRequest $request)
    {
        try {
            $email = app(EmailCipherContract::class)->decrypt($request->u, $request->d);

            Validator::make(["email" => $email], ["email" => "email:dns"])->validate();
        } catch (Exception $e) {
            abort(404);
        }

        // TODO: Find request with that email, if not found - abort 404

        return Inertia::render('Register', ["email" => $email]);
    }

    public function login(Request $request)
    {
        $username = $request->input("u");
        $domain = $request->input("d");
        $viaEmail = "";

        if ($username && $domain) {
            try {
                $viaEmail = app(EmailCipherContract::class)->decrypt($username, $domain);

                Validator::make(["email" => $viaEmail], ["email" => "email:dns"])->validate();
            } catch (Exception $e) {
                $viaEmail = "";
            }
        }



        // TODO: Find request with that email, if not found - abort 404

        return Inertia::render('Login', ["viaEmail" => $viaEmail]);
    }

    public function authorize(AuthorizeCustomerRequest $request)
    {
        // Find customer with email and password

        return to_route("customer.dashboard");
    }

    public function create(CustomerRegistrationRequest $request)
    {
        try {
            $email = Crypt::decryptString($request->e);
        } catch (Exception $e) {
            abort(404);
        }

        // TODO: Find request with that email, if not found - abort 404

        return to_route("", $email);
    }

    public function registrationSuccess(CustomerRegistrationRequest $request)
    {
        try {
            $email = app(EmailCipherContract::class)->decrypt($request->u, $request->d);

            Validator::make(["email" => $email], ["email" => "email:dns"])->validate();
        } catch (Exception $e) {
            abort(404);
        }

        // TODO: Find customer with that email, if not found - abort 404

        return Inertia::render("RegistrationSuccess", [
            "loginUrl" => route("customer.login", [
                "u" => $request->u,
                "d" => $request->d,
            ])
        ]);
    }

    public function logout()
    {
        // logout customer

        return to_route("customer.login");
    }
}
