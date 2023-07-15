<h1>料理のメモ</h1>
<a class="text-decoration:none" href="../new.php">料理の登録</a>
<h1>料理の一覧</h1>
<?php foreach ($foods as $food) : ?>
  <section class="card">
    <h2>料理名:<?php echo escape($food['name']) ?></h2>&nbsp;|&nbsp;<span>和食</span>&nbsp;|&nbsp;<span>評価</span>
    <p>レシピ</p>
  </section>
<?php endforeach ?>
