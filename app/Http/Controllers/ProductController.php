<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $products = Product::all();
      $products = DB::table('categories')
      ->join('products', 'categories.id', '=', 'products.category_id')
      ->select('*')
      ->get();
       return response()->json([
        'data'=> $products,
        'msg'=> 'lista de productos'
    ],200);
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


        $products = new Product();
        $products->productsName = $request->input('productsName');
        $products->productsStock = $request->input('productsStock');
        $products->productsDescription = $request->input('productsDescription');
        $products->category_id = $request->input('category_id');
        $products->save();

         $reports = new Report();
         $reports->productsName = $request->input('productsName');
         $reports->productsStock = $request->input('productsStock');
         $reports->save();
        return response()->json([
            'data'=> $products,
            'reports' => $reports,
            'msg'=> 'Producto creado'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::find($id);

        return response()->json([
            'data' =>  $products,
            'msg' => 'Producto no Encontrado'
        ], 200);
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
        $products = Product::find($id);

        if (!$products) {
            return response()->json([
                'data' => null,
                'msg' => 'Producto no Encontrado'
            ], 400);
        }

        $products->productsName = $request->input('productsName');
        $products->productsStock = $request->input('productsStock');
        $products->productsDescription = $request->input('productsDescription');
        $products->category_id = $request->input('category_id');
        $products->save();

        return response()->json([
            'data' => $products,
            'msg' => 'Producto no Encontrado'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::find($id);

        if (!$products) {
            return response()->json([
                'data' => null,
                'msg' => 'Producto no Encontrada'
            ], 400);
        }


        $products->delete();

        return response()->json($products);
    }
}
