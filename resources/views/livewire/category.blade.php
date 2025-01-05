<div class="flex justify-center items-center space-x-20">
    <div class="grid grid-cols-1 md:grid-cols-3 md:gap-16">
        @foreach ($categories as $category)
        <a href="{{ route('categorized', $category->id) }}">
            <div>
                <div class="h-[150px] w-[150px] cursor-pointer rounded-full m-2 dark:bg-white bg-yellow-400 overflow-hidden flex justify-center items-center">
                    <img class="object-contain h-full w-full" src="{{ asset('storage/' . $category->image_url[0]) }}" alt="">
                </div>
                <p class="text-center">{{ $category->category_name }}</p>
            </div>
        </a>
        
    @endforeach
    </div>
    
</div>
