<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class=" min-h-screen bg-black text-white">
        <nav class="px-14 py-4 flex items-center justify-between">
            <div class="flex items-center">
                <div class="mr-2">
                    <img src="https://mylionsgeek.ma/logo1.png" alt="logo" class="w-[22px] h-[22px] invert "
                        loading="lazy">
                </div>
                <h1 class=" text-xl lp:text-[20px] m-0 font-plusB ">Lions<span class="text-alpha">Geek</span></h1>
            </div>
            <div class="flex gap-4 tes">
                <a href="{{ route('login') }}"
                    class="rounded-md px-3 py-1 text-black bg-alpha ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Log in
                </a>
            </div>
        </nav>


        <div class="flex justify-center gap-[12vw] items-center pt-20">
            <div class="w-[40%]">
                <h1 class="text-4xl font-bold mb-6 ">
                    Easy Reservation For Equipment & Studios
                </h1>
                <p class="text-gray-400 text-base leading-relaxed mb-8">
                    We pride ourselves on providing you with a smooth and hassle-free experience when it comes <br> to
                    booking
                    equipment and studios for your creative projects. Whether you are an artist, musician, filmmaker
                    or
                    content creator.
                </p>
                <button
                    class="px-8 py-4 bg-alpha text-black rounded-lg font-medium hover:bg-green-500 transition-colors flex items-center justify-center gap-2">
                    Browse Spaces
                    <i class="fa-solid fa-right-long text-sm mt-1"></i>
                </button>
            </div>
            <div>
                <img src="https://mylionsgeek.ma/freind.png" alt="" class="w-[36vw] mb-16">
            </div>
        </div>
        <div class="flex justify-center items-center gap-[5rem] py-16  ">
            <div class="border py-10 px-36 border-gray-300 rounded-lg">
                <div class="flex items-center gap-4 mb-2">
                    <i class="fas fa-users text-xl text-alpha"></i>
                    <span class="text-3xl font-bold">1.0K+</span>
                </div>
                <p class="text-gray-400 text-sm">Active Members</p>
            </div>
            <div class="border py-10 px-36 border-gray-300 rounded-lg">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fa-solid fa-grip text-2xl text-alpha"></i>
                    <span class="text-3xl font-bold">15+</span>
                </div>
                <p class="text-gray-400 text-sm">Creative Spaces</p>
            </div>
            <div class="border py-10 px-36 border-gray-300 rounded-lg">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fa-solid fa-star text-xl text-alpha"></i>
                    <span class="text-3xl font-bold">4.9</span>
                </div>
                <p class="text-gray-400 text-sm">User Rating</p>
            </div>
        </div>


        <div class="grid grid-cols-2 px-24 py-20 gap-4 ">
            <div class="bg-dark p-6 rounded-2xl">
                <i class=" fa-solid fa-microphone text-alpha text-3xl mb-4"></i>
                <h3 class="text-lg font-semibold mb-2">Recording Studios</h3>
                <p class="text-gray-400 text-sm">Professional audio equipment and acoustically treated rooms</p>
            </div>
            <div class="bg-dark p-6 rounded-2xl">
                <i class=" fa-solid fa-camera w-8 h-8 text-alpha text-3xl mb-4"></i>
                <h3 class="text-lg font-semibold mb-2">Photo Studios</h3>
                <p class="text-gray-400 text-sm">High-end cameras and lighting equipment available</p>
            </div>
            <div class="bg-dark p-6 rounded-2xl">
                <i class=" fa-solid fa-desktop w-8 h-8 text-alpha text-3xl mb-4"></i>
                <h3 class="text-lg font-semibold mb-2">Coworking Space</h3>
                <p class="text-gray-400 text-sm">Comfortable workstations with high-speed internet</p>
            </div>
            <div class="bg-dark p-6 rounded-2xl">
                <i class=" fa-solid fa-video w-8 h-8 text-alpha text-3xl mb-4"></i>
                <h3 class="text-lg font-semibold mb-2">Video Production</h3>
                <p class="text-gray-400 text-sm">Full video production setup with green screen</p>
            </div>
        </div>


        <div class="py-20 px-24 border-t border-gray-800">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Featured Spaces</h2>
                <p class="text-gray-400">Discover our most popular creative spaces and equipment.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-dark rounded-2xl overflow-hidden">
                    <img src="https://lionsgeek.ma/static/media/audiovisuelle.9c3b0fc57f9a63fc2886.jpg"
                        alt="Recording Studio" class="w-full h-48 object-cover" />
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Podcast Studio</h3>
                        <p class="text-gray-400 text-sm mb-4">A fully equipped studio with professional audio recording and mixing equipment.</p>
                        <div>
                            <a href=""
                                class="px-4 py-2 bg-alpha/10 text-alpha rounded-lg hover:bg-alpha/20 transition-colors">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
                <div class="bg-dark rounded-2xl overflow-hidden">
                    <img src="https://media-hosting.imagekit.io//15adbca1a83a4a72/6596787b20a8d.jpg?Expires=1834864768&Key-Pair-Id=K2ZIVPTIP2VGHC&Signature=fcs2J35gMyNKjg8wp~NTixI~vNMXgWKyKpxs3fXKm7jerQFZ1N7-nMaYpkvG3A6MynGpbsxtH3ykCO2eEUrTkukcdK7jilY9KEGqC4ABd~ZRwxcBdfs3XRkPkY-PE-fHWHtSB3A-MRs6NwlLdAdAdlOQKJq0uVUGV-h0yebZrThbvvmnHbe28bKhIltD3B9gWCtJHEOONB99TvlLAKxZb4moXnWL-mpDCGj-3n9dFsoGHxgMXLWkYrI7EwtFlOXcku92h-J~-iiE70nYpE3SVRii1~rkEZ3CoqZBpK8Ba4DZOiK~sy7ajM56UfoLY4q0nbnXxHehv2jkSyfnFZVxMw__"
                        alt="Photo Studio" class="w-full h-48 object-cover" />
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Photo Studio</h3>
                        <p class="text-gray-400 text-sm mb-4">A professional studio with high-quality lighting and versatile backdrop options.</p>
                        <div>
                            <a href=""
                                class="px-4 py-2 bg-alpha/10 text-alpha rounded-lg hover:bg-alpha/20 transition-colors">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
                <div class="bg-dark rounded-2xl overflow-hidden">
                    <img src="https://lh3.googleusercontent.com/p/AF1QipMGz4HoXyvK7HitvmR66V0-KjY-mYQWhMsIMx3b=s1360-w1360-h1020"
                        alt="Coworking Space" class="w-full h-48 object-cover" />
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Coworking Space</h3>
                        <p class="text-gray-400 text-sm mb-4">A modern shared workspace featuring high-speed internet, and collaboration areas.</p>
                        <div>
                            <a href=""
                                class="px-4 py-2 bg-alpha/10 text-alpha rounded-lg hover:bg-alpha/20 transition-colors">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
