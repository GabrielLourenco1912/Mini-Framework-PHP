<?php

namespace App\Core;

class ModelGenerator
{
    function sanitizeInput($input) {
        return preg_replace('/[^a-zA-Z0-9_]/', '', $input);
    }

    function createModel($columns, $tableName)
    {
        $tableName = $this->sanitizeInput($tableName);

        $modelName = ucfirst($tableName);

        $columns = array_map(function ($col) {
            $col['type'] = $this->sanitizeInput($col['type']);
            $col['type'] = match ($col['type']) {
                'BIGINT', 'INTEGER', 'SMALLINT' => 'int',
                'DECIMAL' => 'float',
                'VARCHAR', 'CHAR', 'TEXT', 'UUID' => 'string',
                'BOOLEAN' => 'bool',
                'DATE', 'TIMESTAMP', 'TIMESTAMPTZ' => '\\' . \DateTimeInterface::class,
                'JSONB' => 'array',
                default => $col['type'],
            };
            return [
                'name' => $this->sanitizeInput($col['name'] ?? ''),
                'type' => $col['type']
            ];
        }, $columns);

        $caminho = __DIR__ . "/../Models/{$modelName}.php";

        ob_start();

        require __DIR__ . '/../../views/templates/model.php.tpl';

        $conteudo = ob_get_clean();

        file_put_contents($caminho, $conteudo);
    }
    public function deleteModel(string $tableName): void
    {
        $tableName = $this->sanitizeInput($tableName);
        $modelName = ucfirst($tableName);
        $caminho = __DIR__ . "/../Models/{$modelName}.php";

        if (file_exists($caminho)) {
            unlink($caminho);
        }
    }
}