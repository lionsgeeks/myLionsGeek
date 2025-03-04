<div class="swiper-container relative">
    <div class="swiper-wrapper">
        @foreach ($images as $image)
            <div class="swiper-slide">
                <img class="rounded-t-md object-cover w-full h-[25vh]" src="{{ asset('storage/images/equipment/' . $image->path ) }}" alt="">
            </div>
        @endforeach
    </div>
    <!-- Add Navigation -->
    <button class="button-next z-20 text-5xl  flex items-center justify-center w-[3vw] h-[6vh] rounded-full absolute top-[50%]  right-3 transform -translate-y-1/2 "><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 12 24"><path fill="currentColor" fill-rule="evenodd" d="M10.157 12.711L4.5 18.368l-1.414-1.414l4.95-4.95l-4.95-4.95L4.5 5.64l5.657 5.657a1 1 0 0 1 0 1.414"/></svg></button>
    <button class="button-prev z-20 text-5xl  flex items-center justify-center w-[3vw] h-[6vh] rounded-full absolute top-[50%]  left-3 transform -translate-y-1/2 "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="m15 4l2 2l-6 6l6 6l-2 2l-8-8z"/></svg></button>
</div>
