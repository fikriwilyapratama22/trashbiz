<header class="flex items-center w-full h-20 bg-primary shadow-lg fixed">
    <div class="flex items-center flex-grow">
        <button id="hamburgerButton" class="ml-5 mr-2">
            <span class="material-icons text-white text-2xl">menu</span>
        </button>
    </div>
    <div class="ml-auto flex items-center mr-10 relative">
        <button id="adminButton" class="flex items-center">
            <img src="{{ asset('img/profile.jpg') }}" alt="Profile" class="rounded-full w-12 h-12 border" />
            <span class="ml-2 text-white font-bold">{{ Auth::user()->nama }}</span>
        </button>
        <div id="adminDropdown" class="absolute right-0 mt-44 w-48 bg-white rounded-md shadow-lg py-2 hidden">
            <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2 text-gray-900 hover:text-white hover:bg-primary font-bold">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
</header>
