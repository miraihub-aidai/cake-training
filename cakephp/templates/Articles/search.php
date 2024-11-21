   <h1>記事一覧</h1>
<!-- 検索フォーム -->
<?php 
    echo $this->Form->create(null, ['action' =>'search', 'type' => 'get']);
    echo $this->Form->control('title', [
        'type' => 'text',
        'style' => 'width: 200px;'  // または
    ]);
    echo $this->Form->button(__('検索'),[ 'type' => 'submit']);
    echo $this->Form->end(); 
?>

<!-- 検索結果 -->    
<?php  if (!empty($articles) && count($articles) > 0): ?>
    <table>
    <tr>
       <th>タイトル</th>
       <th>作成日時</th>
       <th>操作</th>
   </tr>
        <?php foreach ($articles as $article): ?>
        <tr>           
        <td>
        <?= $this->Html->link($article->title, ['action' => 'search', $article->slug]) ?>
        </td>     
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
                        ['confirm' => 'よろしいですか?']
                    ) ?>
                </td>
            </tr>
 <?php endforeach; ?>
 </table>
<?php elseif (is_null($search)): ?> 
    <p></p> 
<?php else: ?>
    <p>条件に一致する記事が見つかりませんでした。</p>
<?php endif; ?>  



