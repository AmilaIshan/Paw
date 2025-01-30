<x-app-layout>
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
                    <button class="ml-auto bg-yellow-400 py-2 px-4 w-48 rounded-md hover:bg-yellow-500 buyBtn">Buy Now</button>
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
                    return;
                }

                cartItems.forEach(item =>{
                    TotalCost += item.quantity * item.price;
                    const cartElement = ``;
                    container.insertAdjacentHTML('beforeend', cartElement);
                });

                costContainer.innerHTML = `Rs. ${TotalCost}`;

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

        function createTransaction(item, token) {
            console.log('hekki wirkd');
            console.log(item);
            console.log('hekki wirkd');
            return axios.post('http://127.0.0.1:8000/api/transaction', {
                price: item.price,
                quantity: item.quantity,
                product_id: item.product_id,
            }, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const buyButton = document.querySelector('.buyBtn');
            buyButton.addEventListener('click', async function() {
            const token = "{{ $token }}";
        
            try {
                // Fetch current cart items
                console.log('Fetching cart items...'); // Debug log
                const response = await axios.get('http://127.0.0.1:8000/api/cart', {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
                
                const cartItems = response.data.data;
                
                
                if (cartItems.length === 0) {
                    return;
                }
                
                // Create transactions for each cart item
                const transactionPromises = cartItems.map(item => createTransaction(item, token));
                
                // Wait for all transactions to complete
                await Promise.all(transactionPromises);
                
                // Clear cart items one by one
                const deletePromises = cartItems.map(item => 
                    axios.delete(`http://127.0.0.1:8000/api/cart/${item.id}`, {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json'
                        }
                    })
                );
                
                await Promise.all(deletePromises);

                fetchCartItems();
                
            } catch (error) {
                console.error('Error processing purchase:', error);
                alert(`Failed to process purchase: ${error.message}`);
            }
        });
    });
      

   </script>
</x-app-layout>