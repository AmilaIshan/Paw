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
    @auth
    
    <div class="mx-auto max-w-[1200px] min-h-[600px] bg-white rounded-lg shadow-lg p-6 m-10">
        <div class="flex items-center justify-between h-full">
            <div class="w-full max-w-[1200px]" id="container">

            </div>
        </div>
        <div>
            <div class="max-w-[1200px] h-[150px] bg-white rounded-lg p-6 m-10 mt-auto">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-2xl">Total Cost</p>
                    </div>
                    <div>
                        <p id="totalCost">Rs. 0</p>
                    </div>
                </div>
                <div class="flex mt-12">
                    <a href="{{ route('checkout') }}" class="ml-auto bg-yellow-400 py-2 text-center px-4 w-48 rounded-md hover:bg-yellow-500">Checkout</a>
                </div>
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
            const costContainer = document.getElementById('totalCost');
            const token = "{{ $token }}";
            let TotalCost = 0;

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
                    TotalCost += item.quantity * item.price;
                    const cartElement = `
                    <div class="max-w-[1200px] h-[180px] bg-white rounded-lg shadow-lg p-6 m-10">
                        <div class="flex justify-between items-center cartItems">
                            <div class="m-4">
                                 <img class="w-full h-32 m-4 object-contain" src="/storage/${item.image_url}" alt="">
                            </div>
                            <div class="w-[400px]">
                                <p>${item.product_name}</p>
                            </div>
                            <div class="m-4 p-2">
                                <p class="item-price">Rs. ${item.price}</p>
                            </div>
                            
                            <div class="flex m-4 p-2">
                                 <button class="p-2 decrease-btn" data-product-id="${item.product_id}" type="button">-</button>
                                    <p class="p-2 quantity" >${item.quantity}</p>
                                <button class="p-2 increase-btn" data-product-id="${item.product_id}"  type="button">+</button>

                            </div>
                            <div>
                                <button type="button" class="bg-red-400 flex p-2 rounded-md remove-btn" item-id="${item.id}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                               <p class="ml-2"> Remove Item</p>
                                </button>
                            </div>
                        </div>
                    </div>`;
                    container.insertAdjacentHTML('beforeend', cartElement);
                });

                costContainer.innerHTML = `Rs. ${TotalCost}`;


                document.querySelectorAll('.increase-btn').forEach(button => {
                    button.addEventListener('click', function(event) {
                        const quantityElement = event.target.previousElementSibling ;
                        const productId = this.getAttribute('data-product-id');
                        let quantity = parseInt(quantityElement.innerText);
                        quantity += 1;
                        quantityElement.innerText = quantity;
                        updateTotalCost();
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
                        updateTotalCost();
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
            quantityElement.innerText = quantity;
            })
            .catch(error => {
                console.error('Error updating quantity:', error);
                alert('Failed to update quantity. Please try again.');
            });
        }

        function updateTotalCost(){
            const costContainer = document.getElementById('totalCost'); 
            let updatedTotal = 0;
            const cartItems = document.querySelectorAll('.cartItems');

            cartItems.forEach(item => {
               const priceText = item.querySelector('.item-price').textContent.replace('Rs. ', '');
               const price = parseInt(priceText);
               const quantity = parseInt(item.querySelector('.quantity').textContent);
               updatedTotal += price * quantity;
            });

            costContainer.innerHTML = `Rs. ${updatedTotal}`;
        }

        // function removeItem(itemId, token){
        //     axios.delete(`http://127.0.0.1:8000/api/cart/${itemId}`,
        //         {
        //             headers:{
        //                 'Authorization': `Bearer ${token}`,
        //                 'Accept': 'application/json'
        //             }
        //         }
        //     )
        //     .then(response =>{
        //         console.log('item removed');
        //         fetchCartItems();
        //     })
        //     .catch(error => {
        //         console.error('Error updating quantity:', error);
        //         alert('Failed to update quantity. Please try again.');
        //     });
        // }
        function removeItem(itemId, token) {
    Swal.fire({
        icon: 'warning',
        iconColor: '#ff2424',
        title: 'Are you sure?',
        text: 'Do you want to remove this item from the cart?',
        showCancelButton: true,
        confirmButtonText: 'Remove',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#ffd022',
        cancelButtonColor: '#aaa',
    }).then((result) => {
        if (result.isConfirmed) {
            // Proceed with item removal
            axios.delete(`http://127.0.0.1:8000/api/cart/${itemId}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                console.log('Item removed');
                Swal.fire({
                    icon: 'success',
                    title: 'Removed!',
                    text: 'The item has been removed from your cart.',
                    confirmButtonColor: '#ffd022',
                });
                fetchCartItems();
            })
            .catch(error => {
                console.error('Error removing item:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Failed!',
                    text: 'Could not remove the item. Try again later.',
                    confirmButtonColor: '#ff2424',
                });
            });
        }
    });
}


   </script>
   @endauth
</x-app-layout>