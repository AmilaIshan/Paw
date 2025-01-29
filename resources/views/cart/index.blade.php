<x-app-layout>
    @guest
        <div class="flex items-center justify-center">
        
            <div class="flex flex-col justify-center items-center">
                <div class="text-2xl m-4">
                    <h2>Login or Register to view the cart</h2>
                </div>
                <div class="flex space-x-4">
                    <a class=" space-x-2 p-2 w-48 text-center  bg-yellow-300 px-6 rounded-sm hover:text-orange-700 text-sm text-gray-500"
                    href="http://127.0.0.1:8000/login">
                    Login
                    </a>
                    <a class="space-x-2 w-48 p-2 text-center bg-yellow-300 px-6 rounded-sm hover:text-orange-700 text-sm text-gray-500"
                        href="http://127.0.0.1:8000/register">
                        Register
                    </a>
                </div>
            </div>    
        </div>
    @endguest
        <div class="mx-auto max-w-[1200px] min-h-[600px] bg-white rounded-lg shadow-lg p-6 m-10">
            <div class="flex items-center justify-between h-full">
                <div class="w-full max-w-[1200px]" id="container">

                </div>
            </div>
        </div>


   

   <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            fetchCartItems();
        });

        function fetchCartItems(){
            const container = document.getElementById('container');
            const token = "{{ $token }}";

            axios.get('http://127.0.0.1:8000/api/cart', {
                headers: {
                    'Authorization' :  `Bearer ${token}`,
                    'Accept' : 'application/json'
                }
            })
            .then(response => {
                const cartItems = response.data.data;
                container.innerHTML = '';

                if(cartItems.length == 0){
                    container.innerHTML = '<div class="text-center">No items in the cart</div>';
                    return;
                }

                cartItems.forEach(item =>{
                    const cartElement = `
                    <div class="max-w-[1200px] h-[180px] bg-white rounded-lg shadow-lg p-6 m-10">
                        <div class="flex justify-between items-center">
                            <div class="m-4">
                                 <img class="w-full h-32 m-4 object-contain" src="/storage/${item.image_url}" alt="">
                            </div>
                            <div class="w-[400px]">
                                <p>${item.product_name}</p>
                            </div>
                            <div>
                                <p>Rs. ${item.price}</p>
                            </div>
                            <div class="flex">
                                 <button class="p-2 decrease-btn" data-product-id="${item.product_id}" type="button">-</button>
                                    <p class="p-2" id="quantity">${item.quantity}</p>
                                <button class="p-2 increase-btn" data-product-id="${item.product_id}"  type="button">+</button>

                            </div>
                            <div>
                                <button type="button" class="bg-red-400 p-2 rounded-md remove-btn" item-id="${item.id}">Remove Item</button>
                            </div>
                        </div>
                    </div>`;
                    container.insertAdjacentHTML('beforeend', cartElement);
                });

                document.querySelectorAll('.increase-btn').forEach(button => {
                    button.addEventListener('click', function(event) {
                        const quantityElement = event.target.previousElementSibling ;
                        const productId = this.getAttribute('data-product-id');
                        let quantity = parseInt(quantityElement.innerText);
                        quantity += 1;
                        quantityElement.innerText = quantity;

                        updateCartQuantity(productId, quantity, token, quantityElement);
                    });
                });

                

                document.querySelectorAll('.decrease-btn').forEach(button => {
                    button.addEventListener('click', function(event) {
                    const quantityElement = event.target.nextElementSibling;
                    const productId = this.getAttribute('data-product-id');
                    let quantity = parseInt(quantityElement.innerText);
                    if (quantity > 1) {
                        quantity -= 1;
                        quantityElement.innerText = quantity;
                        updateCartQuantity(productId, quantity, token, quantityElement);
                    }
                    });
                });

                document.querySelectorAll('.remove-btn').forEach(button => {
                    button.addEventListener('click', function(event){
                        const itemId = this.getAttribute('item-id');
                        removeItem(itemId, token);
                    });
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

        function updateCartQuantity(productId, quantity, token, quantityElement) {
            axios.put(`http://127.0.0.1:8000/api/cart/${productId}`, 
                { quantity: quantity },
                {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                }
            )
            .then(response => {
            // Update the display only after successful API call
            quantityElement.innerText = quantity;
            })
            .catch(error => {
                console.error('Error updating quantity:', error);
                alert('Failed to update quantity. Please try again.');
            });
        }

        function removeItem(itemId, token){
            axios.delete(`http://127.0.0.1:8000/api/cart/${itemId}`,
                {
                    headers:{
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                }
            )
            .then(response =>{
                console.log('item removed');
                fetchCartItems();
            })
            .catch(error => {
                console.error('Error updating quantity:', error);
                alert('Failed to update quantity. Please try again.');
            });
        }
        

   </script>
</x-app-layout>