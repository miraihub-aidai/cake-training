<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class TablesDrop extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        // いったんすべてのテーブルを削除する
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
