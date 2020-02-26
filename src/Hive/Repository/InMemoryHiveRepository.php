<?php
declare(strict_types=1);

namespace Hive\Repository;

use Hive\Model\Hive;

class InMemoryHiveRepository implements HiveRepository
{
    /** @var Hive */
    private $hive;

    public function __construct(Hive $hive)
    {
        $this->hive = $hive;
    }

    /**
     * @inheritDoc
     */
    public function get(): Hive
    {
        return $this->hive;
    }
}
