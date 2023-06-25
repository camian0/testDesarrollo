<?php

namespace App\Http\Controllers;

use App\Exceptions\OrderException;
use App\Models\Order;
use App\Models\Response;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    /**
     * Show all the orders
     *
     * @return App\Models\Response
     */

    public function get()
    {
        $response = new Response();
        try {

            $orders = Order::all();

            $response->error   = false;
            $response->message = 'Ordenes obtenidas correctamente.';
            $response->data    = $orders;
            return $response->toJSON();

        } catch (OrderException $e) {
            Log::warning("Error en obtener las ordenes \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudieron obtener las ordenes, verifica con el administrador el error.';
            return $response->toJSON();
        } catch (Exception $e) {
            Log::error("Error en obtener las ordenes \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudieron obtener las ordenes, verifica con el administrador el error.';
            return $response->toJSON();
        }
    }

    /**
     * Display the specified order.
     *
     * @param  App\Models\Order  $order
     * @return App\Models\Response
     */

    public function getOrderById(Order $order)
    {
        $response = new Response();
        try {
            if ($order === null) {
                $response->error   = true;
                $response->message = "Orden no encontrada, verifica el seleccinado";
                return $response->toJSON();
            }

            $response->error   = false;
            $response->message = 'Orden obtenida correctamente.';
            $response->data    = $order;
            return $response->toJSON();

        } catch (OrderException $e) {
            Log::warning("Error en obtener orden \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo obtener la orden, verifica con el administrador el error.';
            return $response->toJSON();
        } catch (Exception $e) {
            Log::error("Error obtener orden \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo obtener la orden, verifica con el administrador el error.';
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
                'user_id'    => 'required|numeric|exists:users,id',
                'product_id' => 'required|numeric|exists:products,id',
                'date'       => 'required|date',
                'quantity'   => 'required|numeric',
            ]);

            if ($validation->fails()) {
                $response->error   = true;
                $response->message = $validation->getMessageBag()->first() . " para la orden.";
                return $response->toJSON();
            }

            $order = new Order();
            $order->fill($request->all());
            $order->save();

            $response->error   = false;
            $response->message = 'Orden creada correctamente.';
            return $response->toJSON();

        } catch (OrderException $e) {
            Log::warning("Error en la creacion de orden \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo crear la orden, verifica con el administrador el error.';
            return $response->toJSON();
        } catch (Exception $e) {
            Log::error("Error en la creacion de orden \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo crear la orden, verifica con el administrador el error.';
            return $response->toJSON();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Order  $order
     * @return App\Models\Response
     */
    public function update(Request $request, Order $order)
    {
        $response = new Response();
        try {
            if ($order === null) {
                $response->error   = true;
                $response->message = 'Orden no encontrada, verifica la seleccionada';
                return $response->toJSON();
            }

            $validation = Validator::make($request->all(), [
                'user_id'    => 'required|numeric|exists:users,id',
                'product_id' => 'required|numeric|exists:products,id',
                'date'       => 'required|date',
                'quantity'   => 'required|numeric',
            ]);

            if ($validation->fails()) {
                $response->error   = true;
                $response->message = $validation->getMessageBag()->first() . " para la orden.";
                return $response->toJSON();
            }
            $order->fill($request->all());

            $order->update();

            $response->error   = false;
            $response->message = 'Orden actualizada correctamente.';
            return $response->toJSON();

        } catch (OrderException $e) {
            Log::warning("Error en la actulizacion de la orden \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo actualizar la orden, verifica con el administrador el error.';
            return $response->toJSON();
        } catch (Exception $e) {
            Log::error("Error en la actulizacion de la orden \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo actualizar la orden, verifica con el administrador el error.';
            return $response->toJSON();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return App\Models\Response
     */
    public function delete($id)
    {
        //
    }

    /**
     * Get orders by the specified user
     *
     * @param  App\Models\User
     * @return App\Models\Response
     */
    public function ordersByUser(User $user)
    {
        //
    }
}
