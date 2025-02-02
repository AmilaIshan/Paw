<div id="search-bar" class="relative">
    <form class="d-flex" role="search">
        <input wire:model.live.debounce.100ms="search" type="search" placeholder="Search" class="m-2 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-300">
    </form>
        
        @if(sizeof($products) > 0)
            <div
                id="dropdown-menu"
                class=" absolute top-full left-0 w-full mt-1 bg-white border hover:bg-yellow-300 border-gray-200 rounded-md shadow-lg z-50 cursor-pointer"
                >
                <div class="p-3 hover:bg-yellow-200">
                    @foreach($products as $product)
                    <a href="http://127.0.0.1:8000/products/{{ $product->id }}">
                        <div class="flex items-center gap-3 p-2 hover:bg-yellow-200 rounded-md">
                            
                            <img src="{{ asset('storage/' . $product->image_url[0]) }}" 
                                alt="{{ $product->product_name }}" 
                                class="w-10 h-10 object-cover rounded-md"
                                onerror="this.onerror=null; this.src='/images/placeholder.png';">
                            
                            <span class="text-sm font-semibold">{{ $product->product_name }}</span>
                        </div>
                    </a>
                    
                    <hr>
                    @endforeach
                </div>
            </div>
        @endif
        
</div>