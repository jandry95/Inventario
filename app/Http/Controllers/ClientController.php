<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = DB::table('clients')
        ->orderBy('id', 'desc')
        ->get();
        // $clients = Client::all();

        return response()->json([
            'data' => $clients,
            'msg' => "Lsita de Clientes"
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

        $request->validate([
            'name'  =>['required', 'string'],
            'lastName'  =>['required', 'string'],
            'ci' => ['required', 'string', 'max:10', 'min:10'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string'],
        ]);

        $clients = new Client();

        $clients->name = $request->input("name");
        $clients->lastName = $request->input("lastName");
        $clients->ci = $request->input("ci");
        $clients->address = $request->input("address");
        $clients->phone = $request->input("phone");

        $clients->save();

        return response()->json([
            'data' => $clients,
            'msg' => "Cliente creado con exito"
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clients = Client::find($id);
        return response()->json([
            'data' => $clients,
            'msg' => "Cliente creado con exito"
        ]);
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
        $clients = Client::find($id);

        if (!$clients) {
            return response()->json([
                'data' => null,
                'msg' => 'Categoria no encontrada'
            ], 400);
        }


        $clients->name = $request->input("name");
        $clients->lastName = $request->input("lastName");
        $clients->ci = $request->input("ci");
        $clients->address = $request->input("address");
        $clients->phone = $request->input("phone");
        $clients->save();

        return response()->json($clients);
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
