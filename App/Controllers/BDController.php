<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Services\TableService;
use App\Core\Flash;
class BDController{
    public function schemaBuilder (Response $response)
    {
        $response->view('bd/schemaBuilder')->send();
    }
    public function schemaView (Response $response, TableService $tableService)
    {
        $tables = $tableService->getSchemaTables();
        $response->view('bd/schemaView', compact('tables'))->send();
    }
    public function schemaCreate (Response $response)
    {
        $response->view('bd/schemaCreate')->send();
    }
    public function schemaBuilderGenerate (Request $request,Response $response, TableService $tableService) {
        $data = $request->getBody();

        $columns = $data['columns'];
        $tableName = $data['table_name'];
        $generator = $data['generator'] ?? null;

        $tableService->createTable($columns, $tableName, $generator);

        $response->redirect("/bd/schemaCreate/success", compact( 'tableName'));
    }
    public function schemaCreateSuccess (Response $response, Flash $flash)
    {
        $tableName = $flash->get("tableName");
        $title = ucfirst('Sucesso!');
        $message = "Tabela " . ucfirst($tableName) . " criada com sucesso!";
        $response->view('bd/schemaBuilderSuccess', compact('title', 'message'))->send();
    }
    public function schemaDelete (Request $request, Response $response, TableService $tableService)
    {
        $data = $request->getBody();
        $tableName = $data['table_name'];
        $tableService->deleteTable($tableName);
        $response->redirect("/bd/schemaView");
    }
}