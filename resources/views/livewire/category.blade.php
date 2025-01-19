<div>
    <div class="flex justify-center items-center space-x-20">
        <h1 class="dark:text-white m-10 text-3xl font-semibold">Categories</h1>
    </div>

    <div class="flex justify-center items-center space-x-20">
        <div class="grid grid-cols-1 md:grid-cols-3 md:gap-16">
            @foreach ($categories as $category)
            <a href="{{ route('categorized', $category->id) }}">
                <div>
                    <div class="h-[200px] w-[200px] cursor-pointer rounded-full m-2 dark:bg-white bg-yellow-400 overflow-hidden flex justify-center items-center transform transition-transform duration-300 hover:scale-110 hover:shadow-lg">
                        <img class="object-contain" src="{{ asset('storage/' . $category->image_url[0]) }}" alt="">
                    </div>
                    <p class="text-center">{{ $category->category_name }}</p>
                </div>
            </a>
            
        @endforeach
        </div>
    </div>
   
    
</div>
