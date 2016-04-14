-- データベースを使う
use sample1;

-- テーブルmembersの作成
drop table if exists members;-- 一度削除する

create table members (
  id int primary key,-- idは整数で主キー
  name varchar(50),  -- nameは文字列（最大50文字）
  lab_id int         -- 研究室のID（面倒になるから外部キーは設定しない）
);

-- データの追加
insert into members (id, name, lab_id) values (1, '岩瀬', 1);
insert into members (id, name, lab_id) values (2, '岩橋', 1);
insert into members (id, name, lab_id) values (3, '大木', 1);
insert into members (id, name, lab_id) values (4, '小山', 1);
insert into members (id, name, lab_id) values (5, 'Alice', 2);

-- テーブルlaboratoriesの作成
drop table if exists laboratories;-- 一度削除する

create table labos (
  id int primary key,-- idは整数で主キー
  name varchar(50),
  place varchar(20)
);

-- データの追加
insert into labos (id, name, place) values (1, '矢吹研', '1号館907');
insert into labos (id, name, place) values (2, '下田研', '1号館1105');
