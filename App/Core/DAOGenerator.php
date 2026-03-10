<?php

namespace App\Core;

class DAOGenerator {
    function SanitizeInput($input): string
    {
        return preg_replace('/[^a-zA-Z0-9_]/', '', $input);
    }
    public function createDAO($columns, $tableName): void
    {
        $tableName = $this->SanitizeInput($tableName);

        $columns = array_map(function ($col) {
            $col['type'] = match ($col['type']) {
                'BIGINT', 'INTEGER', 'SMALLINT' => 'int',
                'DECIMAL' => 'float',
                'VARCHAR', 'CHAR', 'TEXT', 'UUID' => 'string',
                'BOOLEAN' => 'bool',
                'DATE', 'TIMESTAMP', 'TIMESTAMPTZ' => 'datetime',
                'JSONB' => 'array',
                default => $col['type'],
            };
            return [
                'name' => $this->SanitizeInput($col['name'] ?? ''),
                'type' => $this->SanitizeInput($col['type'] ?? '')
            ];
        }, $columns);

        $daoName = ucfirst($tableName) . "DAOImpl";
        $caminho = __DIR__ . "/../DAOs/DAOsImpl/{$daoName}.php";

        ob_start();
        require __DIR__ . '/../../views/templates/dao.php.tpl';
        $conteudo = ob_get_clean();

        file_put_contents($caminho, $conteudo);
    }
    public function deleteDAO(string $tableName): void
    {
        $tableName = $this->SanitizeInput($tableName);
        $daoName = ucfirst($tableName) . "DAOImpl";
        $caminho = __DIR__ . "/../DAOs/DAOsImpl/{$daoName}.php";

        if (file_exists($caminho)) {
            unlink($caminho);
        }
    }
}