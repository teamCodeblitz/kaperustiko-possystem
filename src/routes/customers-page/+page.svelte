<script lang="ts">
    import { onMount } from 'svelte'; // Ensure you import onMount
    import { handleButtonClick } from '../../utils/buttonHandler'; // Import the reusable function
    import { currentInputStore } from '../../stores/currentInputStore'; // Import the store
    let orders: { order_name: string; order_quantity: number; order_size: string; order_price: number; order_addons: string; order_addons_price: number; order_image?: string }[] = []; // Explicitly define the type
    let amountPaid: number = 0; // Add a reactive variable for amount paid
    let currentInput = '';

    // Subscribe to the store
    currentInputStore.subscribe(store => {
        currentInput = store.currentInput;
        amountPaid = store.amountPaid;
    });

    // Fetch orders from the PHP endpoint
    async function fetchOrders() {
        const response = await fetch('http://localhost/kaperustiko-possystem/backend/get_order.php'); // Update the path as necessary
        if (response.ok) {
            const data = await response.json();
            orders = data && Array.isArray(data) ? data : []; // Check if data is an array
        } else {
            console.error('Failed to fetch orders:', response.statusText);
        }
    }

    // Call fetchOrders when the component mounts and set up polling
    onMount(() => {
        fetchOrders();
        const interval = setInterval(fetchOrders, 1000); // Fetch orders every 1 second
        return () => clearInterval(interval); // Clear interval on component unmount
    });

    // Calculate total cost reactively
    $: totalCost = orders.reduce((sum, order) => sum + Number(order.order_price), 0); // Ensure order_price is treated as a number

    // Function to update amount paid from local storage
    function updateAmountPaidFromStorage() {
        const storedValue = localStorage.getItem('payment') || '0';
        amountPaid = parseFloat(storedValue.replace('₱', '').replace(',', '')) || 0; // Convert to number
    }

    // Call updateAmountPaidFromStorage when the component mounts
    onMount(() => {
        updateAmountPaidFromStorage(); // Initialize amountPaid from local storage
        const interval = setInterval(() => {
            updateAmountPaidFromStorage(); // Update amountPaid every second
        }, 1000); // Adjust the interval as needed
        return () => clearInterval(interval); // Clear interval on component unmount
    });

    // Example of how you might call updateAmountPaid when a button is clicked
    // This should be connected to your button click event in the main POS
    // updateAmountPaid(8); // Call this function with the value you want to add
</script>


    <!-- Display fetched orders -->
    <div class="p-4 bg-cyan-950 h-screen flex flex-col">
        
        {#if orders.length > 0}
        <div class="flex flex-col space-y-4 w-full flex-1  border-gray-300 p-4 bg-white rounded-lg shadow-md">
            {#each orders as order}
                <div class="flex items-center justify-between border-b">
                    {#if order.order_image}
                        <img src={order.order_image} alt={order.order_name} class="w-16 h-16 object-cover rounded-md mr-4" />
                    {/if}
                    <div class="flex-1">
                        <h2 class="text-lg font-semibold">{order.order_name}</h2>
                        <p class="text-gray-600"><strong>Quantity:</strong> {order.order_quantity}</p>
                        <p class="text-gray-600"><strong>Size:</strong> {order.order_size}</p>
                        <p class="text-gray-600"><strong>Addons:</strong> {order.order_addons || 'None'}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-bold">₱{order.order_price}</p>
                    </div>
                </div>
            {/each}
        </div>
        <div class="text-right mt-4 bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold">Total Cost: ₱{totalCost.toString().replace(/^0+/, '')}</h2>
            <p>Amount Paid: ₱{amountPaid.toFixed(2)}</p>
            <p>Change: ₱{(amountPaid - totalCost).toFixed(2)}</p>
        </div>
        {:else}
            <div class="bg-cyan-950 h-screen w-full flex flex-col items-center justify-center">
                <ul class="circles">
                    <li class="animate-pulse"></li>
                    <li class="animate-pulse"></li>
                    <li class="animate-pulse"></li>
                    <li class="animate-pulse"></li>
                    <li class="animate-pulse"></li>
                    <li class="animate-pulse"></li>
                    <li class="animate-pulse"></li>
                    <li class="animate-pulse"></li>
                    <li class="animate-pulse"></li>
                    <li class="animate-pulse"></li>
                </ul>
                <div class="flex items-center justify-center w-full h-full">
                    <img src="./icon.png" alt="Fallback description if image fails to load" class="max-w-full h-auto" aria-hidden="true" />
                </div>
            </div>
        {/if}
       
    </div>