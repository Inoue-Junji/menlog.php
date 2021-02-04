<?php
// var_dump($_FILES);
// exit();
if(!isset($_FILES['upfile']) || $_FILES['upfile']['error'] != 0) {
  // 送られていない、エラーが発生、0じゃないなどの場合
  exit('画像の送信に失敗しました');
} else {
  $uploaded_file_name = $_FILES['upfile']['name']; // ファイル名の取得
  $temp_path = $_FILES['upfile']['tmp_name']; // tmpフォルダの場所
  $directory_path = 'upload/'; // アップロード先フォルダ（↑自分で決める）

  $extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
  $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
  $filename_to_save = $directory_path . $unique_name;
  // var_dump($filename_to_save);
  // exit();
  $img = '';
  if (!is_uploaded_file($temp_path)) {
    exit('Error:画像がないです'); // tmpフォルダにデータがない
  } else { // ↓ここでtmpファイルを移動する
  if (!move_uploaded_file($temp_path, $filename_to_save)) {
    exit('Error:アップロードに失敗しました'); // 画像の保存に失敗
  } else {
    chmod($filename_to_save, 0644); // 権限の変更
    $img = '<img src="' . $filename_to_save . '" >'; // imgタグを設定
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>file_upload</title>
</head>

<body>
  <!-- ここに画像を表示しよう -->
  <?= $img ?> 
</body>

</html>