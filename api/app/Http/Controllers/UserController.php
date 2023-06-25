<?php

namespace App\Http\Controllers;

use App\Exceptions\UserException;
use App\Models\Response;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Show all the users
     *
     * @return App\Models\Response
     */
    public function get()
    {
        $response = new Response();
        try {
            $users = User::all();

            $response->error   = false;
            $response->data    = $users;
            $response->message = 'Usuarios obtenidos correctamente.';
            return $response->toJSON();

        } catch (UserException $e) {
            Log::warning("Error en obtener usuarios \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudieron obtener los usuarios, verifica con el administrador el error.';
            return $response->toJSON();
        } catch (Exception $e) {
            Log::error("Error en obtener usuarios \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudieron obtener los usuarios, verifica con el administrador el error.';
            return $response->toJSON();
        }
    }

    /**
     * Show all the users
     *
     * @param  App\Models\User $user
     */
    public function getUserById(User $user)
    {
        $response = new Response();
        try {
            if ($user === null) {
                $response->error   = true;
                $response->message = "Usuario no encontrado, verifica el ingresado.";
                return $response->toJSON();
            }

            $response->error   = false;
            $response->data    = $user;
            $response->message = 'Usuario obtenido correctamente.';
            return $response->toJSON();

        } catch (UserException $e) {
            Log::warning("Error en obtener usuario\n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo obtener el usuario, verifica con el administrador el error.';
            return $response->toJSON();
        } catch (Exception $e) {
            Log::error("Error en obtener usuario \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo obtener el usuario, verifica con el administrador el error.';
            return $response->toJSON();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\Models\Response
     */
    public function store(Request $request)
    {
        $response = new Response();
        try {
            $validation = Validator::make($request->all(), [
                'name'     => 'required',
                'email'    => 'required|email',
                'password' => 'required|min:8',
            ]);

            if ($validation->fails()) {
                $response->error   = true;
                $response->message = $validation->getMessageBag()->first() . " para el usuario.";
                return $response->toJSON();
            }
            $user = new User();
            $user->fill($request->all());
            $user->password = bcrypt($request->password);
            $user->save();

            $response->error   = false;
            $response->message = 'Usuario creado correctamente.';
            return $response->toJSON();

        } catch (UserException $e) {
            Log::warning("Error al crear usuario \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo crear el usuario, verifica con el administrador el error.';
            return $response->toJSON();
        } catch (Exception $e) {
            Log::error("Error al crear usuario \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo crear el usuario, verifica con el administrador el error.';
            return $response->toJSON();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\User $user
     * @return App\Models\Response
     */
    public function update(Request $request, User $user)
    {
        $response = new Response();
        try {
            if ($user === null) {
                $response->error   = true;
                $response->message = "Usuario no encontrado, verifica el seleccionado";
                return $response->toJSON();
            }

            $validation = Validator::make($request->all(), [
                'name'     => 'required',
                'email'    => 'required|email',
                'password' => 'required|min:8',
            ]);

            if ($validation->fails()) {
                $response->error   = true;
                $response->message = $validation->getMessageBag()->first() . " para el usuario.";
                return $response->toJSON();
            }

            $user->fill($request->all());
            $user->password = bcrypt($request->password);
            $user->update();

            $response->error   = false;
            $response->message = 'Usuario actualizado correctamente.';
            return $response->toJSON();

        } catch (UserException $e) {
            Log::warning("Error al actualizar usuario \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo actualizar el usuario, verifica con el administrador el error.';
            return $response->toJSON();
        } catch (Exception $e) {
            Log::error("Error al actualizar usuario \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo actualizar el usuario, verifica con el administrador el error.';
            return $response->toJSON();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\User $user
     * @return App\Models\Response
     */
    public function delete(User $user)
    {
        $response = new Response();
        try {
            if ($user === null) {
                $response->error   = true;
                $response->message = "Usuario no encontrado, verifica el seleccionado";
                return $response->toJSON();
            }
            $user->delete();

            $response->error   = false;
            $response->message = 'Usuario eliminado correctamente.';
            return $response->toJSON();

        } catch (UserException $e) {
            Log::warning("Error al eliminar usuario \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo eliminar el usuario, verifica con el administrador el error.';
            return $response->toJSON();
        } catch (Exception $e) {
            Log::error("Error al eliminar usuario \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo eliminar el usuario, verifica con el administrador el error.';
            return $response->toJSON();
        }
    }
}
