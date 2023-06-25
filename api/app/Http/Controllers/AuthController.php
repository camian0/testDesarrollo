<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwtAuth', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $response = new Response();
        try {
            $credentials = request(['email', 'password']);
            $validation  = Validator::make($credentials, [
                'email'    => 'required|regex:/^.+@.+$/i',
                'password' => 'required',
            ]);

            if ($validation->fails()) {
                $response->error   = true;
                $response->message = $validation->getMessageBag()->first();
                $response->data    = null;
                return $response->toJSON();
            }

            if (!$token = auth()->attempt($credentials)) {
                $response->error   = true;
                $response->message = "Credenciales incorrectas";
                return $response->toJSON();
            }

            $response->error   = false;
            $response->message = "Sesion iniciada correctamente.";
            $response->data    = ["token" => $token];
            return $response->toJSON();

        } catch (Throwable $th) {
            Log::error("Error inciando sesión \n" . $th->getMessage() . "\n\n" . $th->getTraceAsString());
            $response->error   = true;
            $response->message = 'Error al inciar sesión, verifica con el administrador el error.';
            return $response->toJSON();
        }

    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $response = new Response();
        try {
            auth()->logout();

            $response->error   = false;
            $response->message = "Cierre de sesión exitoso.";
            return $response->toJSON();

        } catch (Throwable $th) {
            Log::error("Error cerrando sesión \n" . $th->getMessage() . "\n\n" . $th->getTraceAsString());
            $response->error   = true;
            $response->message = 'Error al cerrar sesión, verifica con el administrador el error.';
            return $response->toJSON();
        }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $response = new Response();
        try {

            $response->error = false;
            $response->data  = ['token' => $this->respondWithToken(auth()->refresh())];
            return $response->toJSON();

        } catch (Throwable $th) {
            Log::error("Error al refrescar el token \n" . $th->getMessage() . "\n\n" . $th->getTraceAsString());
            $response->error   = true;
            $response->message = 'Error al refrescar el token, verifica con el administrador el error.';
            return $response->toJSON();
        }
    }
}
