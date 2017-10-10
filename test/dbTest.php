<?php
// 練習用
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
// 以前にデータを入れていたものがあれば削除をする
$db->exec("DELETE FROM personal");

// データの設定
$data = array(
  array("name"=>"大島優子","hoge"=>"栃木県","year"=>1988),
  array("name"=>"島崎遥香", "home"=>"埼玉県", "year"=>1994),
	array("name"=>"松井珠理奈", "home"=>"愛知県", "year"=>1997),
	array("name"=>"渡辺麻友", "home"=>"埼玉県", "year"=>1994),
	array("name"=>"指原梨乃", "home"=>"大分県", "year"=>1992),
	array("name"=>"柏木由紀", "home"=>"鹿児島県", "year"=>1991),
	array("name"=>"高橋みなみ", "home"=>"東京都", "year"=>1991),
	array("name"=>"川栄利奈", "home"=>"神奈川県", "year"=>1995),
	array("name"=>"小嶋陽菜", "home"=>"埼玉県", "year"=>1988),
	array("name"=>"横山由依", "home"=>"京都府", "year"=>1992)
);

// データの挿入
foreach($data as $i){
  $name = $db->quote($i["name"]);
  $home = $db->quote($i["home"]);
  // 文字にクウォートを足す
  $year = intval($i["year"]);
  $result = $db->exec(
    "INSERT INTO personal(name,home,year)".
    "VALUES($name,$home,$year)");
  if($result === FALSE){
    print_r($db->errorInfo());
  }
}

// データの表示
echo "データベースファイルを作成しました．<br />";
echo "【内容】<br />";
$stmt = $db->query("SELECT * FROM personal");
while($row = $stmt->fetch()){
  $name = $row["name"];
	$home = $row["home"];
	$year = $row["year"];
	echo "・{$name}さんは、{$year}年生まれの{$home}出身です。<br />";
}
?>
