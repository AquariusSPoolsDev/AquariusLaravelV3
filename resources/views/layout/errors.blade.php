<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=inter:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
</head>

<body>
    <div class="bg-gradient-to-b from-sky-200 to-blue-300 w-screen h-screen font-[Inter] relative">
        <div class="absolute inset-0 container mx-auto p-6 flex flex-col items-center justify-center">
            <div class="text-center text-blue-950">
                <h1 class="text-7xl lg:text-9xl font-bold">@yield('code')</h1>
                <h2 class="mt-4 mb-6 uppercase text-xl font-semibold">@yield('message')</h2>
            </div>
            <div class="uppercase text-center flex flex-wrap items-center justify-center gap-3">
                <a href="/" class="py-3 px-6 inline-flex items-center gap-3 font-medium rounded-full border border-transparent bg-blue-700 text-white hover:bg-blue-800 focus:outline-none focus:bg-blue-800 disabled:opacity-50 disabled:pointer-events-none">Back to Homepage</a>
                <a href="/contact" class="py-3 px-6 inline-flex items-center gap-3 font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">Contact us</a>
            </div>

        </div>
    </div>

    <style>

    </style>
</body>

</html>