<h1>料理のメモ</h1>
<a class="text-decoration:none h3 btn btn-primary" href="new.php">料理の登録</a>
<h2 class="text-center">料理の一覧</h2>
<main>
  <?php if (count($foods) > 0) : ?>
    <?php foreach ($foods as $food) : ?>
      <section class="card mb-5">
        <h4>料理名:<?php echo escape($food['name']) ?>
          &nbsp;|&nbsp;和洋中:<?php echo escape($food['menu_Kind']) ?>
          &nbsp;|&nbsp;評価:<?php echo escape($food['score']) ?> </h4>
        <h4>【レシピ】</h4>
        <div class="h4">
          <?php echo escape($food['recipe']) ?>
        </div>
      </section>
    <?php endforeach ?>
  <?php else :  ?>
    <h2 class="text-danger">料理が登録されておりません</h2>
  <?php endif ?>
</main>
