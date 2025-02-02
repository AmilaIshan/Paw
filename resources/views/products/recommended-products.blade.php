<div>
    <div class="flex justify-center items-center space-x-20">
        <h1 class="m-4 mt-32 ml-5 text-3xl font-bold mb-24 dark:text-gray-200">Recommend Products</h1>
    </div>
    
    <div class="flex justify-center items-center space-x-20">
        <div class="grid mx-32 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-12 gap-y-20 p-4 mb-24" id="container">
            
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    fetchProducts();
});

function fetchProducts() {
    const container = document.getElementById('container');
    
    axios.get('http://127.0.0.1:8000/api/products') 
        .then(response => {
            const products = response.data.data;
            container.innerHTML = '';
            
            if (products.length === 0) {
                container.innerHTML = '<div class="text-center">No Products found</div>';
                return;
            }
            
            products.forEach(product => {
                const productElement = `
                   <div class="bg-white dark:bg-zinc-800 cursor-pointer shadow-lg rounded-lg overflow-hidden p-2">
                        <div class="flex justify-center items-center relative">
                            <img class="w-full h-48 m-4 object-contain" 
                                src="/storage/${product.image_url}" 
                                alt="${product.name}"
                                onerror="this.onerror=null; this.src='/images/placeholder.png';"
                            >
                        </div>
                        <a href="/products/${product.id}">  
                                <div class="p-4">
                                    <h3 class="text-2xl font-semibold dark:text-gray-200">${product.name}</h3>
                                    <p class="text-gray-600 text-lg dark:text-gray-300">Rs. ${product.price}</p>
                                </div>
                        </a>   
                        <button 
                                onclick="event.preventDefault(); addToCart(${product.id}, ${product.price})" 
                                class="mt-2 mb-2 w-full bg-yellow-400 text-white px-6 py-2 rounded-lg hover:bg-green-400 transition-colors dark:text-gray-800">
                                Add To Cart
                        </button>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', productElement);
            });
        })
        .catch(error => {
            console.error('Error fetching products:', error);
            container.innerHTML = `
                <div class="text-center text-red-500">
                    Error loading products. Please try again later.
                    <br>
                    ${error.message}
                </div>
            `;
        });
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
</script>