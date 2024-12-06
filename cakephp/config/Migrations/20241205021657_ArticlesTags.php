<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class ArticlesTags extends AbstractMigration
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
    }
}
