<?php load_partial('head'); ?>
<?php load_partial('navbar'); ?>
<?php load_partial('top-banner'); ?>

<section>
    <div class="mx-auto mt-4 p-4 container">
        <div class="mb-4 p-3 border border-gray-300 font-bold text-3xl text-center"><?= $status ?? '' ?> Error</div>
        <p class="mb-4 text-2xl text-center">
            <?= $message ?? ''; ?>
        </p>
    </div>
</section>

<?php load_partial('footer'); ?>