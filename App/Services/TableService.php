<?php

namespace App\Services;

use App\Core\ModelGenerator;
use App\DAOs\DAOsImpl\TableImplDAO;
use App\Core\DAOGenerator;
use App\Core\SchemaGenerator;

class TableService {
    private ModelGenerator $modelGenerator;
    private TableImplDAO $tableDAO;
    private DAOGenerator $DAOGenerator;
    private SchemaGenerator $schemaGenerator;

    public function __construct(ModelGenerator $modelGenerator, TableImplDAO $tableDAO, DAOGenerator $DAOGenerator, SchemaGenerator $schemaGenerator){
        $this->modelGenerator = $modelGenerator;
        $this->tableDAO = $tableDAO;
        $this->DAOGenerator = $DAOGenerator;
        $this->schemaGenerator = $schemaGenerator;
    }

    public function createTable(array $columns, string $tableName, ?bool $generateModelAndDAO): void {
        $this->tableDAO->createTable($columns, $tableName);

        if ($generateModelAndDAO) {
            $this->modelGenerator->createModel($columns, $tableName);
            $this->DAOGenerator->createDAO($columns, $tableName);
        }

        $this->schemaGenerator->generateSchema();
    }
    public function getSchemaTables()
    {
        return $this->tableDAO->getSchemaTables();
    }
    public function deleteTable(string $tableName): void
    {
        $this->tableDAO->deleteTable($tableName);
        $this->DAOGenerator->deleteDAO($tableName);
        $this->modelGenerator->deleteModel($tableName);
        $this->schemaGenerator->generateSchema();
    }
}