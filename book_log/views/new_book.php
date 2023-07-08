<!-- new.phpおよびcreate_book.phpからの読み込みページ  -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,
  initial-scale=1">
  <link rel="stylesheet" href="stylesheets_book/css/app.css">
  <title>読書ログの登録</title>
</head>

<body>
  <header class=" navbar shadow-sm p-3 py-4 ">
    <h1 class="h2">
      <a class="text-body text-decoration-none" href="new.php">読書ログ</a>
    </h1>
  </header>
  <div class="container ml-5 mt-5">
    <h1 class="mb-4 h3 text-dark">読書ログの登録</h1>
    <form action="create_book.php" method="POST">
      <?php if (count($errors)) : ?>
        <ul class="text-danger">
          <?php foreach ($errors as $error) : ?>
            <li><?php echo $error; ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <div class="h6 form-group">
        <label for="title">書籍名</label>
        <input type="text" id="title" name="title" class="form-control" value="<?php echo $book['title']; ?>">
      </div>
      <div class="h6 form-group">
        <label for="author">著者名</label>
        <input type="text" id="author" name="author" class="form-control" value="<?php echo $book['author']; ?>">
      </div>
      <div class="h6 form-group">
        <label>読書状況</label>
        <div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="unread" name="status" value="unread" checked <?php echo ($book['status'] === 'unread') ? 'checked' : ""; ?>>
            <label class="form-check-label" for="unread">未読</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="reading" name="status" class="form-check form-check-inline" value="reading" <?php echo ($book['status'] === 'reading') ? 'checked' : ""; ?>>
            <label class="form-check-label" for="reading">読んでる</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="complete" name="status" class="form-check form-check-inline" value="complete" <?php echo ($book['status'] === 'complete') ? 'checked' : ""; ?>>
            <label class="form-check-label" for="complete">読了</label>
          </div>
        </div>
      </div>
      <div class="h6 form-group">
        <label for="score">評価（５点満点の整数）</label>
        <select id="score" name="score" class="form-control" value="<?php echo $book['score'] ?>">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
      <div class="h6 form-group">
        <label for="summary">感想</label>
        <textarea type="text" name="summary" class="form-control" id="summary" cols="40" rows="10"><?php echo $book['summary']; ?></textarea>
      </div>
      <button class="btn btn-primary" type=" submit">登録する</button>
    </form>
  </div>
</body>

</html>
