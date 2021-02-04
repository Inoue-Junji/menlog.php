<?php
// 送信データのチェック
// var_dump($_GET);
// exit();
session_start();

// 関数ファイルの読み込み
include("functions.php");
check_session_id();

$id = $_GET["id"];

$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM menlog_table WHERE id=:id';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は指定の11レコードを取得
  // fetch()関数でSQLで取得したレコードを取得できる
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>麺ログDB（編集画面）</title>
</head>

<body>
  <form action="todo_update.php" method="POST">
    <fieldset>
      <legend>麺ログDB（編集画面）</legend>
      <a href="todo_read.php">一覧画面</a>
      <div>
        date: <input type="date" name="date" value="<?= $record["date"] ?>">
      </div>
      <div>
        jiro_flag: <input type="checkbox" name="jiro_flag" value="<?= $record["jiro_flag"] ?>">
      </div>
      <div>
        shop_name: <input type="text" name="shop_name" value="<?= $record["shop_name"] ?>">
      </div>
      <div>
        ordered: <input type="text" name="ordered" value="<?= $record["ordered"] ?>">
      </div>
      <div>
        area: <input type="text" name="area" value="<?= $record["area"] ?>">
      </div>
      <div>
        nearest_station: <input type="text" name="nearest_station" value="<?= $record["nearest_station"] ?>">
      </div>
      <div>
        distance: <input type="text" name="distance" value="<?= $record["distance"] ?>">
      </div>
      <div>
        time_zone: <input type="time" name="time_zone" value="<?= $record["time_zone"] ?>">
      </div>
      <div>
        <button>submit</button>
      </div>
      <input type="hidden" name="id" value="<?= $record["id"] ?>">
    </fieldset>
  </form>

</body>

</html>