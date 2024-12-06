<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class Tags extends AbstractMigration
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
    }
    */

    /**
     * up
     * テーブル作成
     */
    public function up(): void
    {
        $table = $this->table('tags');
        $table->addColumn('title', 'string', ['limit' => 191, 'null' => true])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->addIndex('title', ['unique' => true]);
        $table->create();
    }

    /**
     * down
     * テーブル削除
     */
    public function down(): void
    {
        $table = $this->table('tags');
        $table->drop()->save();
    }
}
