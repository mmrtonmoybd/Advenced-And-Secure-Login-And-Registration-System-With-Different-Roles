
    <?php foreach ($errors as $error) : ?>
	<div class="alert alert-danger" role="alert">
        <?= esc($error) ?>
		</div>
    <?php endforeach ?>
