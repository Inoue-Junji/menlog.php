<?php
session_start();
include("functions.php");
check_session_id();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>麺ログDB（入力画面）</title>
</head>

<body>
  <form action="create_file.php" method="POST" enctype="multipart/form-data">
    <fieldset>
      <legend>麺ログDB（入力画面）</legend>
      <a href="todo_read.php">一覧画面</a>
      <a href="todo_logout.php">logout</a>
      <div>
        date: <input type="date" name="date">
      </div>
      <div>
        jiro_flag: <input type="hidden" name="jiro_flag" value="0"> <input type="checkbox" name="jiro_flag" value="1">
      </div>
      <div>
        shop_name: <input type="text" name="shop_name">
      </div>
      <div>
        ordered: <input type="text" name="ordered">
      </div>
      <div>
        area: <input type="text" name="area">
      </div>
      <div>
        nearest_station: <input type="text" name="nearest_station">
      </div>
      <div>
        distance: <input type="text" name="distance">
      </div>
      <div>
        time_zone: <input type="time" name="time_zone">
      </div>
      <!-- <div>
        date: <input type="date" name="date">
      </div>
      <div>
        shop_name: <input type="text" name="shop_name">
      </div> -->
      <div>
        input: <input type="file" name="upfile" accept="image/*"capture="camera">
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>