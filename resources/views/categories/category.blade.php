<div>
    <div class="flex justify-center items-center space-x-20">
        <h1 class="dark:text-white m-10 text-3xl font-semibold">Categories</h1>
    </div>
    
    <div class="flex justify-center items-center space-x-20">
        <div id="categories-container" class="grid grid-cols-1 md:grid-cols-3 md:gap-16">
            <div class="text-center" id="loading">Loading categories...</div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    fetchCategories();
});

function fetchCategories() {
    const container = document.getElementById('categories-container');
    
    axios.get('http://127.0.0.1:8000/api/category') 
        .then(response => {
            const categories = response.data.data;
            container.innerHTML = '';
            
            if (categories.length === 0) {
                container.innerHTML = '<div class="text-center">No categories found</div>';
                return;
            }
            
            categories.forEach(category => {
                const categoryElement = `
                    <a href="/category/${category.id}">
                        <div>
                            <div class="h-[200px] w-[200px] cursor-pointer rounded-full m-2 dark:bg-white bg-yellow-400 overflow-hidden flex justify-center items-center transform transition-transform duration-300 hover:scale-110 hover:shadow-lg">
                                <img class="object-contain" src="http://127.0.0.1:8000/storage/${category.image_url}" alt="${category.name}" 
                                    onerror="this.onerror=null; this.src='/images/placeholder.png';">
                            </div>
                            <p class="text-center dark:text-white">${category.name}</p>
                        </div>
                    </a>
                `;
                container.insertAdjacentHTML('beforeend', categoryElement);
            });
        })
        .catch(error => {
            console.error('Error fetching categories:', error);
            container.innerHTML = `
                <div class="text-center text-red-500">
                    Error loading categories. Please try again later.
                    <br>
                    ${error.message}
                </div>
            `;
        });
}
</script>