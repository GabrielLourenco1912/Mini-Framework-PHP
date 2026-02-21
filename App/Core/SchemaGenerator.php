<?php

namespace App\Core;

class SchemaGenerator
{
    function generateSchema()
    {
        $user = $_ENV['DB_USER'];
        $db = $_ENV['DB_NAME'];
        $container = $_ENV['CONTAINER_NAME'];

        $caminho = __DIR__ . '/../../config/database/schema.sql';

        $command = "docker exec $container pg_dump -U $user -s -d $db --no-owner --no-privileges";

        $descriptors = [
            1 => ['pipe', 'w'], // stdout
            2 => ['pipe', 'w'], // stderr
        ];

        $process = proc_open($command, $descriptors, $pipes);

        if (is_resource($process)) {
            $output = stream_get_contents($pipes[1]);
            $error  = stream_get_contents($pipes[2]);

            fclose($pipes[1]);
            fclose($pipes[2]);

            $exitCode = proc_close($process);

            if ($exitCode !== 0) {
                throw new \RuntimeException("Erro no dump: $error");
            }

            file_put_contents($caminho, $output);
        }
    }
}