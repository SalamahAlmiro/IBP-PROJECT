<div class="mt-3 ml-2 flex justify-start relative" style="position: relative;">
    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Admin Panel 
        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
    </button>
    <div id="dropdown" class="hidden dropdown-content" style="position: absolute; top: 100%; left: 0; margin-top: 0.5rem; background-color: white; border: 1px solid #ccc; border-radius: 0.375rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); min-width: 12rem; z-index: 10;">
        <ul>
            <li>
                <a href="{{ route('admin.table') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Users Table</a>
            </li>
            <li>
                <a href="{{ route('admin.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Posts Table</a>
            </li>
        </ul>
    </div>
</div>
<script>
    document.getElementById('dropdownDefaultButton').addEventListener('click', function() {
        var dropdown = document.getElementById('dropdown');
        if (dropdown.classList.contains('hidden')) {
            dropdown.classList.remove('hidden');
        } else {
            dropdown.classList.add('hidden');
        }
    });
</script>

