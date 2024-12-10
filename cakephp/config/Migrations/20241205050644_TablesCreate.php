<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class TablesCreate extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('email', 'string', ['limit' => 255])
            ->addColumn('password', 'string', ['limit' => 255])
            ->addColumn('created', 'datetime', ['limit' => 255, 'null' => true])
            ->addColumn('modified', 'datetime', ['limit' => 255, 'null' => true]);
        $table->create();

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

        $table = $this->table('tags');
        $table->addColumn('title', 'string', ['limit' => 191, 'null' => true])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->addIndex('title', ['unique' => true]);
        $table->create();

        $table = $this->table('articles_tags', ['id' => false, 'primary_key' => ['article_id', 'tag_id']]);
        $table->addColumn('article_id', 'integer')
            ->addColumn('tag_id', 'integer')
            ->addForeignKey('tag_id', 'tags', 'id')
            ->addForeignKey('article_id', 'articles', 'id');
        $table->create();
    }

    /**
     * down
     * テーブル削除
     */
    public function down(): void
    {
        $table = $this->table('articles_tags');
        $table->drop()->save();

        $table = $this->table('tags');
        $table->drop()->save();

        $table = $this->table('articles');
        $table->drop()->save();

        $table = $this->table('users');
        $table->drop()->save();
    }
}
