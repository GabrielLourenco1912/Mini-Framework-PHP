<?= "<?php" ?>

namespace App\DAOs\DAOsImpl;

use App\DAOs\GenericDAO;
use config\database\database;
use App\Models\<?= ucfirst($tableName) ?>;

/**
* @implements GenericDAO<<?= ucfirst($tableName) ?>>
*/
class <?= $daoName ?> implements GenericDAO
{
    private database $db;

    function __construct(database $db) {
        $this->db = $db;
    }

    public function save(object $entity): object {
        if (!$entity instanceof <?= ucfirst($tableName) ?>) {
            throw new \InvalidArgumentException("Entidade inválida para <?= $daoName ?>");
        }
        $this->db->transaction(function (\PDO $pdo) use (&$entity) {
<?php $columnsSave = array_filter($columns, fn($col) => $col['name'] !== 'id'); ?>
            $sql = "INSERT INTO <?= $tableName ?> (<?= implode(', ', array_column($columnsSave, 'name')) ?>) VALUES (<?= implode(', ', array_map(fn($col) => ':' . $col['name'], $columnsSave)) ?>)";
            $stmt = $pdo->prepare($sql);
<?php
    $placeholders = [];
    foreach ($columnsSave as $column) {
        $method = 'get' . ucfirst($column['name']);
        $placeholders[] = "':" . $column['name'] . "' => \$entity->$method()";
    }

    $indent = '                ';
    $statements = implode(',' . PHP_EOL . $indent, $placeholders);
?>
            $stmt->execute([
                <?= $statements; echo PHP_EOL ?>
            ]);
             $entity->setId((int) $pdo->lastInsertId());
        });
        return $entity;
    }

    public function findById(int|string $id): ?object {
        $pdo = $this->db->getConnection();
        $sql = "SELECT * FROM <?= $tableName ?> WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($row === false) {
            return null;
        }
<?php
    $constructor = [];
    foreach ($columns as $column) {
        switch ($column['type']) {
            case 'int':
            case 'integer':
                $constructor[] = "(int) \$row['" . $column['name'] . "']";
                break;
            case 'float':
            case 'double':
                $constructor[] = "(float) \$row['" . $column['name'] . "']";
                break;
            case 'bool':
            case 'boolean':
                $constructor[] = "(bool) \$row['" . $column['name'] . "']";
                break;
            case 'string':
                $constructor[] = "(string) \$row['" . $column['name'] . "']";
                break;
            case 'datetime':
                $constructor[] = "new \DateTime(\$row['" . $column['name'] . "'])";
                break;
            case 'array':
                $constructor[] = "json_decode(\$row['" . $column['name'] . "'], true)";
                break;
        }
    }
    $contruct = implode(', ', $constructor);
?>

        return new <?= ucfirst($tableName) ?>(<?= $contruct ?>);
    }

    public function findAll(): array {
        $pdo = $this->db->getConnection();
        $sql = "SELECT * FROM <?= $tableName ?>";
        $stmt = $pdo->query($sql);

        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
<?php
    $constructor = [];
    foreach ($columns as $column) {
        switch ($column['type']) {
            case 'int':
            case 'integer':
                $constructor[] = "(int) \$row['" . $column['name'] . "']";
                break;
            case 'float':
            case 'double':
                $constructor[] = "(float) \$row['" . $column['name'] . "']";
                break;
            case 'bool':
            case 'boolean':
                $constructor[] = "(bool) \$row['" . $column['name'] . "']";
                break;
            case 'string':
                $constructor[] = "(string) \$row['" . $column['name'] . "']";
                break;
            case 'datetime':
                $constructor[] = "new \DateTime(\$row['" . $column['name'] . "'])";
                break;
            case 'array':
                $constructor[] = "json_decode(\$row['" . $column['name'] . "'], true)";
                break;
        }
    }
    $contruct = implode(', ', $constructor);
?>

        $array = array_map(
            fn($row) => new <?= ucfirst($tableName) ?>(<?= $contruct ?>),
            $rows
        );
        return $array;
    }

    public function update(object $entity): object {
        if (!$entity instanceof <?= ucfirst($tableName) ?>) {
            throw new \InvalidArgumentException("Entidade inválida para <?= $daoName ?>");
        }
        $this->db->transaction(function (\PDO $pdo) use (&$entity) {
<?php
    $sets = [];
    $placeholders = [];

    foreach ($columns as $column) {
        $sets[] = $column['name'] . ' = :' . $column['name'];
        $method = 'get' . ucfirst($column['name']);
        $placeholders[] = "':" . $column['name'] . "' => \$entity->$method()";
    }

    $definition = implode(', ', $sets);
    $indent = '                ';
    $statements = implode(',' . PHP_EOL . $indent, $placeholders);
?>
            $sql = "UPDATE <?= $tableName ?> SET <?= $definition ?> WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                <?= $statements; echo PHP_EOL ?>
            ]);
            if ($stmt->rowCount() === 0) {
                throw new \RuntimeException("Nenhum registro foi atualizado.");
            }
        });
        return $entity;
    }

    public function deleteById(int|string $id): void {
        $this->db->transaction(function (\PDO $pdo) use ($id) {
            $sql = "DELETE FROM <?= $tableName ?> WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
        });
    }
}