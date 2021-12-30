
<nav class="bg-white shadow mb-10">
    <div x-data="{ isOpen: false}" class="max-w-3xl px-6 py-3 md:px-0 md:flex md:justify-between mx-auto md:items-center">
        <div class="flex items-center">
            <img src="https://i.pravatar.cc/50?img=59" alt="avatar" class="rounded-full shadow mr-4">
            <a href="#" class="text-gray-600 hover:text-gray-800 text-xl">Orlando</a>
        </div>

        <!-- hidden menu icon -->
        <div class="flex md:hidden">
            <button class="text-gray-500 focus:outline-none hover:text-gray-600" @click="isOpen = !isOpen" type="button" aria-label="toogle menu"><i class="fa-regular fa-bars"></i></button>
        </div>

        <!-- menu links -->

        <div x-show="isOpen" class="md:flex items-center mt-4">
            <div class="flex flex-col md:flex-row md:ml-6">
                <a href="#" class="my-1 text-sm text-gray-700 hover:text-indigo-500 font-medium md:mx-4 md:my-0">Link 1</a>
                <a href="#" class="my-1 text-sm text-gray-700 hover:text-indigo-500 font-medium md:mx-4 md:my-0">Link 2</a>
                <a href="#" class="my-1 text-sm text-gray-700 hover:text-indigo-500 font-medium md:mx-4 md:my-0">Link 3</a>
            </div>
        </div>
    </div>
</nav>
