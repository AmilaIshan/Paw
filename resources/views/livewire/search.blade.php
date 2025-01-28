<div id="search-bar" class="relative">
    <form class="d-flex" role="search">
        <input wire:model.live.debounce.500ms="search" type="search" placeholder="Search" class="m-2 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-300">
    </form>
        
        @if(sizeof($users) > 0)
            <div
                id="dropdown-menu"
                class=" absolute top-full left-0 w-full mt-1 bg-white border hover:bg-yellow-300 border-gray-200 rounded-md shadow-lg z-50 cursor-pointer"
                >
                <div class="p-3 hover:bg-yellow-200">
                    @foreach($users as $user)
                        <div class="flex flex-col ">
                            <span>{{ $user->name }}</span>
                            <span>{{ $user->email }}</span>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        @endif
        
</div>