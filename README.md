# 前提

## Windows

- WSL2
  - docker
	- make

## MacOS

- docker
- make

# コマンド

## make

- make up - コンテナ起動
- make down - コンテナ停止
- make restart - コンテナ再起動
- make ps - 可動コンテナ確認
- make build - コンテナビルド
- make bash - CakePHPが稼働しているApacheコンテナへbashログイン
- make psql - PostgreSQLコンテナへbashログイン
- make test - UnitTestの実行

## bash

- composer install - パッケージインストール
- composer cs-fix - コードスタイルの自動修正
- composer cs-check - コードスタイルチェック
- composer stan - コード静的解析