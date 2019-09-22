<?php

namespace App\Http\Controllers\Veiculos;

use App\Models\Cambio;
use App\Models\CategoriaVeiculo;
use App\Models\Combustivel;
use App\Models\ImagemVeiculo;
use App\Models\Imagens;
use App\Models\Status;
use App\Models\Veiculos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use vendor\project\StatusTest;

class VeiculosController extends Controller
{
    public function index(Request $request)
    {
        $categorias = CategoriaVeiculo::get();

        $cambio = Cambio::get();
        $combustivel = Combustivel::get();
        $status = Status::get();

        $categorias = collect($categorias);
        return view('veiculos.index', compact('categorias', 'cambio', 'combustivel', 'status'));
    }

    public function detalheVeiculo($id)
    {
        $imagens = $this->getImagens($id);
        $veiculo = Veiculos::find($id);
        return view('veiculos.detalhes', compact('imagens', 'veiculo'));
    }

    public function getImagens($id)
    {
        return DB::select('call proc_get_imagens(?)', [$id]);
    }

    public function all()
    {
        $veiculos = Veiculos::with('categoria')->get();

        return response()->json(['data' => $veiculos]);

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        try {

        $idImagens = [];
            for ($i = 1; $i <= 5; $i++) {
                $fileName = uniqid(date('HisYmd'));
                $name = 'imagem' . $i;
                if (isset($request->$name)) {
                    Storage::disk('public')->put('images/cars/' . $fileName . '.' . $request->$name->extension(), base64_decode($request->$name));
                    $imagens = Imagens::create([
                        'imagem' => $fileName . '.' . $request->$name->extension()
                    ]);

                    array_push($idImagens, $imagens->id);
                }

            }

            $veiculo = Veiculos::create([
                'modelo' => $request->modelo,
                'montadora' => $request->montadora,
                'ano' => $request->ano,
                'placa' => $request->placa,
                'renavam' => '12341142',
                'id_combustivel' => 1,
                'id_cambio' => 1,
                'id_status' => 1,
                'id_categoria' => $request->categoria,
                'acessorios' => 'teste',
                'id_status_atividade' => 1,
                'valor_diaria' => $request->diaria
            ]);

            foreach($idImagens as $idImagem) {
                ImagemVeiculo::create([
                   'id_veiculo' => $veiculo->id,
                   'id_imagem' => $idImagem
                ]);
            }


            return back()->with('success', 'Veículo cadastrado com sucesso!');
//        } catch (\Exception $e) {
//            return back()->with('error', 'Ocorreu um erro ao cadastrar o veículo!');
//        }

    }

    public function getImage(Request $request)
    {
        
        return view('img');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Veiculos::find($id)->toArray();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();

            $veiculos = Veiculos::find($id);
            $veiculos->fill($request->all());
            $veiculos->save();

            DB::commit();
        } catch (\Exception $e) {

        }

        return response()->json(['message' => 'Veículo atualizado.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
