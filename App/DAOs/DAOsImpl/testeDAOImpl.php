<?php
namespace App\DAOs\DAOsImpl;

use App\DAOs\GenericDAO;

class testeDAOImpl implements GenericDAO
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
            $sql = "UPDATE teste SET teste = :teste WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':teste' => $entity->getTeste(),
                ':id' => $entity->getId()
            ]);
        });
    }

    public function deleteById(int|string $id): void {
        $this->db->transaction(function (\PDO $pdo) use ($id) {
            $sql = "DELETE FROM teste WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
        });
    }
}