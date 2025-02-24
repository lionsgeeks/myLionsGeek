<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>


    <nav class="bg-[#101010] border-b px-9 border-gray-800">
        <div class="max-w-[1600px] mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center pl-5 ">
                    <a href="#" class="flex-shrink-0 hover:opacity-90 transition-opacity">
                        <span class="text-white text-xl font-bold">Lions<span class="text-[#fee814]">Geek</span></span>
                    </a>
                </div>

                <div class="flex pl-10 items-center space-x-8">
                    <a href="#"
                        class="flex items-center space-x-2 px-3 py-2 rounded-md text-sm font-medium text-gray-400 hover:text-white">
                        <i class="fas fa-users w-[18px] h-[13px]"></i>
                        <span>Members</span>
                    </a>

                    <div class="relative flex items-center">
                        <button onclick="toggleDropdown('spacesDropdown')"
                            class="flex items-center justify-center space-x-2 text-gray-400 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-map-pin w-[18px] h-[13px]"></i>
                            <span>Spaces</span>
                            <i class="fas fa-chevron-down w-[16px] h-[12px] transform transition-transform"></i>
                        </button>

                        <div id="spacesDropdown"
                            class="hidden absolute z-10 mt-36 ml-10 w-48 rounded-md shadow-lg bg-gray-900 ring-1 ring-black ring-opacity-5">
                            <div class="py-1" role="menu">
                                <a href="places" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Places</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Reservations</a>
                            </div>
                        </div>
                    </div>

                    <a href="#"
                        class="flex items-center space-x-2 px-3 py-2 rounded-md text-sm font-medium text-gray-400 hover:text-white">
                        <i class="fas fa-calendar w-[18px] h-[13px]"></i>
                        <span>Calendar</span>
                    </a>

                    <div class="relative flex items-center">
                        <button onclick="toggleDropdown('resourcesDropdown')"
                            class="flex items-center space-x-2 text-gray-400 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-desktop w-[18px] h-[13px]"></i>
                            <span>Resources</span>
                            <i class="fas fa-chevron-down w-[16px] h-[12px] transform transition-transform"></i>
                        </button>

                        <div id="resourcesDropdown"
                            class="hidden absolute z-10 mt-36 ml-10 w-48 rounded-md shadow-lg bg-gray-900 ring-1 ring-black ring-opacity-5">
                            <div class="py-1" role="menu">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-desktop w-[16px] h-[16px]"></i>
                                        <span>Computers</span>
                                    </div>
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-tools w-[16px] h-[16px]"></i>
                                        <span>Equipment</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="relative flex items-center">
                        <button onclick="toggleDropdown('learningDropdown')"
                            class="flex items-center space-x-2 text-gray-400 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-graduation-cap w-[18px] h-[13px]"></i>
                            <span>Learning</span>
                            <i class="fas fa-chevron-down w-[16px] h-[12px] transform transition-transform"></i>
                        </button>

                        <div id="learningDropdown"
                            class="hidden absolute z-10 mt-36 ml-10 w-48 rounded-md shadow-lg bg-gray-900 ring-1 ring-black ring-opacity-5">
                            <div class="py-1" role="menu">
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Training</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Attendance</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-4 pr-5">
                    <button class="text-gray-400 hover:text-white p-1">
                        <i class="fas fa-bell w-[18px] h-[18px]"></i>
                    </button>
                    <button class="text-gray-400 hover:text-white p-1">
                        <i class="fas fa-moon w-[18px] h-[18px]"></i>
                    </button>

                    <div class="relative ml-3">
                        <button onclick="toggleDropdown('profileDropdown')"
                            class="flex items-center space-x-3 focus:outline-none">
                            <div class="text-right">
                                <div class="text-white text-sm">khandari Nassima</div>
                                <div class="text-gray-400 text-xs">Moderateur</div>
                            </div>
                            <div class="h-8 w-8 rounded-full bg-gray-300"></div>

                        </button>

                        <div id="profileDropdown"
                            class="hidden absolute z-20 right-0 mt-2 w-48 rounded-md shadow-lg bg-gray-900 ring-1 ring-black ring-opacity-5">
                            <div class="py-1" role="menu">
                                <a href="#"
                                    class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">
                                    <i class="fas fa-cog w-[16px] h-[16px]"></i>
                                    <span>Settings</span>
                                </a>
                                <a href="#"
                                    class="flex items-center space-x-2 px-4 py-2 text-sm text-red-400 hover:bg-gray-700">
                                    <i class="fas fa-sign-out-alt w-[16px] h-[16px]"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('computer.create')" :active="request()->routeIs('computer.create')" wire:navigate>
                        {{ __('Computers') }}
                    </x-nav-link>
                </div>
            </div>
        </div>

        <script>
            lucide.createIcons();

            function toggleDropdown(dropdownId) {
                const dropdown = document.getElementById(dropdownId);
                const allDropdowns = document.querySelectorAll('[id$="Dropdown"]');
                const button = dropdown.previousElementSibling;
                const icon = button.querySelector('[data-lucide="chevron-down"]');

                allDropdowns.forEach(d => {
                    if (d.id !== dropdownId && !d.classList.contains('hidden')) {
                        d.classList.add('hidden');
                        const otherIcon = d.previousElementSibling.querySelector('[data-lucide="chevron-down"]');
                        otherIcon.classList.remove('rotate-180');
                    }
                });

                dropdown.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            }

            document.addEventListener('click', (e) => {
                const dropdowns = document.querySelectorAll('[id$="Dropdown"]');
                dropdowns.forEach(dropdown => {
                    const button = dropdown.previousElementSibling;
                    if (!dropdown.contains(e.target) && !button.contains(e.target)) {
                        dropdown.classList.add('hidden');
                        const icon = button.querySelector('[data-lucide="chevron-down"]');
                        icon.classList.remove('rotate-180');
                    }
                });
            });
        </script>
    </nav>


