<?php if (isset($errors)) : ?>
    <?php foreach ($errors as $error) : ?>
        <div class="message text-red-950 my-3"><?= $error ?></div>
    <?php endforeach; ?>
<?php endif; ?>