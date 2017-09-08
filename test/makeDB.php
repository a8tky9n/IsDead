<?php
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

// データベースのアップデート
if(isset($_GET['name'])){
  // カウントの修正
  if(isset($_GET['count'])){
    $getDB=$db->query("SELECT * FORM personal WHERE name=$_GET['name']);
    if($getDB === TRUE){
      $c=$_GET['count'];
      $result = $db->exec(
        "UPDATE personal SET count=$c WHERE id=$getDB["name"]"
      );
    }
  }
  else{
    $getDB = $db->query("SELECT * FORM personal WHERE name=$_GET['name']);
    // データの更新
    if($getDB === TRUE){
      $c=$getDB["count"]+1;
      $result = $db->exec(
        "UPDATE personal SET count=$c WHERE id=$getDB["name"]"
      );
    }
    // データの追加
    else{
      $c=1;
      $result = $db->exec(
        "INSERT INTO personal(name,count)".
        "VALUES("$db->quote($_GET['name']),intval($c)")");
      }
    }
  }
}
?>
