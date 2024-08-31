<?php

namespaceApp\Http\Controllers;

useApp\Models\equipe;
useIlluminate\Http\Request;
useIlluminate\Http\Response;
useIlluminate\Support\Facades\Validator;

classequipeControllerextendsController{
    // Mostrar todos os registros da tabela livros// CRUD -> Read (leitura) Select/Visualizarpublicfunction index(){
        $regBook = equipe::all();
        $contador = $regBook->count();

        returnresponse()->json([
            'mensagem' => 'equipe encontrada',
            'quantidade' => $contador,
            'dados' => $regBook
        ], Response::HTTP_OK);
    }

    // Mostrar um registro específico// CRUD -> Read (leitura) Select/Visualizarpublicfunction show($id){
        $regBook = equipe::find($id);

        if ($regBook) {
            returnresponse()->json([
                'mensagem' => 'equipe localizada',
                'dados' => $regBook
            ], Response::HTTP_OK);
        } else {
            returnresponse()->json([
                'mensagem' => 'equipe não localizada'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    // Cadastrar um novo registro// CRUD -> Create (criar/cadastrar)publicfunction store(Request $request){
        $validator = Validator::make($request->all(), [
            'nomeequipe' => 'required',
            'generoequipe' => 'required',
            'anoequipe' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            returnresponse()->json([
                'mensagem' => 'Dados inválidos',
                'erros' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $regBook = equipe::create($request->all());

        returnresponse()->json([
            'mensagem' => 'equipe cadastrada com sucesso',
            'dados' => $regBook
        ], Response::HTTP_CREATED);
    }

    // Atualizar um registro existente// CRUD -> Update (alterar)publicfunction update(Request $request, $id){
        $regBook = equipe::find($id);

        if (!$regBook) {
            returnresponse()->json([
                'mensagem' => 'equipe não localizada'
            ], Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'nomeequipe' => 'sometimes|required',
            'generoequipe' => 'sometimes|required',
            'anoequipe' => 'sometimes|required|numeric'
        ]);

        if ($validator->fails()) {
            returnresponse()->json([
                'mensagem' => 'Dados inválidos',
                'erros' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $regBook->update($request->all());

        returnresponse()->json([
            'mensagem' => 'equipe atualizada com sucesso',
            'dados' => $regBook
        ], Response::HTTP_OK);
    }

    // Deletar um registro// CRUD -> Delete (apagar)publicfunction destroy($id){
        $regBook = equipe::find($id);

        if (!$regBook) {
            returnresponse()->json([
                'mensagem' => 'equipe não localizada'
            ], Response::HTTP_NOT_FOUND);
        }

        $regBook->delete();

        returnresponse()->json([
            'mensagem' => 'equipe deletada com sucesso'
        ], Response::HTTP_OK);
    }
}
