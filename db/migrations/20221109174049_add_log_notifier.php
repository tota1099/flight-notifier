<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddLogNotifier extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('flight_notifier_log');
        $table
            ->addColumn('flight_number', 'string', ['limit' => 4])
            ->addColumn('date', 'date')
            ->create();
    }
}
