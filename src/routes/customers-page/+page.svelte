<script lang="ts">
    import { onMount, afterUpdate } from 'svelte'; // Ensure you import onMount and afterUpdate
    import { handleButtonClick } from '../../utils/buttonHandler'; // Import the reusable function
    import { currentInputStore } from '../../stores/currentInputStore'; // Import the store
    let orders: { order_name: string; order_quantity: number; order_size: string; order_price: number; basePrice: number; order_addons: string; order_addons_price: number; order_addons2: string; order_addons_price2: number; order_addons3: string; order_addons_price3: number; order_image?: string }[] = []; // Explicitly define the type
    let amountPaid: number = 0; // Add a reactive variable for amount paid
    let currentInput = '';
    let ordersContainer: HTMLDivElement; // Reference for the orders container

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

    // Calculate total cost reactively, including all relevant prices
    $: totalCost = orders.reduce((sum, order) => {
        const basePrice = Number(order.basePrice) || 0; // Ensure base price is a number
        const quantity = Number(order.order_quantity) || 1; // Ensure quantity is a number
        const addonsTotal = 
            (Number(order.order_addons_price) || 0) + 
            (Number(order.order_addons_price2) || 0) + 
            (Number(order.order_addons_price3) || 0);
        
        // Calculate total for this order including quantity
        const orderTotal = (basePrice * quantity) + addonsTotal; // Multiply base price by quantity and add addons total
        console.log(`Order Total for ${order.order_name}: ₱${orderTotal.toFixed(2)}`); // Log the total for each order

        return sum + orderTotal; // Sum total for all orders
    }, 0); // Ensure all prices are included

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

    // Scroll to the bottom of the orders container after orders are updated
    afterUpdate(() => {
        if (ordersContainer) {
            ordersContainer.scrollTop = ordersContainer.scrollHeight; // Scroll to the bottom
        }
    });
</script>


    <!-- Display fetched orders -->
    <div class="p-4 bg-cyan-950 h-screen flex flex-col">
        
        {#if orders.length > 0}
        <div bind:this={ordersContainer} class="flex flex-col space-y-4 w-full flex-1  border-gray-300 p-4 bg-white rounded-lg shadow-md overflow-auto max-h-[1000px]">
            {#each orders as order}
                <div class="flex items-start justify-between border-b py-2">
                    <div class="flex-1 flex items-center">
                        <img src={`/foods/${order.order_image}`} alt="{order.order_name}" class="w-16 h-16 object-cover mr-4" />
                        <div>
                            <h2 class="text-lg font-semibold">{order.order_name}</h2>
                            <p class="text-gray-600"><strong>Quantity:</strong> {order.order_quantity}</p>
                            <p class="text-gray-600"><strong>Size:</strong> {order.order_size}</p>
                            <p class="text-gray-600"><strong>Addons:</strong></p>
                            <ul class="list-disc pl-5">
                                {#if order.order_addons && order.order_addons !== 'None' && order.order_addons !== '0'}
                                    <li>{order.order_addons}</li>
                                {/if}
                                {#if order.order_addons2 && order.order_addons2 !== 'None' && order.order_addons2 !== '0'}
                                    <li>{order.order_addons2}</li>
                                {/if}
                                {#if order.order_addons3 && order.order_addons3 !== 'None' && order.order_addons3 !== '0'}
                                    <li>{order.order_addons3}</li>
                                {/if}
                            </ul>
                        </div>
                    </div>
                    <div class="text-right pl-4 flex-shrink-0">
                        <p class="text-xl font-bold text-green-600">₱{order.order_price}.00</p>
                        <p class="text-gray-600">₱{order.basePrice}.00</p>
                        <p class="text-gray-600">---------------------------------------------</p>
                        <p class="text-gray-600">---------------------------------------------</p>
                        {#if order.order_addons_price > 0}
                            <p class="text-gray-600">₱{order.order_addons_price}.00</p>
                        {/if}
                        {#if order.order_addons_price2 > 0}
                            <p class="text-gray-600">₱{order.order_addons_price2}.00</p>
                        {/if}
                        {#if order.order_addons_price3 > 0}
                            <p class="text-gray-600">₱{order.order_addons_price3}.00</p>
                        {/if}
                    </div>
                </div>  
            {/each}
        </div>
        <div class="text-right mt-4 bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold">Total Cost: ₱{totalCost.toFixed(2)}</h2>
            <p>Amount Paid: ₱{amountPaid.toFixed(2)}</p>
            <p>Change: ₱{Math.max(0, (amountPaid - totalCost)).toFixed(2)}</p>
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