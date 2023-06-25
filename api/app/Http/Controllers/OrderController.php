<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

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
        //
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
