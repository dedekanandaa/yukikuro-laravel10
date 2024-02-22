<nav class="sticky top-0 bg-white border z-50">
    <div class="max-w-screen-xl md:w-10/12 flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="/image/logo.jpg" class="h-8" alt="Kuro Logo" />
            <span class="self-center font-mono text-2xl font-semibold whitespace-nowrap">Yuki Kuro</span>
        </a>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-neutral-100 rounded-lg bg-neutral-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white">
                <li>
                    <a href="/"
                        class="block py-2 px-3 text-white bg-neutral-700 rounded md:bg-transparent md:text-neutral-700 md:p-0"
                        aria-current="page">Home</a>
                </li>
                <li>
                    <a href="/about"
                        class="block py-2 px-3 text-neutral-900 rounded hover:bg-neutral-100 md:hover:bg-transparent md:border-0 md:hover:text-neutral-700 md:p-0">About</a>
                </li>
                <li>
                    <a href="/shop"
                        class="block py-2 px-3 text-neutral-900 rounded hover:bg-neutral-100 md:hover:bg-transparent md:border-0 md:hover:text-neutral-700 md:p-0">Shop</a>
                </li>
                <li>
                    <a href="/blog"
                        class="block py-2 px-3 text-neutral-900 rounded hover:bg-neutral-100 md:hover:bg-transparent md:border-0 md:hover:text-neutral-700 md:p-0">Blog</a>
                </li>
            </ul>
        </div>

        <button data-collapse-toggle="navbar-hamburger" type="button"
            class="md:hidden inline-flex items-center justify-center p-2 h- text-sm text-neutral-500 rounded-lg hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-neutral-200"
            aria-controls="navbar-hamburger" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full" id="navbar-hamburger">
            <ul class="flex flex-col font-medium mt-4  bg-neutral-50">
                <li>
                    <a href="/" class="block py-2 px-3 text-neutral-900 hover:bg-neutral-100">Home</a>
                </li>
                <li>
                    <a href="/about" class="block py-2 px-3 text-neutral-900 hover:bg-neutral-100">About</a>
                </li>
                <li>
                    <a href="/shop" class="block py-2 px-3 text-neutral-900 hover:bg-neutral-100">Shop</a>
                </li>
                <li>
                    <a href="/blog" class="block py-2 px-3 text-neutral-900 hover:bg-neutral-100">Blog</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
