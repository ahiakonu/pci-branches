<nav :class="{
    'ltr:left-64 ltr:-right-64 md:ltr:left-0 md:ltr:right-0 rtl:right-64 rtl:-left-64 md:rtl:right-0 md:rtl:left-0': open,
    'ltr:left-0 ltr:right-0 md:ltr:left-64 rtl:right-0 rtl:left-0 md:rtl:right-64': !(open)
}"
    class="z-50 fixed flex flex-row flex-nowrap items-center justify-between mt-0 py-2 
    ltr:left-0 md:ltr:left-64 ltr:right-0 rtl:right-0 md:rtl:right-64 rtl:left-0 px-6
     bg-white dark:bg-gray-800 shadow-sm transition-all duration-500 ease-in-out"
    id="desktop-menu">
    <!-- sidenav button-->
    <x-app-layout._nav-sidemenu-button />

    <!-- Search -->


    <!-- menu -->
    <ul class="flex ltr:ml-auto rtl:mr-auto mt-2 mt-0">

        

        <!-- notification -->
        {{-- <li x-data="{ open: false }" class="relative">
            <a href="javascript:;" class="block py-3 px-4 flex text-sm rounded-full focus:outline-none" id="notify"
                @click="open = ! open">
                <div class="relative inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6 bi bi-bell"
                        viewBox="0 0 16 16">
                        <path
                            d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                    </svg>
                    <!-- <i class="text-2xl fas fa-bell"></i> -->
                    <span
                        class="flex justify-center absolute -top-2 ltr:-right-1 rtl:-left-1 text-center bg-pink-500 px-1 text-white rounded-full text-xs"><span
                            class="align-self-center">1</span></span>
                </div>
            </a>

            <div x-show="open" @click.away="open = false" x-transition:enter="transition-all duration-200 ease-out"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition-all duration-200 ease-in"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="w-72 origin-top-right absolute ltr:right-0 rtl:left-0 rounded top-full z-50 py-0.5 ltr:text-left rtl:text-right bg-white dark:bg-gray-800 border dark:border-gray-700 shadow-md"
                style="display: none;">
                <div class="p-3 font-normal border-b border-gray-200 dark:border-gray-700">
                    <div class="relative">
                        <div class="font-bold">Notifications</div>
                        <div class="absolute top-0 ltr:right-0 rtl:left-0">
                            <a href="#" class="inline-block ltr:mr-2 rtl:ml-2" title="Clear all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="inline-block w-4 h-4 bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd"
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg>
                                <!-- <i class="fas fa-trash-alt"></i> -->
                            </a>
                        </div>
                    </div>
                </div>
                <div class="max-h-60 overflow-y-auto scrollbars show">
                    <a class="relative" href="#">
                        <div
                            class="flex flex-wrap flex-row items-center border-b border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:bg-opacity-40 dark:hover:bg-opacity-20 py-2 hover:bg-gray-100 bg-gray-50">
                            <div class="flex-shrink max-w-full px-2 w-1/4 text-center">
                                <div class="flex justify-center mx-auto w-8 h-8 rounded-full bg-indigo-500 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        class="self-center w-4 h-4 bi bi-calendar4-event" viewBox="0 0 16 16">
                                        <path
                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1H2zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V5z" />
                                        <path
                                            d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                    </svg>
                                    <!-- <i class="self-center fas fa-calendar"></i> -->
                                </div>
                            </div>
                            <div class="flex-shrink max-w-full px-2 w-3/4">
                                <div class="text-sm font-bold">Event will coming</div>
                                <div class="text-gray-500 text-sm mt-1">Meeting with Mr.John Navas at:10.00Am</div>
                                <div class="text-gray-500 text-sm mt-1">1h ago</div>
                            </div>
                        </div>
                    </a>
                    <a class="relative" href="#">
                        <div
                            class="flex flex-wrap flex-row items-center border-b border-gray-200 dark:border-gray-700 dark:hover:bg-gray-900 dark:hover:bg-opacity-20 py-2 hover:bg-gray-100">
                            <div class="flex-shrink max-w-full px-2 w-1/4 text-center">
                                <div class="flex justify-center mx-auto w-8 h-8 rounded-full bg-indigo-500 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="self-center w-4 h-4 bi bi-hand-thumbs-up"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" />
                                    </svg>
                                    <!-- <i class="self-center fas fa-thumbs-up"></i> -->
                                </div>
                            </div>
                            <div class="flex-shrink max-w-full px-2 w-3/4">
                                <div class="text-gray-500 text-sm mt-1"><b
                                        class="text-gray-600 dark:text-gray-400">Daniel</b> like your post: <b
                                        class="text-gray-600 dark:text-gray-400">Hello World!</b></div>
                                <div class="text-gray-500 text-sm mt-1">3h ago</div>
                            </div>
                        </div>
                    </a>
                    <a class="relative" href="#">
                        <div
                            class="flex flex-wrap flex-row items-center border-b border-gray-200 dark:border-gray-700 dark:hover:bg-gray-900 dark:hover:bg-opacity-20 py-2 hover:bg-gray-100">
                            <div class="flex-shrink max-w-full px-2 w-1/4 text-center">
                                <div class="flex justify-center mx-auto w-8 h-8 rounded-full bg-indigo-500 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        class="self-center w-4 h-4 bi bi-hdd-stack" viewBox="0 0 16 16">
                                        <path
                                            d="M14 10a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1h12zM2 9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2z" />
                                        <path
                                            d="M5 11.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM14 3a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12zM2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z" />
                                        <path
                                            d="M5 4.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                                    </svg>
                                    <!-- <i class="self-center fas fa-server"></i> -->
                                </div>
                            </div>
                            <div class="flex-shrink max-w-full px-2 w-3/4">
                                <div class="text-sm font-bold">Server maintenance</div>
                                <div class="text-gray-500 text-sm mt-1">Server maintenance at:07.00Am</div>
                                <div class="text-gray-500 text-sm mt-1">8h ago</div>
                            </div>
                        </div>
                    </a>
                    <a class="relative" href="#">
                        <div
                            class="flex flex-wrap flex-row items-center border-b border-gray-200 dark:border-gray-700 dark:hover:bg-gray-900 dark:hover:bg-opacity-20 py-2 hover:bg-gray-100">
                            <div class="flex-shrink max-w-full px-2 w-1/4 text-center">
                                <div class="flex justify-center mx-auto w-8 h-8 rounded-full bg-indigo-500 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="self-center w-4 h-4 bi bi-chat-left"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                    </svg>
                                    <!-- <i class="self-center fas fa-comment"></i> -->
                                </div>
                            </div>
                            <div class="flex-shrink max-w-full px-2 w-3/4">
                                <div class="text-gray-500 text-sm mt-1"><b
                                        class="text-gray-600 dark:text-gray-400">Carlos</b> comment in your post: <b
                                        class="text-gray-600 dark:text-gray-400">Hello World!</b></div>
                                <div class="text-gray-500 text-sm mt-1">1d ago</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="p-3 text-center font-normal">
                    <a href="#" class="hover:underline">Show all Notifications</a>
                </div>
            </div>
        </li> --}}

       
        <!-- profile -->
        <li x-data="{ open: false }" class="relative">
            {{--  <a href="javascript:;" class="px-3 flex text-sm rounded-full focus:outline-none" id="user-menu-button"
                @click="open = ! open">
                <div class="relative">
                    <img class="h-10 w-10 rounded-full border border-gray-700 bg-gray-700"
                        src="/src/img/avatar/avatar.png" alt="avatar">
                    <span title="online"
                        class="flex justify-center absolute -bottom-0.5 ltr:right-1 rtl:left-1 text-center bg-green-500 border border-white w-3 h-3 rounded-full"></span>
                </div>
                <span class="hidden md:block ltr:ml-1 rtl:mr-1 self-center">{{ Auth::user()->username }}</span>
            </a> --}}
            <a href="javascript:;" class="px-3 flex text-sm rounded-full focus:outline-none" id="user-menu-button"
                @click="open = ! open">
                <div class="relative">
                    <img class="h-10 w-10 rounded-full border border-gray-700 bg-gray-700"
                        src="{{ asset('tdash/src/img/pci_logo.png') }}" alt="avatar">
                    <span title="online"
                        class="flex justify-center absolute -bottom-0.5 ltr:right-1 rtl:left-1 text-center bg-green-500 border border-white w-3 h-3 rounded-full"></span>
                </div>
                <span class="hidden md:block ltr:ml-1 rtl:mr-1 self-center">{{ Auth::user()->name }}</span>
            </a>
            <ul x-show="open" @click.away="open = false" x-transition:enter="transition-all duration-200 ease-out"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition-all duration-200 ease-in"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="origin-top-right absolute ltr:right-0 rtl:left-0 rounded top-full z-50 py-0.5 ltr:text-left rtl:text-right bg-white dark:bg-gray-800 border dark:border-gray-700 shadow-md"
                style="min-width:12rem;display: none;">
                <li class="relative">
                    <div class="flex flex-wrap flex-row -mx-4 px-3 py-4 items-center">
                        <div class="flex-shrink max-w-full px-4 w-1/3">
                            <img src="{{ asset('tdash/src/img/pci_logo.png') }}" class="h-10 w-10 rounded-full"
                                alt="{{ Auth::user()->username }}">
                        </div>
                        <div class="flex-shrink max-w-full px-4 w-2/3 ltr:pl-1 rtl:pr-1">
                            <div class="font-bold"><a href="#"
                                    class=" text-gray-800 dark:text-gray-300 hover:text-indigo-500">{{ Auth::user()->name }}</a>
                            </div>
                            <div class="text-gray text-sm mt-1">
                                <?= ucwords(strtolower(str_replace('_', ' ', Auth::user()->user_role))) ?>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="relative">
                    <hr class="border-t border-gray-200 dark:border-gray-700 my-0">
                </li>

                <li class="relative">
                    <a class="block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-indigo-500"
                        href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            class="inline ltr:mr-2 rtl:ml-2 w-4 h-4 bi bi-question-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                        </svg>
                        <!-- <i class="mr-2 fas fa-question-circle"></i> --> Help &amp; Support
                    </a>
                </li>

                <li class="relative">
                    <hr class="border-t border-gray-200 dark:border-gray-700 my-0">
                </li>
                <li class="relative">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-indigo-500"
                            href="route('logout')" onclick="event.preventDefault();  this.closest('form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="inline ltr:mr-2 rtl:ml-2 w-4 h-4 bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                                <path fill-rule="evenodd"
                                    d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                            </svg>
                            <i class="mr-2 fas fa-sign-out-alt"></i> Sign out
                        </a>
                    </form>
                </li>
                <li class="relative">
                    <hr class="border-t border-gray-200 dark:border-gray-700 my-0">
                </li>
                <li class="relative">
                    <div class="flex flex-row w-full px-4 ">
                        <div
                            class="relative inline-block w-8 py-3 mt-0.5 ltr:mr-3 rtl:ml-3 align-middle select-none transition duration-200 ease-in">
                            <input type="checkbox" name="lightdark" id="lightdark"
                                class="toggle-checkbox absolute block w-5 h-5 rounded-full bg-white dark:bg-gray-900 border-2 dark:border-gray-700 appearance-none cursor-pointer">
                            <label for="lightdark"
                                class="toggle-label block overflow-hidden h-5 rounded-full bg-gray-300 dark:bg-gray-700 cursor-pointer"></label>
                        </div>
                        <p class=" text-gray-500 self-center hover:text-indigo-500">Light and Dark</p>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</nav>
