<nav class="my-6 text-sm text-left text-gray-600 bg-gray-500 bg-opacity-10 h-12 flex items-center p-4 rounded-md " role="alert">
    <ol class="list-reset flex text-grey-dark">
        <li>
            <a href="/">
                Home
            </a>
        </li>
        <li><span class="mx-2">/</span></li>
        <li>
            {{ $slot }}
        </li>
    </ol>
</nav>
