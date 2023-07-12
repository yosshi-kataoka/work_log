<a href="new.php" class="btn btn-primary mb-4">読書ログを登録する</a>
<main>
  <?php if (count($books) > 0) : ?>
    <?php foreach ($books as $book) : ?>
      <section class="card mb-4 shadow-sm">
        <div class="card-body">
          <h2 class="card-title h3 text-dark mb-3"><?php echo escape($book['title']); ?></h2>
          <div class="small">
            <?php echo escape($book['author']); ?>&nbsp;/&nbsp;
            <?php echo escape($book['status']); ?>&nbsp;/&nbsp;
            <?php echo escape($book['score']); ?>点
          </div>
          <div>
            <?php echo nl2br(escape($book['summary']), false); ?>
          </div>
        </div>
      </section>
    <?php endforeach ?>
  <?php else : ?>
    <p>読書情報を登録してください。</p>
  <?php endif ?>
</main>
