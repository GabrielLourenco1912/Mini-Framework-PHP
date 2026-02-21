<?php

namespace App\Core;

class DAOGenerator {
    function SanitizeInput($input) {
        return preg_replace('/[^a-zA-Z0-9_]/', '', $input);
    }
    function createDAO($columns, $tableName)
    {
        $columns = array_map(fn($col) => $col['name'], $columns);
        $caminho = __DIR__ . "/../DAOs/DAOsImpl/{$tableName}DAOImpl.php";

        ob_start();

        require __DIR__ . '/../../views/templates/dao.php.tpl';

        $conteudo = ob_get_clean();

        file_put_contents($caminho, $conteudo);
    }
}