<h1>料理の登録</h1>
<form action="create.php" method="POST">
  <div class="form-group">
    <label for="name">料理名</label>
    <input type="text" id="menu_name" class="form-control" name="name" value="">
  </div>
  <div class="mb-3">
    <div class="form-check form-check-inline">
      <label for="menu_kind" class="form-check-label">和食</label>
      <input type="radio" id="menu_kind" class="form-input" name="menu_kind" value="">
    </div>
    <div class="form-check form-check-inline">
      <label for="menu_kind2" class="form-check-label">洋食</label>
      <input type="radio" id="menu_kind" class="form-input" name="menu_kind" value="">
    </div>
    <div class="form-check form-check-inline">
      <label for="menu_kind3" class="form-check-label">中華</label>
      <input type="radio" id="menu_kind" class="form-input" name="menu_kind" value="">
    </div>
  </div>
  <div class="form-group">
    <label for="score">評価（整数1から5より選択）</label>
    <select type="text" id="score" class="form-select" name="score">
      <option selected>1</option>
      <option value="1">2</option>
      <option value="2">3</option>
      <option value="3">4</option>
      <option value="4">5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="recipe">レシピ</label>
    <textarea id="recipe" class="form-control" name="recipe" value="" rows="5"></textarea>
  </div>
  <button class="btn btn-primary" type="submit">登録する</button>
</form>
