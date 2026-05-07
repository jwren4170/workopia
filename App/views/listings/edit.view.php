<?php

/** @var object $listing */ ?>

<?php load_partial('head') ?>
<?php load_partial('navbar') ?>
<?php load_partial('top-banner') ?>

<section class="flex justify-center items-center mt-20">
    <div class="bg-white shadow-md mx-6 p-8 rounded-lg w-full md:w-600">
        <h2 class="mb-4 font-bold text-4xl text-center">Edit Job Listing</h2>
        <form method="POST" action="/workopia/listings/<?= $listing->id ?>">
            <input type="hidden" name="_method" value="PUT">
            <h2 class="mb-6 font-bold text-gray-500 text-2xl text-center">
                Job Info
            </h2>
            <?php load_partial('errors', [
                'errors' => $errors ?? []
            ]) ?>
            <div class="mb-4">
                <input type="text" name="title" placeholder="Job Title" class="px-4 py-2 border rounded focus:outline-none w-full" value="<?= $listing->title ?? '' ?>" />
            </div>
            <div class="mb-4">
                <textarea name="description" placeholder="Job Description" class="px-4 py-2 border rounded focus:outline-none w-full"><?= $listing->description ?? '' ?></textarea>
            </div>
            <div class="mb-4">
                <input type="text" name="salary" placeholder="Annual Salary" class="px-4 py-2 border rounded focus:outline-none w-full" value="<?= $listing->salary ?? '' ?>" />
            </div>
            <div class="mb-4">
                <input type="text" name="requirements" placeholder="Requirements" class="px-4 py-2 border rounded focus:outline-none w-full" value="<?= $listing->requirements ?? '' ?>" />
            </div>
            <div class="mb-4">
                <input type="text" name="benefits" placeholder="Benefits" class="px-4 py-2 border rounded focus:outline-none w-full" value="<?= $listing->benefits ?? '' ?>" />
            </div>
            <div class="mb-4">
                <input type="text" name="tags" placeholder="Tags" class="px-4 py-2 border rounded focus:outline-none w-full" value="<?= $listing->tags ?? '' ?>" />
            </div>
            <h2 class="mb-6 font-bold text-gray-500 text-2xl text-center">
                Company Info & Location
            </h2>
            <div class="mb-4">
                <input type="text" name="company" placeholder="Company Name" class="px-4 py-2 border rounded focus:outline-none w-full" value="<?= $listing->company ?? '' ?>" />
            </div>
            <div class="mb-4">
                <input type="text" name="address" placeholder="Address" class="px-4 py-2 border rounded focus:outline-none w-full" value="<?= $listing->address ?? '' ?>" />
            </div>
            <div class="mb-4">
                <input type="text" name="city" placeholder="City" class="px-4 py-2 border rounded focus:outline-none w-full" value="<?= $listing->city ?? '' ?>" />
            </div>
            <div class="mb-4">
                <input type="text" name="state" placeholder="State" class="px-4 py-2 border rounded focus:outline-none w-full" value="<?= $listing->state ?? '' ?>" />
            </div>
            <div class="mb-4">
                <input type="text" name="phone" placeholder="Phone" class="px-4 py-2 border rounded focus:outline-none w-full" value="<?= $listing->phone ?? '' ?>" />
            </div>
            <div class="mb-4">
                <input type="email" name="email" placeholder="Email Address For Applications" class="px-4 py-2 border rounded focus:outline-none w-full" value="<?= $listing->email ?? '' ?>" />
            </div>
            <button type="submit" class="bg-green-500 hover:bg-green-600 my-3 px-4 py-2 rounded focus:outline-none w-full text-white">
                Update Listing
            </button>
            <a href="/listings/<?= $listing->id ?>" class="block bg-red-500 hover:bg-red-600 px-4 py-2 rounded focus:outline-none w-full text-white text-center">
                Cancel
            </a>
        </form>
    </div>
</section>

<?php load_partial('bottom-banner') ?>
<?php load_partial('footer') ?>