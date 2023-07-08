<?php
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,
  initial-scale=1">
  <title>読書ログの登録</title>
</head>

<body>
  <h1>読書ログの登録</h1>
  <form action="create_book.php" method="POST">
    <div>
      <label for="title">書籍名</label>
      <input type="text" id="title" name="title">
    </div>
    <div>
      <label for="author">著者名</label>
      <input type="text" id="author" name="author">
    </div>
    <div>
      <label>読書状況</label>
      <div>
        <div>
          <input type="radio" id="unread" name="status" value="unread">
          <label for="unread">未読</label>
          <!-- </div> -->
          <!-- <div> -->
          <input type="radio" id="reading" name="status" value="reading">
          <label for="reading">読んでる</label>
          <!-- </div> -->
          <!-- <div> -->
          <input type="radio" id="complete" name="status" value="complete">
          <label for="complete">読了</label>
        </div>
      </div>
    </div>
    <div>
      <label for="score">評価（５点満点の整数）</label>
      <input type="number" id="score" name="score">
    </div>
    <div>
      <label for="summary">感想</label>
      <textarea type="text" name="summary" id="summary" cols="40" rows="10"></textarea>
    </div>
    <button type="submit">登録する</button>
  </form>

</html>
