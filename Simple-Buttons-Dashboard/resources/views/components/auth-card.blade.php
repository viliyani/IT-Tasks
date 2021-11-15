<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-blue-400">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-7 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg border-2 border-gray-600">
        {{ $slot }}
    </div>
</div>
