<?php
// データベースに接続する
try{
  $db = new PDO("sqlite:test.db");
}catch(PDOException $e){
  echo "データベースにアクセスできません".$e->getMessage();
  exit;
}
// テーブルを作成する
$create_query = <<<__SQL__
  CREATE TABLE IF NOT EXISTS personal(
  id INTEGER PRIMARY KEY,
  name text,
  home text,
  year INTEGER
  );
__SQL__;

// SQLの実行
$result =$db->exec($create_query);
// エラー処理
if($result === false){
  print_r($db->errorInfo());
  exit;
}
// データの表示
$stmt = $db->query("SELECT * FROM personal ORDER BY year DESC");
while($row = $stmt->fetch()){
  $name = $row["name"];
	$home = $row["home"];
	$year = $row["year"];
	echo "{$name},";
}
?>
