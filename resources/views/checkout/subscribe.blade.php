<x-app-layout>

    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="grid grid-cols-2 gap-8 max-w-5xl bg-white shadow-lg rounded-lg p-8">
            
            <div id="details" class="p-6 border-r space-y-4">
                
            </div>

            <!-- Payment Section -->
            <div class="flex justify-center items-center m-4">
                <div class="w-full max-w-lg bg-gray-50 shadow-md rounded-lg border p-6 space-y-4 m-4">
                    <h2 class="text-xl font-semibold text-gray-700 py-4">Invoice Payment</h2>
                    <form class="flex flex-col space-y-4">
                        <div class="mb-4">
                            <label class="text-gray-700">Card Number</label>
                            <input type="text" class="border rounded py-3 px-4 w-full" placeholder="1234 5678 9012 3456"/>
                        </div>

                        <div class="mb-4">
                            <label class="text-gray-700">Expiration Date</label>
                            <input type="text" class="border rounded py-3 px-4 w-full" placeholder="MM/YY"/>
                        </div>

                        <div class="mb-4">
                            <label class="text-gray-700">CVV</label>
                            <input type="text" class="border rounded py-3 px-4 w-full" placeholder="123"/>
                        </div>

                        <button onclick="event.preventDefault(); subscribe({{ $planId }})"
                         class="bg-yellow-500 text-white font-semibold py-3 px-6 rounded mt-3 w-full">
                            Pay now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchPlans();
        });

        function fetchPlans() {
            const container = document.getElementById('details');
            
            axios.get('http://127.0.0.1:8000/api/subscriptionplan/{{ $planId }}')
                .then(response => {
                    const plans = response.data.data;
                    container.innerHTML = `
                        <div class="flex flex-col items-center">
                            <img class="w-60 h-60 object-contain" 
                                src="/storage/${plans.image_url}" 
                                alt="${plans.name}"
                                onerror="this.onerror=null; this.src='/images/placeholder.png';"
                            >
                        </div>
                        <div class="text-center mt-4">
                            <h3 class="text-2xl font-semibold">${plans.name}</h3>
                            <p class="text-gray-600 text-xl">Rs. ${plans.price}</p>
                        </div>
                    `;
                })
                .catch(error => {
                    console.error('Error fetching plans:', error);
                    container.innerHTML = `
                        <div class="text-center text-red-500">
                            Error loading plans. Please try again later.
                            <br>
                            ${error.message}
                        </div>
                    `;
                });
        }
    async function subscribe(planId) {
        const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
        
        if (!isAuthenticated) {
            window.location.href = '/login';
            return;
        }

        try {
            const response = await axios.post('/api/subscription', {
                plan_id: planId,
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
            console.log(`Bearer ${document.querySelector('meta[name="api-token"]').content}`);
            console.error('Error subscribing:', error);
        }
}
    </script>
</x-app-layout>
