<?php

// 送信確認
// var_dump($_POST);
// exit();
session_start();
include("functions.php");
check_session_id();

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if (
  !isset($_POST['date']) || $_POST['date']=='' ||
  !isset($_POST['jiro-flag']) || $_POST['jiro-flag']=='' ||
  !isset($_POST['shop-name']) || $_POST['shop-name']=='' ||
  !isset($_POST['ordered']) || $_POST['ordered'] == '' ||
  !isset($_POST['area']) || $_POST['area'] == '' ||
  !isset($_POST['nearest-station']) || $_POST['nearest-station']=='' ||
  !isset($_POST['distance']) || $_POST['distance']=='' ||
  !isset($_POST['time-zone']) || $_POST['time-zone'] == ''
) {
  // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

// 受け取ったデータを変数に入れる
$date = $_POST['date'];
$jiro_flag = $_POST['jiro_flag'];
$shop_name = $_POST['shop_name'];
$ordered = $_POST['ordered'];
$area = $_POST['area'];
$nearest_station = $_POST['nearest_station'];
$distance = $_POST['distance'];
$time_zone = $_POST['time_zone'];

// DB接続
$pdo = connect_to_db();

// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'INSERT INTO menlog_table(id, date, jiro_flag, shop_name, ordered, area, nearest_station, distance, time_zone) VALUES(NULL, :date, :jiro_flag, :shop_name, :ordered, :area, :nearest_station, :distance, :time_zone)';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':jiro_flag', $jiro_flag, PDO::PARAM_STR);
$stmt->bindValue(':shop_name', $shop_name, PDO::PARAM_STR);
$stmt->bindValue(':ordered', $ordered, PDO::PARAM_STR);
$stmt->bindValue(':area', $area, PDO::PARAM_STR);
$stmt->bindValue(':nearest_station', $nearest_station, PDO::PARAM_STR);
$stmt->bindValue(':distance', $distance, PDO::PARAM_STR);
$stmt->bindValue(':time_zone', $time_zone, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  header("Location:todo_input.php");
  exit();
}
