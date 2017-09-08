<?php
// OAuthライブラリの読み込み
require "twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

// 認証情報4つ
$consumerKey = "XRNLBzV8TC5eexSAYcZn0NlSC";
$consumerSecret = "VJmEdeAXZ04sychd8TYINnElpyf5GoxgHbcdIUFi9MWfxqphDb";
$accessToken = "900673512393723906-e6EXYM8QM3H4Y8cyJToADzATjww49h2";
$accessTokenSecret = "XqRzJJD0L1Nq3zmufv00kK0vehRvse4FyzgNlNFNtwlWa";

//接続
$connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

//ツイート
if(isset($_GET['msg'])){
$res = $connection->post("statuses/update", array("status" => $_GET['msg']));
}else{
$res = $connection->post("statuses/update", array("status" => "テストメッセージ"));
}
//レスポンス確認
var_dump($res);
 ?>
