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
     * Show the all orders
     *
     * @return \Illuminate\Http\Response
     */

    public function get()
    {
        //
    }

    /**
     * Display the specified order.
     *
     * @param  int  $id
     * @return App\Models\Response
     */

    public function getOrderByI($id)
    {
        //
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
        //
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
