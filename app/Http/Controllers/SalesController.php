<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Report;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $sales = Sales::all();

        // return response()->json([
        //     'data' => $sales,
        //     'msg' => "lista de Salidas"
        // ]);


        $sales = DB::table('products')
        ->join('sales', 'products.id', '=', 'sales.product_id')

        ->select('*')
        ->orderBy('sales.id', 'desc')
        ->get();


        $sales2 = DB::table('clients')
        ->join('sales', 'clients.id', '=', 'sales.client_id')

        ->select('*')
        ->orderBy('sales.id', 'desc')
        ->get();
         return response()->json([
          'data'=> $sales,
          'data2' => $sales2,
          'msg'=> 'lista de productos'
      ],200);

    }

    public function report()
    {
       // $reports = Report::all();

        $reports = DB::table('reports')
        ->orderBy('id', 'desc')
        ->get();

        return response()->json([
            'data' => $reports,
            'msg' => "lista de Ingresos"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idProducto =  $request->input('product_id');
        $cantidad = $request->input('sales_products');

        $consulta = Product::find($idProducto);

        $validar = $consulta['productsStock'];

        if($cantidad > $validar)
        {
            $mensaje = "No hay muchos en stok";

            return response()->json([
                'msg' => $mensaje
            ]);
        }

        if($cantidad < $validar)
        {
                $sales = new Sales();
            $sales->sales_products = $cantidad;
            $sales->product_id = $idProducto;
            $sales->client_id =  $request->input('client_id');
            $sales->save();


            $product_sold = DB::select("UPDATE products INNER JOIN sales
            ON products.id = sales.product_id
            SET products.productsStock = products.productsStock - $cantidad
            WHERE products.id = $idProducto");

            return response()->json([
                'data' => $sales,
                'msg' => "Venta realizada con Exito"
            ]);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
