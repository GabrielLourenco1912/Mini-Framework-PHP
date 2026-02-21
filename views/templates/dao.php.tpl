<?= "<?php" ?>

namespace App\DAOs\DAOsImpl;

use App\DAOs\GenericDAO;

class <?= $tableName ?>DAOImpl implements GenericDAO
{
    private database $db;

    function __construct(database $db) {
        $this->db = $db;
    }

    public function save(object $entity): object {
        $this->db->transaction(function (\PDO $pdo) use ($entity) {

        });
    }

    public function findById(int|string $id): ?object {
        $this->db->transaction(function (\PDO $pdo) use ($id) {

        });
    }

    public function findAll(): array {
        $this->db->transaction(function (\PDO $pdo) {

        });
    }

    public function update(object $entity): object {
        $this->db->transaction(function (\PDO $pdo) use ($entity) {
<?php
    $sets = [];
    $placeholders = [];

    foreach ($columns as $column) {
        if ($column === 'id') continue;

        $sets[] = "$column = :$column";
        $method = 'get' . ucfirst($column);
        $placeholders[] = "':$column' => \$entity->$method()";
    }

    $definition = implode(', ', $sets);
    $indent = '                ';
    $statements = implode(',' . PHP_EOL . $indent, $placeholders);
?>
            $sql = "UPDATE <?= $tableName ?> SET <?= $definition ?> WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                <?= $statements ?>,
                ':id' => $entity->getId()
            ]);
        });
    }

    public function deleteById(int|string $id): void {
        $this->db->transaction(function (\PDO $pdo) use ($id) {
            $sql = "DELETE FROM <?= $tableName ?> WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
        });
    }
}