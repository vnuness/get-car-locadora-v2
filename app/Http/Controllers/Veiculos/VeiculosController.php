<?php

namespace App\Http\Controllers\Veiculos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VeiculosController extends Controller
{
    public function index(Request $request)
    {
        $categorias = [
            [
                'id' => 0,
                'name' => 'Selecione uma Categoria...'
            ],
            [
                'id' => 1,
                'name' => 'Sedan'
            ],
            [
                'id' => 2,
                'name' => 'SUV'
            ]
        ];
        $categorias = collect($categorias);
        return view('produtos.index', compact('categorias'));
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
