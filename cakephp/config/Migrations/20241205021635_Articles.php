<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class Articles extends AbstractMigration
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
        $table = $this->table('articles');
        $table->addColumn('user_id', 'integer')
            ->addColumn('title', 'string', ['limit' => 255])
            ->addColumn('slug', 'string', ['limit' => 191])
            ->addColumn('body', 'text', ['null' => true])
            ->addColumn('published', 'boolean', ['default' => false, 'null' => true])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->addIndex('slug', ['unique' => true])
            ->addForeignKey('user_id', 'users', 'id');
        $table->create();
    }

    /**
     * down
     * テーブル削除
     */
    public function down(): void
    {
        $table = $this->table('articles');
        $table->drop()->save();
    }
}
