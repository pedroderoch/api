<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Despesa::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'Required|max:191',
            'data' => 'required',
            'usuario_id' => 'required',
            'valor' => 'required'
        ]);
  
        return Despesa::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Despesa::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $despesa = Despesa::findOrFail($id);
        $despesa->update($request->all());
        return $despesa;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Despesa::destroy($id);
    }
}
