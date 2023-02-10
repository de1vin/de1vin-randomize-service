<?php

namespace App\Repository;


use App\Component\DatabaseConnection;
use App\Helper\Uuid;
use PDO;

/**
 * Class NumberRepository
 */
readonly class NumberRepository
{
    /**
     * @param DatabaseConnection $db
     */
    public function __construct(private DatabaseConnection $db)
    {}

    /**
     * @param string $id
     *
     * @return array
     */
    public function getById(string $id): array
    {
        $dbh = $this->db->getDbh();
        $sql = 'SELECT * FROM `numbers` WHERE `id`=:id';
        $stmt = $dbh->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result !== false ? $result : [];
    }

    public function saveNumber(int $number): array
    {
        $dbh = $this->db->getDbh();
        $id = Uuid::v4();
        $sql = 'INSERT INTO `numbers` (`id`, `value`) VALUES (:id, :value)';
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':value' => $number
        ]);

        return [
            'id' => $id,
            'value' => $number
        ];
    }

    /**
     * @param int $number
     * @return bool
     */
    public function numberIsExist(int $number): bool
    {
        $dbh = $this->db->getDbh();
        $sql = 'SELECT COUNT(`id`) from `numbers` WHERE value = :value';
        $stmt = $dbh->prepare($sql);

        $stmt->execute(['value' => $number]);

        $count = $stmt->fetchColumn();

        return$count !== 0;
    }
}
