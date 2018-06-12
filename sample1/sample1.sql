-- データベースsample1の作成
drop database if exists sample1;-- データベースがすでにあるなら削除
create database sample1 charset = utf8mb4;

-- アクセス権限の設定
-- sample1のすべて（*）のテーブルに関する
-- すべて（all）の操作権限を
-- test@localhost（パスワードはpass）に与える。
grant all on sample1.* to test@localhost identified by 'pass';

-- データベースの利用
use sample1;

-- テーブルmembersの作成
create table members (
  id int primary key,
  name varchar(50)
);

-- サンプルデータの追加
insert into members (id, name) values (1, '岩瀬');
insert into members (id, name) values (2, '岩橋');
insert into members (id, name) values (3, '大木');
insert into members (id, name) values (4, '小山');
