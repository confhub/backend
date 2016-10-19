<?php

use Phinx\Migration\AbstractMigration;

class Initialize extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('confs', ['id' => 'id']);
        $table->addColumn('slug', 'string')
              ->addColumn('title', 'string')
              ->addColumn('subject', 'string')
              ->addColumn('date', 'date')
              ->addColumn('location', 'string')
              ->addColumn('url', 'string')
              ->addColumn('hash', 'string')
              ->create();
    }
}
