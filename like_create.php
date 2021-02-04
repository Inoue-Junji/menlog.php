<?php

// var_dump($_GET);
// exit();

include('functions.php');

$user_id = $_GET['user_id'];
$shop_name_id = $_GET['shop_name_id'];

$pdo = connect_to_db();

$sql = 'SELECT COUNT(*) FROM likes_table WHERE user_id=:user_id AND shop_name_id=:shop_name_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':shop_name_id', $shop_name_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $likes_count = $stmt->fetch();
  // var_dump($like_count);
  // exit();
}

if ($likes_count[0] != 0) {
  // データがあった場合
  $sql = 'DELETE FROM likes_table WHERE user_id=:user_id AND shop_name_id=:shop_name_id';
} else {
  // データが無かった場合
  $sql = 'INSERT INTO likes_table (id, user_id, shop_name_id, created_at) VALUES (NULL, :user_id, :shop_name_id, sysdate())';
}

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':shop_name_id', $shop_name_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header('Location:todo_read.php');
}
