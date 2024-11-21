<h1>記事の検索</h1>
<?php
    echo $this->Form->create(null, ['type' => 'get', 'url' => ['action' => 'search']]);
    echo $this->Form->control('keyword',['label' => '記事のタイトル', 'value' => $keyword ?? '']);
    echo $this->Form->button('検索');
    echo $this->Form->end();
?>


<?php if (is_null($keyword) || $keyword == ''): ?>
    <!--<p>記事のタイトルを入力してください。</p>-->
<?php elseif(empty($articles) && $articles->count() > 0): ?>    
    <p>該当する記事は見つかりませんでした。</p>
<?php else : ?>
    <h2>検索結果</h2>
    <table>
        <tr>
            <th>タイトル</th>
            <th>作成日時</th>
            <th>操作</th>
        </tr>

        <?php foreach ($articles as $article): ?>
            <tr>
                <td>
                <?= $this->Html->link($article->title, ['action' => 'view', $article->slug]) ?>
                </td>
                <td>
                    <?= $article->created->format(DATE_RFC850) ?>
                </td>
                <td>
                    <?= $this->Html->link('編集', ['action' => 'edit', $article->slug]) ?>
                    <?= $this->Form->postLink(
                        '削除',
                        ['action' => 'delete', $article->slug],
                        ['confirm' => 'よろしいですか?'])
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>