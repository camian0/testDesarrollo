<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductException;
use App\Models\Product;
use App\Models\Response;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    /**
     * Show the all products
     * @return  \App\Models\Response
     *
     */
    public function get()
    {
        $response = new Response();
        try {
            $products = Product::all();

            $response->error   = false;
            $response->data    = $products;
            $response->message = 'Productos obtenidos correctamente.';
            return $response->toJSON();

        } catch (ProductException $e) {
            Log::warning("Error en obtener productos \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudieron obtener los productos, verifica con el administrador el error.';
            return $response->toJSON();
        } catch (Exception $e) {
            Log::error("Error en obtener productos \n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudieron obtener los productos, verifica con el administrador el error.';
            return $response->toJSON();
        }
    }

    /**
     * Get product by id provided to parameter
     *
     * @param  Product  $product
     * @return  \App\Models\Response
     */
    public function getProductById(Product $product)
    {
        $response = new Response();
        try {
            if ($product === null) {
                $response->error   = true;
                $response->message = "No se encontró el producto, verifica el seleccionado.";
                return $response->toJSON();
            }

            $response->error   = false;
            $response->message = 'Producto obtenido correctamente.';
            $response->data    = $product;
            return $response->toJSON();

        } catch (ProductException $e) {
            Log::warning("Error en obtener producto\n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo obtener el producto, verifica con el administrador el error.';
            return $response->toJSON();
        } catch (Exception $e) {
            Log::error("Error en obtener producto\n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo obtener el producto, verifica con el administrador el error.';
            return $response->toJSON();
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return  \App\Models\Response
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
            Log::warning("Error en la creacion de producto\n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo crear el producto, verifica con el administrador el error.';
            return $response->toJSON();
        } catch (Exception $e) {
            Log::error("Error en la creacion de producto\n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo crear el producto, verifica con el administrador el error.';
            return $response->toJSON();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @return  \App\Models\Response
     */
    public function update(Request $request, Product $product)
    {
        $response = new Response();
        try {
            if ($product === null) {
                $response->error   = true;
                $response->message = "Producto no encontrado, verifica el producto seleccionado";
                return $response->toJSON();
            }

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

            $product->fill($request->all());
            $product->update();

            $response->error   = false;
            $response->message = 'Producto actualizado correctamente.';
            return $response->toJSON();

        } catch (ProductException $e) {
            Log::warning("Error en la actualización de producto\n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo actualizar el producto, verifica con el administrador el error.';
            return $response->toJSON();
        } catch (Exception $e) {
            Log::error("Error en la actualización de producto\n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo actualizar el producto, verifica con el administrador el error.';
            return $response->toJSON();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Product $product)
    {
        $response = new Response();
        try {
            if ($product === null) {
                $response->error   = true;
                $response->message = "Producto no encontrado, verifica el producto seleccionado";
                return $response->toJSON();
            }
            $product->delete();

            $response->error   = false;
            $response->message = 'Producto eliminado correctamente.';
            return $response->toJSON();

        } catch (ProductException $e) {
            Log::warning("Error en la eliminacion de producto\n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo eliminar el producto, verifica con el administrador el error.';
            return $response->toJSON();
        } catch (Exception $e) {
            Log::error("Error en la eliminacion de producto\n" . $e->getMessage() . "\n\n" . $e->getTraceAsString());
            $response->error   = true;
            $response->message = 'No se pudo eliminar el producto, verifica con el administrador el error.';
            return $response->toJSON();
        }
    }
}
