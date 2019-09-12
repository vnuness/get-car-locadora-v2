<?php

namespace App\Http\Controllers\Veiculos;

use App\Models\Cambio;
use App\Models\Combustivel;
use App\Models\Status;
use App\Models\Veiculos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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
//            $request->imagem->storeAs('imagem', $fileName.'.png');
            Storage::disk('public')->put('images/cars/' . $fileName. '.',$request->imagem->extension(), base64_decode($request->imagem));
            Veiculos::create([
                'modelo' => $request->modelo,
                'montadora' => $request->montadora,
                'ano' => $request->ano,
                'placa' => $request->placa,
                'renavam' => '12341142',
                'id_combustivel' => 1,
                'id_cambio' => 1,
                'id_status' => 1,
                'acessorios' => 'teste',
                'id_status_atividade' => 1,
                'imagem' => $fileName,
                'valor_diaria' => $request->diaria
            ]);
            return back()->with('success', 'Veículo cadastrado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocorreu um erro ao cadastrar o veículo!');
        }

    }

    public function getImage()
    {
        return view('img');
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
