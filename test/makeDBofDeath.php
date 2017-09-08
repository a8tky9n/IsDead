<?php
// データベースに接続する
try{
  $db=new PDO("sqlite:CouseOfDeath.db");
}
catch(PDOException $e){
  echo "データベースにアクセスできません".$e->getMessage();
  exit;
}
$create_query=<<<__SQL__
  CREATE TABLE IF NOT EXISTS personal(
    id INTEGER PRAIMARY KEY,
    reason text,
    name text
  );
__SQL__;
// データの挿入
if(isset($_GET[])){
  $Name = $db->quote($_GET['name']);
  $Reason = $db->quote($_GET['reason']);
  $result = $db->exec(
    "INSERT INTO personal(reason,name)".
    "VALUES($Reason,$Name)"
  );
}
?>
