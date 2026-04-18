<!-- Post a Job Form Box -->
<div class="flex justify-center items-center mt-20">
    <div class="bg-white shadow-md mx-6 p-8 rounded-lg w-full md:w-600">
        <h2 class="mb-4 font-bold text-4xl text-center">Post a Job</h2>
        <!-- <div class="bg-red-100 my-3 p-3 message">This is an error message.</div>
        <div class="bg-green-100 my-3 p-3 message">
          This is a success message.
        </div> -->
        <form>
            <h2 class="mb-6 font-bold text-gray-500 text-2xl text-center">
                Job Info
            </h2>
            <div class="mb-4">
                <input type="text" name="title" placeholder="Job Title" class="px-4 py-2 border rounded focus:outline-none w-full" />
            </div>
            <div class="mb-4">
                <textarea name="description" placeholder="Job Description" class="px-4 py-2 border rounded focus:outline-none w-full"></textarea>
            </div>
            <div class="mb-4">
                <input type="text" name="salary" placeholder="Annual Salary" class="px-4 py-2 border rounded focus:outline-none w-full" />
            </div>
            <div class="mb-4">
                <input type="text" name="requirements" placeholder="Requirements" class="px-4 py-2 border rounded focus:outline-none w-full" />
            </div>
            <div class="mb-4">
                <input type="text" name="benefits" placeholder="Benefits" class="px-4 py-2 border rounded focus:outline-none w-full" />
            </div>
            <h2 class="mb-6 font-bold text-gray-500 text-2xl text-center">
                Company Info & Location
            </h2>
            <div class="mb-4">
                <input type="text" name="company" placeholder="Company Name" class="px-4 py-2 border rounded focus:outline-none w-full" />
            </div>
            <div class="mb-4">
                <input type="text" name="address" placeholder="Address" class="px-4 py-2 border rounded focus:outline-none w-full" />
            </div>
            <div class="mb-4">
                <input type="text" name="city" placeholder="City" class="px-4 py-2 border rounded focus:outline-none w-full" />
            </div>
            <div class="mb-4">
                <input type="text" name="state" placeholder="State" class="px-4 py-2 border rounded focus:outline-none w-full" />
            </div>
            <div class="mb-4">
                <input type="text" name="phone" placeholder="Phone" class="px-4 py-2 border rounded focus:outline-none w-full" />
            </div>
            <div class="mb-4">
                <input type="email" name="email" placeholder="Email Address For Applications" class="px-4 py-2 border rounded focus:outline-none w-full" />
            </div>
            <button class="bg-green-500 hover:bg-green-600 my-3 px-4 py-2 rounded focus:outline-none w-full text-white">
                Post Job
            </button>
            <a href="/" class="block bg-red-500 hover:bg-red-600 px-4 py-2 rounded focus:outline-none w-full text-white text-center">
                Cancel
            </a>
        </form>
    </div>
</div>