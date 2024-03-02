<!-- Header -->
<?= load_partial('head') ?>

<!-- Nav -->
<?= load_partial('nav') ?>

<!-- Showcase -->
<!-- <?= load_partial('showcase') ?> -->

<!-- Top Banner -->
<!-- <?= load_partial('top_banner') ?> -->

<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3"><?= $status ?></div>
        <p class="text-center text-2xl mb-4">
            <?= $message ?>
        </p>
        <a class="text-center text-amber-900 block" href="/workopia/listings">Back to listings</a>
    </div>
</section>

<!-- Bottom Banner -->
<!-- <?= load_partial('bottom_banner') ?> -->

<!-- Footer -->
<?= load_partial('footer') ?>