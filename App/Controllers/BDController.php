<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\DAOs\DAOsImpl\TableImplDAO;
use App\Core\DAOGenerator;
use App\Core\SchemaGenerator;

class BDController{
    public function schemaBuilder (Response $response)
    {
        $response->view('bd/schemaBuilder')->send();
    }
    public function schemaBuilderGenerate (Request $request,Response $response, TableImplDAO $tableDAO, DAOGenerator $DAOGenerator, SchemaGenerator $schemaGenerator) {
        $data = $request->getBody();

        $columns = $data['columns'];
        $tableName = $data['table_name'];

        $tableDAO->createTable($columns, $tableName);

        $DAOGenerator->createDAO($columns, $tableName);

        $schemaGenerator->generateSchema();
    }
}