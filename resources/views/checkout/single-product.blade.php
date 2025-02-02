<x-app-layout>
    <h1>{{ $productId }}</h1>
    <div class="mx-auto max-w-[1200px] min-h-[600px] bg-white rounded-lg shadow-lg p-6 m-10">
        <div class="flex items-center justify-between h-full">
            <div class="w-full max-w-[1200px]" id="container">

            </div>
        </div>
        <div>
            <div class="max-w-[1200px] h-[150px] bg-white rounded-lg p-6 m-10 mt-auto">
                <div class="flex mt-12">
                    <button class="ml-auto bg-yellow-400 py-2 px-4 w-48 rounded-md hover:bg-yellow-500 buyBtn">Buy</button>
                </div>
            </div>  
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    let product = {};

    document.addEventListener('DOMContentLoaded', function() {
        fetchDetails();
    
        document.querySelector('.buyBtn').addEventListener('click', async function() {

            try {
                const response = await createTransaction(product);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    iconColor: '#35ff11',
                    title: 'Order was successful',
                    showConfirmButton: false,
                    timer: 3500
                }).then(() => {
                    window.location.href = '/';
                });
            } catch (error) {
                console.error('Transaction Failed:', error);
                alert('Transaction Failed! Check console for details.');
            }
        });
    });

    function fetchDetails() {
        axios.get(`http://127.0.0.1:8000/api/products/{{ $productId }}`)
            .then(response => {
                product = response.data;
            })
            .catch(error => {
                console.error('Error fetching product:', error);
                document.getElementById('container').innerHTML = `
                    <div class="text-center text-red-500">
                        Error loading product details. Please try again later.
                        <br>
                        ${error.message}
                    </div>
                `;
            });
    }

    function createTransaction(product) {
        return axios.post('http://127.0.0.1:8000/api/transaction', {
            price: product.data.price,
            quantity: product.data.quantity, 
            product_id: product.data.id
        }, {
            headers: {
                'Authorization': `Bearer ${document.querySelector('meta[name="api-token"]').content}`,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
    }
</script>

</x-app-layout>