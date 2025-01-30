<x-app-layout>
    <div class="flex justify-center items-center">
        <div id="products-container" class="grid mx-32 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-12 gap-y-20 p-4 mb-24">
            <div class="text-center  col-span-full" id="loading">Loading products...</div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchFavoriteProducts();
        });

        console.log('hello');

        async function fetchFavoriteProducts() {
            const container = document.getElementById('products-container');
            container.innerHTML = '<div class="text-center col-span-full">Loading favorite products...</div>';

            const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
            if (!isAuthenticated) {
                container.innerHTML = '<div class="text-center col-span-full text-red-500">Please <a href="/login" class="underline">log in</a> to view your favorite products.</div>';
                return;
            }

            try {
                // Step 1: Get favorite product IDs
                const favoriteResponse = await axios.get(`/api/favorite`, {
                    headers: {
                        'Authorization': `Bearer ${document.querySelector('meta[name="api-token"]').content}`,
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const favoriteProducts = favoriteResponse.data; // Array of { product_id, user_id, id }
                if (favoriteProducts.length === 0) {
                    container.innerHTML = '<div class="text-center col-span-full">No favorite products found</div>';
                    return;
                }

                // Step 2: Fetch product details for each favorite product ID
                const productPromises = favoriteProducts.map(fav =>
                    axios.get(`/api/products/${fav.product_id}`, {
                        headers: { 'Accept': 'application/json' }
                    }).then(response => response.data)
                    .catch(error => {
                        console.error(`Error fetching product ${fav.product_id}:`, error);
                        return null;
                    })
                );

                const products = await Promise.all(productPromises);
                console.log(products);
                const validProducts = products.filter(product => product !== null); // Remove failed requests

                container.innerHTML = ''; // Clear the loading text

                if (validProducts.length === 0) {
                    container.innerHTML = '<div class="text-center col-span-full">No favorite products found</div>';
                    return;
                }

                validProducts.forEach(product => {
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
                                        data-liked="true">
                                        <svg class="heart-icon size-8" xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1" stroke="red">
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
                console.error('Error fetching favorite products:', error);
                container.innerHTML = `
                    <div class="text-center text-red-500 col-span-full">
                        Error loading favorite products. Please try again later.
                        <br>
                        ${error.message}
                    </div>
                `;
            }
        }
        </script>

</x-app-layout>

