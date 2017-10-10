<?php
// Unityから叩いて名前を取得するスクリプト
// データベースに接続する
try{
  $db=new PDO("sqlite:killer.db");
}
catch(PDOException $e){
  echo "データベースにアクセスできません".$e->getMessage();
  exit;
}
$create_query=<<<__SQL__
  CREATE TABLE IF NOT EXISTS personal(
    id INTEGER PRIMARY KEY,
    name text,
    count INTEGER
  );
__SQL__;
// データベースの中身を取得
$stmt = $db->query("SELECT * FROM personal ORDER BY count DESC");
while($row = $stmt->fetch()){
  $name = $row["name"];
	echo "{$name},";
}
?>
