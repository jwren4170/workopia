<!-- Header -->
<?= load_partial('head') ?>

<!-- Nav -->
<?= load_partial('nav') ?>

<!-- Showcase -->
<!-- <?= load_partial('showcase') ?> -->

<!-- Top Banner -->
<?= load_partial('top_banner') ?>

<!-- Job Listings -->
<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">
            <?php if (!empty($keywords) && !empty($location)) : ?>
                Search Results for: <span style="color:grey;opacity:0.9;font-weight:400"><?= htmlspecialchars($keywords) ?> in <?= htmlspecialchars($location) ?></span>
            <?php elseif (!empty($keywords)) : ?>
                Search Results for: <span style="color:grey;opacity:0.9;font-weight:400"><?= htmlspecialchars($keywords) ?></span>
            <?php elseif (!empty($location)) : ?>
                Search Results in: <span style="color:grey;opacity:0.9;font-weight:400"><?= htmlspecialchars($location) ?></span>
            <?php else : ?>
                All Jobs
            <?php endif; ?>
        </div>
        <?= load_partial('message') ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Job Listings-->
            <?php foreach ($listings as $listing) : ?>
                <div class="rounded-lg shadow-md bg-white">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold"><?= $listing->title ?></h2>
                        <p class="text-gray-700 text-lg mt-2">
                            <?= $listing->description ?>
                        </p>
                        <ul class="my-4 bg-gray-100 p-4 rounded">
                            <li class="mb-2"><strong>Salary:</strong>&nbsp;<?= format_salary($listing->salary) ?></li>
                            <li class="mb-2">
                                <strong>Location:</strong>&nbsp;<?= $listing->city ?>, <?= $listing->state ?>
                                <span class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2">Local</span>
                            </li>
                            <li class="mb-2">
                                <strong>Tags:</strong>&nbsp;<span><?= $listing->tags ?></span>,
                            </li>
                        </ul>
                        <a href="/workopia/listings/<?= $listing->id ?>" class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                            Details
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</section>

<!-- Bottom Banner -->
<?= load_partial('bottom_banner') ?>

<!-- Footer -->
<?= load_partial('footer') ?>