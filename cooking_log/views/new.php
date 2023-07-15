<h1>料理の登録</h1>
<form action="create.php" method="POST">
  <?php if (count($errors)) : ?>
    <ul class="text-danger">
      <?php foreach ($errors as $error) : ?>
        <li><?php echo $error ?></li>
      <?php endforeach ?>
    </ul>
  <?php endif; ?>

  <div class="form-group">
    <label for="name">料理名</label>
    <input type="text" id="name" class="form-control" name="name" value="<?php echo $food['name']; ?>">
  </div>
  <div class="mb-3">
    <div>
      <div class="form-check form-check-inline">
        <label for="和食" class="form-check-label">和食</label>
        <input type="radio" id="和食" class="form-check-input" name="menu_kind" value="和食" checked <?php echo ($food['menu_kind'] === '和食') ? 'checked' : ""; ?>>
      </div>
      <div class="form-check form-check-inline">
        <label for="洋食" class="form-check-label">洋食</label>
        <input type="radio" id="洋食" class="form-check-input" name="menu_kind" value="洋食" <?php echo ($food['menu_kind'] === '洋食') ? 'checked' : ""; ?>>
      </div>
      <div class="form-check form-check-inline">
        <label for="中華" class="form-check-label">中華</label>
        <input type="radio" id="中華" class="form-check-input" name="menu_kind" value="中華" <?php echo ($food['menu_kind'] === '中華') ? 'checked' : ""; ?>>
      </div>
      </dic>
    </div>
    <div class="form-group">
      <label for="score">評価（整数1から5より選択）</label>
      <select id="score" class="form-select" name="score" value="<?php echo $food['score'] ?>">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </select>
    </div>
    <div class="form-group">
      <label for="recipe">レシピ</label>
      <textarea type="text" id="recipe" class="form-control" name="recipe" cols="40" rows="10"><?php echo $food['recipe'] ?></textarea>
    </div>
    <button class="btn btn-primary" type="submit">登録する</button>
</form>
