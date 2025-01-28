<x-app-layout>
    <div class="flex justify-center items-center">
        <div id="plans-container" class="grid mx-32 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-12 gap-y-20 p-4 mb-24">
            <div class="text-center  col-span-full" id="loading">Loading Plans...</div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchPlans();
    });

    function fetchPlans() {
    const container = document.getElementById('plans-container');
    
    axios.get('http://127.0.0.1:8000/api/subscription')
        .then(response => {
            const plans = response.data.data;
            container.innerHTML = '';
            
            if (plans.length === 0) {
                container.innerHTML = '<div class="text-center">No Plans found</div>';
                return;
            }
            
            plans.forEach(plan =>{
                const planElement = `
                    <div class="bg-white cursor-pointer shadow-lg rounded-lg overflow-hidden p-4 w-80">
                    <div class="flex justify-center items-center relative">
                        <img class="w-full h-48 m-4 object-contain" 
                            src="/storage/${plan.image_url}" 
                            alt="${plan.name}"
                            onerror="this.onerror=null; this.src='/images/placeholder.png';">
                    </div>
                    <a href="">  
                        <div class="p-4">
                            <h3 class="text-2xl font-semibold">${plan.name}</h3>
                            <p class="text-gray-600 text-lg">Rs. ${plan.price}</p>
                        </div>
                    </a>   
                    <button 
                            class="mt-2 mb-2 w-full bg-yellow-400 text-white px-6 py-2 rounded-lg hover:bg-green-400 transition-colors">
                            Subscribe
                    </button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', planElement);
        });
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
</script>