<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ArticlesController
 *
 * 記事の管理を行うコントローラークラス
 */
class ArticlesController extends AppController
{
    /**
     * 記事一覧を表示するアクション
     *
     * @return void
     */
    public function index()
    {
        $articles = $this->paginate($this->Articles);
        $this->set(compact('articles'));
    }

    /**
     * 特定の記事を表示するアクション
     *
     * @param string|null $slug 記事のスラグ
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException 記事が見つからない場合
     */
    public function view(?string $slug = null)
    {
        // Update retrieving tags with contain()
        $article = $this->Articles
                ->findBySlug($slug)
                ->contain('Tags')
                ->firstOrFail();
        $this->set(compact('article'));
    }

    /**
     * 新しい記事を追加するアクション
     *
     * @return \Cake\Http\Response|null|void リダイレクト先
     */
    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());

            // user_id の決め打ちは一時的なもので、あとで認証を構築する際に削除されます。
            // $article->user_id = 1;
            // 変更: セッションから user_id をセット
            $article->user_id = $this->Auth->user('id');

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        // タグのリストを取得
        $tags = $this->Articles->Tags->find('list')->all();

        // ビューコンテキストに tags をセット
        $this->set('tags', $tags);

        $this->set('article', $article);
    }

    /**
     * 既存の記事を編集するアクション
     *
     * @param string $slug 編集する記事のスラグ
     * @return \Cake\Http\Response|null|void リダイレクト先
     * @throws \Cake\Datasource\Exception\RecordNotFoundException 記事が見つからない場合
     */
    public function edit(string $slug)
    {
        $article = $this->Articles
            ->findBySlug($slug)
            ->contain('Tags') // 関連づけられた Tags を読み込む
            ->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->getData(), [
                
                // 追加: user_id の更新を無効化
                'accessibleFields' => ['user_id' => false]
            ]);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been updated.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }

        // タグのリストを取得
        $tags = $this->Articles->Tags->find('list')->all();

        // ビューコンテキストに tags をセット
        $this->set('tags', $tags);

        $this->set('article', $article);
    }

    /**
     * 指定されたスラグの記事を削除するアクション
     *
     * @param string $slug 削除する記事のスラグ
     * @return \Cake\Http\Response|null 削除成功時はインデックスページへリダイレクト
     * @throws \Cake\Datasource\Exception\RecordNotFoundException 記事が見つからない場合
     * @throws \Cake\Http\Exception\MethodNotAllowedException 許可されていないHTTPメソッドでアクセスした場合
     */
    public function delete(string $slug)
    {
        $this->request->allowMethod(['post', 'delete']);

        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The {0} article has been deleted.', $article->title));

            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * 指定されたタグを持つ記事を表示するアクション
     *
     * @return void
     */
    public function tags()
    {
        // 'pass' キーは CakePHP によって提供され、リクエストに渡された
        // 全ての URL パスセグメントを含みます。
        $tags = $this->request->getParam('pass');

        // ArticlesTable を使用してタグ付きの記事を検索します。
        $articles = $this->Articles->find('tagged', [
            'tags' => $tags,
        ])
        ->all();

        // 変数をビューテンプレートのコンテキストに渡します。
        $this->set([
            'articles' => $articles,
            'tags' => $tags,
        ]);
    }
}
