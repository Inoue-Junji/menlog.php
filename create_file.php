<?php
session_start();
include("functions.php");
check_session_id();
// DB接続
$pdo = connect_to_db();
// var_dump($_POST["jiro_flag"]);
// exit();
if (
  !isset($_POST['date']) || $_POST['date']=='' ||
  !isset($_POST['shop_name']) || $_POST['shop_name']=='' ||
  !isset($_POST['ordered']) || $_POST['ordered'] == '' ||
  !isset($_POST['area']) || $_POST['area'] == '' ||
  !isset($_POST['nearest_station']) || $_POST['nearest_station']=='' ||
  !isset($_POST['distance']) || $_POST['distance']=='' ||
  !isset($_POST['time_zone']) || $_POST['time_zone'] == ''
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

// ここからファイルアップロード&DB登録の処理を追加しよう！！！
// var_dump($_FILES);
// exit();
// 以下、file_upload.phpとほぼ同じ
if(!isset($_FILES['upfile']) || $_FILES['upfile']['error'] != 0) {
  exit('画像の送信に失敗しました');
} else {
  $uploaded_file_name = $_FILES['upfile']['name'];
  $temp_path = $_FILES['upfile']['tmp_name'];
  $directory_path = 'upload/';
  // ファイルの保存場所をファイル名に追加
  $extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
  $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
  $filename_to_save = $directory_path . $unique_name;
  // 最終的に「upload/hogehoge.php」のような形になる

  // var_dump($filename_to_save);
  // exit();
  $img = '';
  if (!is_uploaded_file($temp_path)) {
    exit('画像がないです'); // tmpフォルダにデータがない
  } else { // ↓ここでtmpファイルを移動する
  if (!move_uploaded_file($temp_path, $filename_to_save)) {
    exit('アップロードに失敗しました'); // 画像の保存に失敗
  } else {
    chmod($filename_to_save, 0644); //権限の変更
    // $img = '<img src="' . $filename_to_save . '" >';
    }
  }
}
// 以下、todo_create.phpとほぼ同じ
// var_dump($filename_to_save);
// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'INSERT INTO menlog_table(id, date, jiro_flag, shop_name, ordered, area, nearest_station, distance, time_zone, image) 
VALUES(NULL, :date, :jiro_flag, :shop_name, :ordered, :area, :nearest_station, :distance, :time_zone, :image)';

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
// :imgに＄filename_to_saveをいれる
$stmt->bindValue(':image', $filename_to_save, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:todo_input.php");
  exit();
}