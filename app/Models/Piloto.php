<?php

namespaceApp\Http\Controllers;

useApp\Models\piloto;
useIlluminate\Http\Request;
useIlluminate\Http\Response;
useIlluminate\Support\Facades\Validator;

classpilotoControllerextendsController{
    // Mostrar todos os registros da tabela livros// CRUD -> Read (leitura) Select/Visualizarpublicfunction index(){
        $regBook = piloto::all();
        $contador = $regBook->count();

        returnresponse()->json([
            'mensagem' => 'piloto encontrado',
            'quantidade' => $contador,
            'dados' => $regBook
        ], Response::HTTP_OK);
    }

    // Mostrar um registro específico// CRUD -> Read (leitura) Select/Visualizarpublicfunction show($id){
        $regBook = piloto::find($id);

        if ($regBook) {
            returnresponse()->json([
                'mensagem' => 'piloto localizado',
                'dados' => $regBook
            ], Response::HTTP_OK);
        } else {
            returnresponse()->json([
                'mensagem' => 'piloto não localizado'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    // Cadastrar um novo registro// CRUD -> Create (criar/cadastrar)publicfunction store(Request $request){
        $validator = Validator::make($request->all(), [
            'nomepiloto' => 'required',
            'generopiloto' => 'required',
            'anopiloto' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            returnresponse()->json([
                'mensagem' => 'Dados inválidos',
                'erros' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $regBook = piloto::create($request->all());

        returnresponse()->json([
            'mensagem' => 'piloto cadastrado com sucesso',
            'dados' => $regBook
        ], Response::HTTP_CREATED);
    }

    // Atualizar um registro existente// CRUD -> Update (alterar)publicfunction update(Request $request, $id){
        $regBook = piloto::find($id);

        if (!$regBook) {
            returnresponse()->json([
                'mensagem' => 'piloto não localizado'
            ], Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'nomepiloto' => 'sometimes|required',
            'generopiloto' => 'sometimes|required',
            'anopiloto' => 'sometimes|required|numeric'
        ]);

        if ($validator->fails()) {
            returnresponse()->json([
                'mensagem' => 'Dados inválidos',
                'erros' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $regBook->update($request->all());

        returnresponse()->json([
            'mensagem' => 'piloto atualizado com sucesso',
            'dados' => $regBook
        ], Response::HTTP_OK);
    }

    // Deletar um registro// CRUD -> Delete (apagar)publicfunction destroy($id){
        $regBook = piloto::find($id);

        if (!$regBook) {
            returnresponse()->json([
                'mensagem' => 'piloto não localizado'
            ], Response::HTTP_NOT_FOUND);
        }

        $regBook->delete();

        returnresponse()->json([
            'mensagem' => 'piloto deletado com sucesso'
        ], Response::HTTP_OK);
    }
}
