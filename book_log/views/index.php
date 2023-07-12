<a href="new.php">読書ログを登録する</a>
<main>
  <?php if (count($books) > 0) : ?>
    <?php foreach ($books as $book) : ?>
      <section>
        <h2><?php echo escape($book['title']); ?></h2>
        <div>
          <?php echo escape($book['author']); ?>&nbsp;/&nbsp;
          <?php echo escape($book['status']); ?>&nbsp;/&nbsp;
          <?php echo escape($book['score']); ?>点
        </div>
        <div>
          <?php echo nl2br(escape($book['summary']), false); ?>
        </div>
      </section>
    <?php endforeach ?>
  <?php else : ?>
    <p>読書情報を登録してください。</p>
  <?php endif ?>
</main>
