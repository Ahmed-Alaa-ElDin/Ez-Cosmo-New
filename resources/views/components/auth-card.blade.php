<div class="min-h-screen p-5 flex flex-col sm:justify-center items-center pt-10 sm:pt-0 bg-red-100">
    <div>
        {{ $logo }}
    </div>

    <div class="w-1/2 sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
