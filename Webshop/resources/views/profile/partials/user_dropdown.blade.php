<!-- resources/views/layouts/partials/user_dropdown.blade.php -->

<ul class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg">
    <li><a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profilom</a></li>
    <li><a href="{{ route('logout') }}" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Kijelentkezés</a></li>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</ul>
