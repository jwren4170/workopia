<?php load_partial('head'); ?>
<?php load_partial('navbar'); ?>
<?php load_partial('showcase-search'); ?>
<?php load_partial('top-banner'); ?>

<div class="mx-auto mt-4 p-4 container">
    <div class="mb-4 p-3 border border-gray-300 font-bold text-3xl text-center">Recent Jobs</div>
    <div class="gap-4 grid grid-cols-1 md:grid-cols-3 mb-6">

        <!-- Job Listings -->
        <?php /** @var array $listings */ ?>
        <?php foreach ($listings as $listing): ?>
            <div class="bg-white shadow-md rounded-lg">
                <div class="p-4">
                    <h2 class="font-semibold text-xl"><?= $listing->title ?></h2>
                    <p class="mt-2 text-gray-700 text-lg">
                        <?= $listing->description ?>
                    </p>
                    <ul class="bg-gray-100 my-4 p-4 rounded">
                        <li class="mb-2"><strong>Salary: </strong><?= format_salary($listing->salary) ?></li>
                        <li class="mb-2">
                            <strong>Location: </strong><?= $listing->city ?>, <?= $listing->state ?>
                            <span class="bg-blue-500 ml-2 px-2 py-1 rounded-full text-white text-xs">Local</span>
                        </li>
                        <li class="mb-2">
                            <strong>Tags:</strong>
                            <?= $listing->tags ?>
                        </li>
                    </ul>
                    <a href="/workopia/listings/<?= $listing->id ?>" class="block bg-indigo-100 hover:bg-indigo-200 shadow-sm px-5 py-2.5 border rounded w-full font-medium text-indigo-700 text-base text-center">
                        Details
                    </a>
                </div>
            </div>
        <?php endforeach ?>

    </div>
    <a href="/workopia/listings" class="block text-xl text-center">
        <i class="fa-arrow-alt-circle-right fa"></i>
        Show All Jobs
    </a>
</div>
<?php load_partial('bottom-banner'); ?>
<?php load_partial('footer'); ?>