<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\Piloto;

class PilotoController extends Controller
{
    // Mostrar todos os registros da tabela livros// CRUD -> Read (leitura) Select/Visualizarpublicfunction index(){
        public function index(Request $request) {
            $query = Piloto::query();
        
            // Filtrar com base em parâmetros de consulta, se fornecidos
            if ($request->has('id')) {
                $query->where('id', $request->query('id'));
            }
            if ($request->has('nomepilotos')) {
                $query->where('nomepilotos', $request->query('nomepilotos'));
            }
            if ($request->has('carro')) {
                $query->where('carro', $request->query('carro'));
            }
            if ($request->has('idade')) {
                $query->where('idade', $request->query('idade'));
            }
        
            $regPiloto = $query->get();
            $contador = $regPiloto->count();
        
            return response()->json([
                'mensagem' => 'Pilotos encontrados',
                'quantidade' => $contador,
                'dados' => $regPiloto
            ], Response::HTTP_OK);
        }
        

    // Mostrar um registro específico// CRUD -> Read (leitura) Select/Visualizar
    
    public function show($id) {
        $regPiloto = Piloto::find($id);
    
        if ($regPiloto) {
            return response()->json([
                'mensagem' => 'Piloto localizado',
                'dados' => $regPiloto
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'mensagem' => 'Piloto não localizado'
            ], Response::HTTP_NOT_FOUND);
        }
    }
    
    // Cadastrar um novo registro// CRUD -> Create (criar/cadastrar)
    
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'nomepilotos' => 'required',
            'carro' => 'required',
            'idade' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'mensagem' => 'Dados inválidos',
                'erros' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }
    
        $regPiloto = Piloto::create($request->all());
    
        return response()->json([
            'mensagem' => 'Piloto cadastrado com sucesso',
            'dados' => $regPiloto
        ], Response::HTTP_CREATED);
    }
    

    // Atualizar um registro existente// CRUD -> Update (alterar) 
    public function update(Request $request, $id) {
        $regPiloto = Piloto::find($id);
    
        if (!$regPiloto) {
            return response()->json([
                'mensagem' => 'Piloto não localizado'
            ], Response::HTTP_NOT_FOUND);
        }
    
        $validator = Validator::make($request->all(), [
            'nomepilotos' => 'required',
            'carro' => 'required',
            'idade' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'mensagem' => 'Dados inválidos',
                'erros' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }
    
        $regPiloto->update($request->all());
    
        return response()->json([
            'mensagem' => 'Piloto atualizado com sucesso',
            'dados' => $regPiloto
        ], Response::HTTP_OK);
    }
    

    // Deletar um registro// CRUD -> Delete (apagar)
    public function destroy($id) {
        $regPiloto = Piloto::find($id);
    
        if (!$regPiloto) {
            return response()->json([
                'mensagem' => 'Piloto não localizado'
            ], Response::HTTP_NOT_FOUND);
        }
    
        $regPiloto->delete();
    
        return response()->json([
            'mensagem' => 'Piloto deletado com sucesso'
        ], Response::HTTP_OK);
    }
    
}

