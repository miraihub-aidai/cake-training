<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    /*
    public function change(): void
    {
        $table = $this->table('users');
        $table->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('email', 'string', ['limit' => 255])
            ->addColumn('password', 'string', ['limit' => 255])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime');
        $table->create();
    }
    */

    /**
     * up
     * テーブル作成
     */
    public function up(): void
    {
        $table = $this->table('users');
        $table->addColumn('email', 'string', ['limit' => 255])
            ->addColumn('password', 'string', ['limit' => 255])
            ->addColumn('created', 'datetime', ['limit' => 255, 'null' => true])
            ->addColumn('modified', 'datetime', ['limit' => 255, 'null' => true]);
        $table->create();
    }

    /**
     * down
     * テーブル削除
     */
    public function down(): void
    {
        $table = $this->table('users');
        $table->drop()->save();
    }
}

