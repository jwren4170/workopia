<?php load_partial('head'); ?>
<?php load_partial('navbar'); ?>
<?php load_partial('showcase-search'); ?>
<?php load_partial('top-banner'); ?>

<a href="/workopia/listings" class="block text-xl text-center">
    <i class="fa-arrow-alt-circle-right fa"></i>
    Show All Jobs
</a>
<div class="mx-auto mt-4 p-4 container">
    <div class="mb-4 p-3 border border-gray-300 font-bold text-3xl text-center">Recent Jobs</div>
    <div class="gap-4 grid grid-cols-1 md:grid-cols-3 mb-6">
        <!-- Job Listing 1: Software Engineer -->
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-4">
                <h2 class="font-semibold text-xl">Software Engineer</h2>
                <p class="mt-2 text-gray-700 text-lg">
                    We are seeking a skilled software engineer to develop
                    high-quality software solutions.
                </p>
                <ul class="bg-gray-100 my-4 p-4 rounded">
                    <li class="mb-2"><strong>Salary:</strong> $80,000</li>
                    <li class="mb-2">
                        <strong>Location:</strong> New York
                        <span class="bg-blue-500 ml-2 px-2 py-1 rounded-full text-white text-xs">Local</span>
                    </li>
                    <li class="mb-2">
                        <strong>Tags:</strong> <span>Development</span>,
                        <span>Coding</span>
                    </li>
                </ul>
                <a href="details.html" class="block bg-indigo-100 hover:bg-indigo-200 shadow-sm px-5 py-2.5 border rounded w-full font-medium text-indigo-700 text-base text-center">
                    Details
                </a>
            </div>
        </div>

        <!-- Job Listing 2: Marketing Specialist -->
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-4">
                <h2 class="font-semibold text-xl">Marketing Specialist</h2>
                <p class="mt-2 text-gray-700 text-lg">
                    We are looking for a Marketing Specialist to create and manage
                    marketing campaigns.
                </p>
                <ul class="bg-gray-100 my-4 p-4 rounded">
                    <li class="mb-2"><strong>Salary:</strong> $70,000</li>
                    <li class="mb-2">
                        <strong>Location:</strong> San Francisco
                        <span class="bg-blue-500 ml-2 px-2 py-1 rounded-full text-white text-xs">Remote</span>
                    </li>
                    <li class="mb-2">
                        <strong>Tags:</strong> <span>Marketing</span>,
                        <span>Advertising</span>
                    </li>
                </ul>
                <a href="details.html" class="block bg-indigo-100 hover:bg-indigo-200 shadow-sm px-5 py-2.5 border rounded w-full font-medium text-indigo-700 text-base text-center">
                    Details
                </a>
            </div>
        </div>

        <!-- Job Listing 3: Web Developer -->
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-4">
                <h2 class="font-semibold text-xl">Web Developer</h2>
                <p class="mt-2 text-gray-700 text-lg">
                    Join our team as a Web Developer and create amazing web
                    applications.
                </p>
                <ul class="bg-gray-100 my-4 p-4 rounded">
                    <li class="mb-2"><strong>Salary:</strong> $75,000</li>
                    <li class="mb-2">
                        <strong>Location:</strong> Los Angeles
                        <span class="bg-blue-500 ml-2 px-2 py-1 rounded-full text-white text-xs">Local</span>
                    </li>
                    <li class="mb-2">
                        <strong>Tags:</strong> <span>Web Development</span>,
                        <span>Programming</span>
                    </li>
                </ul>
                <a href="details.html" class="block bg-indigo-100 hover:bg-indigo-200 shadow-sm px-5 py-2.5 border rounded w-full font-medium text-indigo-700 text-base text-center">
                    Details
                </a>
            </div>
        </div>
    </div>
    <?php load_partial('bottom-banner'); ?>
    <?php load_partial('footer'); ?>