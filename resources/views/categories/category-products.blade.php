<x-app-layout>
    <div class="flex justify-center items-center">
        <div id="products-container" class="grid mx-32 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-12 gap-y-20 p-4 mb-24">
            <div class="text-center  col-span-full" id="loading">Loading products...</div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const path = window.location.pathname;
    const categoryId = path.split('/').pop();
    fetchProducts(categoryId);
});

async function fetchProducts(categoryId) {
    const container = document.getElementById('products-container');
    
    try {
        const response = await axios.get(`http://127.0.0.1:8000/api/category/${categoryId}`);
        const products = response.data.data;
        container.innerHTML = '';
        
        if (products.length === 0) {
            container.innerHTML = '<div class="text-center col-span-full">No products found in this category</div>';
            return;
        }

        const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
        
        // Get favorite status for all products if user is authenticated
        const favoriteStatuses = {};
        if (isAuthenticated) {
            try {
                await Promise.all(products.map(async product => {
                    try {
                        const response = await axios.get(`/api/favorites/${product.id}/check`, {
                            headers: {
                                'Authorization': `Bearer ${document.querySelector('meta[name="api-token"]').content}`,
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });
                        favoriteStatuses[product.id] = response.data.liked;
                    } catch (error) {
                        console.error(`Error checking favorite status for product ${product.id}:`, error);
                        console.log(`Bearer ${document.querySelector('meta[name="api-token"]').content}`)
                        favoriteStatuses[product.id] = false;
                    }
                }));
            } catch (error) {
                console.error('Error checking favorite statuses:', error);
            }
        }
        
        products.forEach(product => {
            const isFavorited = favoriteStatuses[product.id] || false;
            const productElement = `
                <div class="bg-white cursor-pointer shadow-lg rounded-lg overflow-hidden p-2">
                    <div class="flex justify-center items-center relative">
                        <img class="w-full h-48 m-4 object-contain" 
                            src="/storage/${product.image_url}" 
                            alt="${product.name}"
                            onerror="this.onerror=null; this.src='/images/placeholder.png';">
                            <button
                                 onclick="event.preventDefault(); toggleFavorite(${product.id}, this)" 
                                 class="absolute top-2 right-2 p-2 bg-white rounded-full shadow-lg favorite-btn" 
                                 data-product-id="${product.id}"
                                 data-liked="${isFavorited}">
                            
                                <svg class="size-8 loading-spinner hidden text-gray-200 animate-spin dark:text-gray-600 fill-red-500" viewBox="0 0 100 101" fill="none">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <svg class="heart-icon size-8" xmlns="http://www.w3.org/2000/svg" fill="${isFavorited ? 'red' : 'none'}" viewBox="0 0 24 24" stroke-width="1" stroke="red">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                            </button>
                    </div>
                    <a href="/products/${product.id}">  
                        <div class="p-4">
                            <h3 class="text-2xl font-semibold">${product.name}</h3>
                            <p class="text-gray-600 text-lg">Rs. ${product.price}</p>
                        </div>
                    </a>   
                    <button 
                            onclick="event.preventDefault(); addToCart(${product.id}, ${product.price})" 
                            class="mt-2 mb-2 w-full bg-yellow-400 text-white px-6 py-2 rounded-lg hover:bg-green-400 transition-colors">
                            Add To Cart
                    </button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', productElement);
        });
    } catch (error) {
        console.error('Error fetching products:', error);
        container.innerHTML = `
            <div class="text-center text-red-500 col-span-full">
                Error loading products. Please try again later.
                <br>
                ${error.message}
            </div>
        `;
    }
}

async function addToCart(productId, price) {
    const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
    
    if (!isAuthenticated) {
        window.location.href = '/login';
        return;
    }

    try {
        const response = await axios.post('/api/cart', {
            product_id: productId,
            price: price,
            quantity: 1,
            user_id: {{ auth()->id() ?? 'null' }}
        }, {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                Authorization: `Bearer ${document.querySelector('meta[name="api-token"]').content}`, 
            },
            withCredentials: true  
        });

        const event = new CustomEvent('add-to-cart', {
            detail: {
                title: 'success',
                message: 'Product added to cart successfully!',
            },
        });
        window.dispatchEvent(event);
    } catch (error) {
        console.log(`Bearer ${document.querySelector('meta[name="api-token"]').content}`);
        console.error('Error adding product to cart:', error);
        
        const event = new CustomEvent('add-to-cart', {
            detail: {
                title: 'error',
                message: error.response?.data?.message || 'Error adding product to cart. Please try again later.',
            },
        });
        window.dispatchEvent(event);
    }
}

async function toggleFavorite(productId, button) {
    const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
    
    if (!isAuthenticated) {
        window.location.href = '/login';
        return;
    }

    
    const heartIcon = button.querySelector('.heart-icon');
    const loadingSpinner = button.querySelector('.loading-spinner');
    
    
    heartIcon.classList.add('hidden');
    loadingSpinner.classList.remove('hidden');
    
    try {
        const response = await axios.post(`/api/favorites/${productId}`, {}, {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Authorization': `Bearer ${document.querySelector('meta[name="api-token"]').content}`
            }
        });

        const isLiked = response.data.liked;
        heartIcon.setAttribute('fill', isLiked ? 'red' : 'none');
        button.setAttribute('data-liked', isLiked);

    } catch (error) {
        console.error('Error toggling favorite:', error);
        const event = new CustomEvent('add-to-cart', {
            detail: {
                title: 'error',
                message: 'Error updating favorite status. Please try again.',
            },
        });
        window.dispatchEvent(event);
    } finally {
        // Hide loading state
        loadingSpinner.classList.add('hidden');
        heartIcon.classList.remove('hidden');
    }
}
</script>