<div class="p-10  bg-[#171717] min-h-screen">

    <!-- Search  -->
    <div class="flex items-center gap-4 p-4">
        <div id="search" class="relative w-full max-w-md">
            <input
           
                wire:model.live.debounce.500ms="search"
                type="text"
                placeholder="Search by formations..."
                class="border border-gray-600 p-2 rounded-lg w-full pl-12 bg-[#2E2E2E] text-white 
                       focus:ring-2 focus:ring-[#fee814] focus:outline-none placeholder:text-sm"
            >
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400" 
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M21 21l-4.35-4.35M17 10A7 7 0 1110 3a7 7 0 017 7z" />
            </svg>
        </div>
        <button  wire:click="resetSearch"  class="bg-[#fee814] hover:bg-yellow-500 text-black px-4 py-2 rounded-lg font-medium transition">
            Reset
        </button>
    </div>
    

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-[3vw]">
        <!-- Add Formation  -->
        <div class="flex flex-col items-center justify-center border-dashed border-2 border-white h-75 rounded-lg hover:border-gray-600 transition-colors cursor-pointer hover:shadow-md"
             wire:click="$set('showModal', true)">
            <button class="text-white text-4xl font-bold">+</button>
            <span class="text-white font-medium mt-2">
                {{ $updateData ? 'Edit Formation' : 'Add Formation' }}
            </span>
        </div>

        <!-- Formation Cards -->
        @foreach ($formations as $formation)
        <div wire:key="{{ $formation->id }}" class="relative rounded-lg h-72 overflow-hidden shadow-md hover:shadow-xl transition-all transform hover:scale-105 flex flex-col justify-between">
            <!-- Image ou Carrousel -->
            <div class="relative overflow-hidden">
                @if ($formation->images->count() > 1)
                    <div class="swiper-container relative z-10">
                        <div class="swiper-wrapper">
                            @foreach ($formation->images as $image)
                                <div class="swiper-slide">
                                    <img class="rounded-t-md object-cover w-full h-[25vh]" src="{{ asset('storage/images/formation/' . $image->path ) }}" alt="">
                                </div>
                            @endforeach
                        </div>
                        <button class="button-next z-50 text-5xl flex items-center justify-center w-[3vw] h-[6vh] rounded-full absolute top-[50%] right-3 transform -translate-y-1/2">></button>
                        <button class="button-prev z-50 text-5xl flex items-center justify-center w-[3vw] h-[6vh] rounded-full absolute top-[50%] left-3 transform -translate-y-1/2"><</button>
                    </div>
                @else
                    <img class="rounded-t-md object-cover w-full h-[25vh]" src="{{ asset('storage/images/formation/' .$formation->images->first()?->path ) }}" alt="">
                @endif
            </div>

            <!-- Contenu principal -->
            <div class="bg-[#2E2E2E] p-5 rounded-b-lg flex flex-col flex-grow">
                <h3 class="text-white font-semibold text-lg">{{ $formation->class_name }}</h3>
                <p class="text-gray-300 text-sm">{{ $formation->formation_name }}</p>
                <div class="text-gray-400 text-xs space-y-1 mt-2">
                    <p>📅 Start: <span class="text-gray-200">{{ $formation->start_time }}</span></p>
                    <p>⏰ End: <span class="text-gray-200">{{ $formation->end_time }}</span></p>
                </div>
                <!-- Boutons Participant et Attendances en bas -->
                <div class=" flex ml-16 gap-3">
                    <a href="/users">
                        <button wire:key="participant-{{ $formation->id }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition">
                            Participant
                        </button>
                    </a>
                    <a href="{{ route('attendances', $formation->id) }}">
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 transition">
                            Attendances
                        </button>
                    </a>
                    
                    
                </div>
            </div>

            <!-- Boutons Edit & Delete -->
            <div class="absolute top-4 right-4 space-x-3 cursor-pointer z-50 flex">
                <svg wire:click="delete('{{ $formation->id }}')" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-gray-400 hover:text-red-600 transition-colors">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
                <svg wire:click="edit('{{ $formation->id }}')" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-gray-400 hover:text-blue-600 transition-colors">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </div>

            
        </div>
        @endforeach
   
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        {{ $formations->links() }}
    </div>

    <!-- Modal -->
    @if ($showModal)
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center">
        <div class="bg-gray-900 rounded-lg shadow-lg p-8 max-w-md w-full">
            <h2 class="text-xl font-bold mb-4 text-alpha border-b pb-2">
                {{ $updateData ? 'Edit Formation' : 'Add Formation' }}
            </h2>
            <form class="space-y-6" wire:submit="formation" enctype="multipart/form-data">

                <div>
                    <label class="lock text-sm font-medium text-gray-300 ">Class Name :</label>
                    <input type="text" wire:model="class_name" placeholder="Enter Class Name"
                        class="w-full mt-1 border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-alpha focus:outline-none">
                </div>
                <div>
                    <label class="lock text-sm font-medium text-gray-300 ">Formation Name :</label>
                    <select wire:model="formation_name"
                        class="w-full mt-1 border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-alpha focus:outline-none">
                        <option selected disabled value="">Select Formation</option>
                        <option value="Coding">Coding</option>
                        <option value="Media">Media</option>
                    </select>
                </div>
                <div class="flex space-x-4">
                    <div>
                        <label class="lock text-sm font-medium text-gray-300 " for="">start :</label>
                        <input type="date" wire:model="start_time" class="w-full mt-1 border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-alpha focus:outline-none">
                    </div>
                    <div>
                        <label class="lock text-sm font-medium text-gray-300 " for="">End :</label>
                        <input type="date" wire:model="end_time" class="w-full mt-1 border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-alpha focus:outline-none">
                    </div>
                </div>
                <label class="w-full">
                    <span class=" pb-2 ">image :</span>
                    <input type="file" accept="image/*" multiple wire:model="images"  class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:border-none focus:ring-[#fee814] focus:outline-none" >
                    

                </label>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" wire:click="cancel" class="px-4 py-2 bg-gray-700 text-white rounded-lg">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-lg">{{ $updateData ? 'Update' : 'Create' }}</button>
                </div>
            </form>
        </div>
    </div>
    @endif


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.button-next',
                prevEl: '.button-prev',
            },
        });
    </script>
</div>
