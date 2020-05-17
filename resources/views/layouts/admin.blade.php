<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700,800" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vue-toast-notification/dist/theme-default.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mc.css') }}" rel="stylesheet">
    <style>
        .nunito {
            font-family: 'nunito', font-sans;
        }

        .border-b-1 {
            border-bottom-width: 1px;
        }

        .border-l-1 {
            border-left-width: 1px;
        }

        hover\:border-none:hover {
            border-style: none;
        }

        #sidebar {
            transition: ease-in-out all .3s;
            z-index: 9999;
        }

        #sidebar span {
            opacity: 0;
            position: absolute;
            transition: ease-in-out all .1s;
        }

        #sidebar:hover {
            width: 150px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            /*shadow-2xl*/
        }

        #sidebar:hover span {
            opacity: 1;
        }
    </style>

</head>

<body class="flex h-screen bg-gray-100 font-sans">

<!-- Side bar-->
<div id="sidebar" class="h-screen w-16 menu bg-white text-white px-4 flex items-center nunito static fixed shadow">

    <ul class="list-reset ">
        <li class="my-2 md:my-0">
            <a href="{{ route('admin-index') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                <i class="fas fa-home fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Home</span>
            </a>
        </li>
        <li class="my-2 md:my-0 ">
            <a href="{{ route('admin-movie') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                <i class="fas fa-tasks fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Movie</span>
            </a>
        </li>
        <li class="my-2 md:my-0">
            <a href="{{ route('admin-serie') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                <i class="fa fa-envelope fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Serie</span>
            </a>
        </li>
        <li class="my-2 md:my-0">
            <a href="{{ route('admin-genre') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                <i class="fas fa-chart-area fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Genre</span>
            </a>
        </li>
        <li class="my-2 md:my-0">
            <a href="{{ route('admin-cast') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                <i class="fa fa-wallet fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">People</span>
            </a>
        </li>
        <li class="my-2 md:my-0">
            <a href="{{ route('admin-tag') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                <i class="fa fa-wallet fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Tags</span>
            </a>
        </li>
    </ul>

</div>

<div class="flex flex-row flex-wrap flex-1 flex-grow content-start pl-16">

    <div class="h-40 lg:h-20 w-full flex flex-wrap">
        <nav id="header" class="bg-gray-200 w-full lg:max-w-sm flex items-center border-b-1 border-gray-300 order-2 lg:order-1">

            <div class="px-2 w-full">
                <select name="" class="bg-gray-300 border-2 border-gray-200 rounded-full w-full py-3 px-4 text-gray-500 font-bold leading-tight focus:outline-none focus:bg-white focus:shadow-md" id="form-field2">
                    <option value="Default">default</option>
                    <option value="A">report a</option>
                    <option value="B">report b</option>
                    <option value="C">report c</option>
                </select>
            </div>

        </nav>
        <nav id="header1" class="bg-gray-100 w-auto flex-1 border-b-1 border-gray-300 order-1 lg:order-2">

            <div class="flex h-full justify-between items-center">

                <!--Search-->
                <div class="relative w-full max-w-3xl px-6">
                    <div class="absolute h-10 mt-1 left-0 top-0 flex items-center pl-10">
                        <svg class="h-4 w-4 fill-current text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                        </svg>
                    </div>

                    <input id="search-toggle" type="search" placeholder="search" class="block w-full bg-gray-200 focus:outline-none focus:bg-white focus:shadow-md text-gray-700 font-bold rounded-full pl-12 pr-4 py-3" onkeyup="updateSearchResults(this.value);">

                </div>
                <!-- / Search-->

                <!--Menu-->

                <div class="flex relative inline-block pr-6">

                    <div class="relative text-sm">
                        <button id="userButton" class="flex items-center focus:outline-none mr-3">
                            <img class="w-8 h-8 rounded-full mr-4" src="http://i.pravatar.cc/300" alt="Avatar of User"> <span class="hidden md:inline-block">Hi, {{ auth()->user()->name }} </span>
                            <svg class="pl-2 h-2" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                                <g>
                                    <path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z"></path>
                                </g>
                            </svg>
                        </button>
                        <div id="userMenu" class="bg-white nunito rounded shadow-md mt-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible">
                            <ul class="list-reset">
                                <li><a href="#" class="px-4 py-2 block text-gray-900 hover:bg-indigo-400 hover:text-white no-underline hover:no-underline">My account</a></li>
                                <li><a href="#" class="px-4 py-2 block text-gray-900 hover:bg-indigo-400 hover:text-white no-underline hover:no-underline">Notifications</a></li>
                                <li>
                                    <hr class="border-t mx-2 border-gray-400">
                                </li>
                                <li><a class="px-4 py-2 block text-gray-900 hover:bg-indigo-400 hover:text-white no-underline hover:no-underline" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

                <!-- / Menu -->

            </div>

        </nav>
    </div>

    <!--Dash Content -->

    <div id="app" class="py-6 m-2 lg:py-0 w-full flex flex-wrap">
        @yield('content')
    </div>
</div>

<script>

    /*Toggle dropdown list*/
    /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

    var userMenuDiv = document.getElementById("userMenu");
    var userMenu = document.getElementById("userButton");

    document.onclick = check;

    function check(e) {
        var target = (e && e.target) || (event && event.srcElement);

        //User Menu
        if (!checkParent(target, userMenuDiv)) {
            // click NOT on the menu
            if (checkParent(target, userMenu)) {
                // click on the link
                if (userMenuDiv.classList.contains("invisible")) {
                    userMenuDiv.classList.remove("invisible");
                } else {
                    userMenuDiv.classList.add("invisible");
                }
            } else {
                // click both outside link and outside menu, hide menu
                userMenuDiv.classList.add("invisible");
            }
        }

    }

    function checkParent(t, elm) {
        while (t.parentNode) {
            if (t == elm) {
                return true;
            }
            t = t.parentNode;
        }
        return false;
    }
</script>

</body>

</html>
