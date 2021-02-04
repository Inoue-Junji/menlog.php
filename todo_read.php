<?php
session_start();
include("functions.php");
check_session_id();

// ユーザ名取得
$user_id = $_SESSION['id'];

// DB接続
$pdo = connect_to_db();

// いいね数カウント


// データ取得SQL作成
$sql = "SELECT * FROM menlog_table LEFT OUTER JOIN (SELECT shop_name_id, COUNT(id) AS cnt FROM likes_table GROUP BY shop_name_id) AS likes ON menlog_table.id = likes.shop_name_id";
// "SELECT * FROM tablea LEFT OUTER JOIN tableb ON tablea.id = tableb.id";
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
  $output = "";
  // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td>{$record["date"]}</td>";
    $output .= "<td>{$record["jiro_flag"]}</td>";
    $output .= "<td>{$record["shop_name"]}</td>";
    $output .= "<td>{$record["ordered"]}</td>";
    $output .= "<td>{$record["area"]}</td>";
    $output .= "<td>{$record["nearest_station"]}</td>";
    $output .= "<td>{$record["distance"]}</td>";
    $output .= "<td>{$record["time_zone"]}</td>";
    // $output .= "<td>{$record["deadline"]}</td>";
    // $output .= "<td>{$record["todo"]}</td>";
    $output .= "<td><a href='like_create.php?user_id={$user_id}&menlog_id={$record["id"]}'>like{$record["cnt"]}</a></td>";
    $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>edit</a></td>";
    $output .= "<td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>";
    // 画像出力を追加しよう
    $output .= "<td><img src='{$record["image"]}' height='150px'></td>";
    $output .= "</tr>";
  }
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($value);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>麺ログDB（一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>麺ログDB（一覧画面）</legend>
    <a href="todo_input.php">入力画面</a>
    <a href="todo_logout.php">logout</a>
    <table>
      <thead>
        <tr>
          <th>date</th>
          <th>shop_name</th>
          <th>ordered</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>