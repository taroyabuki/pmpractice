-- データベースsample1の作成
drop database if exists sample1;
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

-- データの追加
insert into members (id, name) values (1, '岩瀬');
insert into members (id, name) values (2, '岩橋');
insert into members (id, name) values (3, '大木');
insert into members (id, name) values (4, '小山');
