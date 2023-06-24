<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductException;
use App\Models\Product;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = new Response();
        try {
            $validation = Validator::make($request->all(), [
                'name'        => 'required',
                'description' => 'required',
                'price'       => 'required||numeric',
            ]);

            if ($validation->fails()) {
                $response->error   = true;
                $response->message = $validation->getMessageBag()->first() . " para producto.";
                return $response->toJSON();
            }

            $productModel = new Product();
            $productModel->fill($request->all());
            $productModel->save();

            $response->error   = false;
            $response->message = 'Producto creado correctamente.';
            return $response->toJSON();

        } catch (ProductException $e) {
            Log::error("Error en la creacion de producto\n" . $e->getMessage() . "\n\n" . $e->getTrace());
            $response->error   = true;
            $response->message = 'No se pudo crear el producto, verifica con el administrador el error.';
            return $response->toJSON();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }
}
