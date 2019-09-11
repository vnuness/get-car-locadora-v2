<?php

namespace App\Http\Controllers\Veiculos;

use App\Models\Cambio;
use App\Models\Combustivel;
use App\Models\Status;
use App\Models\Veiculos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use vendor\project\StatusTest;

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

        $cambio = Cambio::get();
        $combustivel = Combustivel::get();
        $status = Status::get();

        $categorias = collect($categorias);
        return view('veiculos.index', compact('categorias', 'cambio', 'combustivel', 'status'));
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
        try {
            $fileName = uniqid(date('HisYmd'));
            $request->file->store('veiculos', $fileName);
            Veiculos::create([

            ]);
        } catch (\Exception $e) {
            dd($e);
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
