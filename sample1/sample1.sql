-- データベースsample1の作成
create database sample1 charset=utf8;

-- アクセス権限の設定
grant all on sample1.* to test@localhost identified by 'pass';

-- データベースを使う
use sample1;

-- テーブルmembersの作成
create table members (
  id int primary key,-- idは整数で主キー
  name varchar(50)   -- nameは文字列（最大50文字）
);