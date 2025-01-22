<x-app-layout>
    <div class="flex justify-center items-center">
        <div id="products-container" class="grid mx-32 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-12 gap-y-20 p-4 mb-24">
            <!-- Products will be displayed here -->
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            axios.get('http://127.0.0.1:8000/api/category/1')
                .then(function(response) {
                    const products = response.data.data.products;
                    const container = document.getElementById('products-container');
                    
                    const productsHTML = products.map(product => `
                        <div class="bg-white cursor-pointer shadow-lg rounded-lg overflow-hidden">
                            <div class="flex justify-center items-center relative">
                                <img class="w-full h-48 m-4 object-contain" 
                                     src="/storage/${product.image_url}" 
                                     alt="${product.name}">
                                <!-- Placeholder for livewire favorite component -->
                               
                            </div>
                            <a href="/products/${product.id}">  
                                <div class="p-4">
                                    <h3 class="text-2xl font-semibold">${product.name}</h3>
                                    <p class="text-gray-600 text-lg">Rs. ${product.price}</p>
                                    <p class="text-gray-700 mt-2">${product.description}</p>
                                    <button class="mt-4 w-full bg-yellow-400 text-white px-4 py-2 rounded-lg">Add to Cart</button>
                                </div>
                            </a>   
                        </div>
                    `).join('');
                    
                    container.innerHTML = productsHTML;
                })
                .catch(function(error) {
                    console.error('Error fetching products:', error);
                    document.getElementById('products-container').innerHTML = `
                        <div class="col-span-full text-center text-red-500">
                            Error loading products. Please try again later.
                        </div>
                    `;
                });
        });
    </script>
    @endpush
</x-app-layout>