<?php

namespace App\Http\Controllers;

use App\Models\StatusPagamento;
use App\Models\Veiculos;
use Illuminate\Http\Request;
use App\Models\Locacoes;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pedidos.index');
    }

    public function all()
    {
        $locacoes = Locacoes::with('statusPedido')->get();

        return response()->json(['data' => $locacoes]);
    }

    public function getStatus(Request $request) {
        $classes = ['', 'radio-primary', 'radio-success', 'radio-info', 'radio-danger', 'radio-warning', 'radio-purple'];
        $id = $request->id;
        $status = StatusPagamento::get()->map(function($value, $key) use($id, $classes) {
            $value->class = $classes[$key];
            if($value->id == $id) {
                $value->checked = 1;
            } else {
                $value->checked = 0;
            }

            return $value;
        });

        return view('pedidos.status', compact('status'));
    }

    public function saveStatus(Request $request) {
//        Locacoes::where('id', $request->idlocacao)
//        ->update(['status_pagamento' => $request->id])
//        ->save();

        DB::beginTransaction();

        $locacoes = Locacoes::find($request->idlocacao);
        $locacoes->fill(['status_pagamento' => $request->id]);
        $locacoes->save();

        DB::commit();

        return response()->json(['return' => 'success']);
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
        //
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
