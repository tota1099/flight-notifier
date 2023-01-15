<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateNotifierLog extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('notifier_log');
        $table
            ->addColumn('flight_number', 'integer', ['limit' => 4, 'null' => false])
            ->addColumn('date', 'datetime')
            ->create();
    }
}
