<?php load_partial('head'); ?>
<?php load_partial('navbar'); ?>
<?php load_partial('top-banner'); ?>

<section class="mx-auto mt-4 p-4 container">
    <div class="bg-white shadow-md p-3 rounded-lg">
        <div class="flex justify-between items-center">
            <a class="block p-4 text-blue-700" href="/listings">
                <i class="fa-arrow-alt-circle-left fa"></i>
                Back To Listings
            </a>
            <div class="flex space-x-4 ml-4">
                <a href="/edit" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded text-white">Edit</a>
                <!-- Delete Form -->
                <form method="POST">
                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white">Delete</button>
                </form>
                <!-- End Delete Form -->
            </div>
        </div>
        <div class="p-4">
            <h2 class="font-semibold text-xl"><?= $listing->title ?></h2>
            <p class="mt-2 text-gray-700 text-lg">
                <?= $listing->description ?>
            </p>
            <ul class="bg-gray-100 my-4 p-4">
                <li class="mb-2"><strong>Salary: </strong><?= format_salary($listing->salary) ?></li>
                <li class="mb-2">
                    <strong>Location:</strong> <?= $listing->city ?>, <?= $listing->state ?>
                    <span
                        class="bg-blue-500 ml-2 px-2 py-1 rounded-full text-white text-xs">Local</span>
                </li>
                <li class="mb-2">
                    <strong>Tags: </strong> <span><?= $listing->tags ?></span>,
                </li>
            </ul>
        </div>
    </div>
</section>

<section class="mx-auto p-4 container">
    <h2 class="mb-4 font-semibold text-xl">Job Details</h2>
    <div class="bg-white shadow-md p-4 rounded-lg">
        <h3 class="mb-2 font-semibold text-blue-500 text-lg">
            Job Requirements
        </h3>
        <p>
            <?= $listing->requirements ?>
        </p>
        <h3 class="mt-4 mb-2 font-semibold text-blue-500 text-lg">Benefits</h3>
        <p><?= $listing->benefits ?></p>
    </div>
    <p class="my-5">
        Put "Job Application" as the subject of your email and attach your
        resume.
    </p>
    <a
        href="mailto:<?= $listing->company ?>"
        class="block bg-indigo-100 hover:bg-indigo-200 shadow-sm px-5 py-2.5 border rounded w-full font-medium text-indigo-700 text-base text-center cursor-pointer">
        Apply Now
    </a>
</section>

<?php load_partial('bottom-banner'); ?>
<?php load_partial('footer'); ?>