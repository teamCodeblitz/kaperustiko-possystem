<script lang="ts">
    import 'svelte-routing';
    // Change to default import
    import Card from '../components/card.svelte';
    import Sidebar from '../sidebar/+page.svelte';

    let orderNumber = "#01";
    let totalCost = "₱00.00";
    let selectedCategory = "Food"; // Default category is "Food"
    let payment = ''; // Payment input variable
    let quantity = 0; // Add a quantity variable

    const cardData = [
        { code: '001', title1: 'Pizza', title2: 'Pepperoni', price: '₱250.00' , image: './foods/pizza.jpg' },
        { code: '002', title1: 'Burger', title2: 'Cheese', price: '₱150.00' , image: './foods/burger.jpg' },
        { code: '003', title1: 'Pasta', title2: 'Carbonara', price: '₱180.00' , image: './foods/pasta.jpg' },
        { code: '004', title1: 'Salad', title2: 'Caesar', price: '₱120.00' , image: './foods/salad.jpg' },
        { code: '005', title1: 'Steak', title2: 'Ribeye', price: '₱500.00' , image: './foods/steak.jpg' },
        { code: '006', title1: 'Sushi', title2: 'Nigiri', price: '₱300.00' , image: './foods/sushi.jpg' },
        { code: '007', title1: 'Sandwich', title2: 'Ham & Cheese', price: '₱90.00' , image: './foods/sandwich.jpg' },
        { code: '008', title1: 'Fries', title2: 'Large', price: '₱70.00' , image: './foods/fries.jpg' },
        { code: '009', title1: 'Ice Cream', title2: 'Vanilla', price: '₱50.00' , image: './foods/icecream.jpg' },
        { code: '010', title1: 'Coffee', title2: 'Latte', price: '₱100.00' , image: './foods/coffee.jpg' },
        { code: '011', title1: 'Tea', title2: 'Green', price: '₱80.00' , image: './foods/tea.jpg' },
        { code: '012', title1: 'Juice', title2: 'Orange', price: '₱60.00' , image: './foods/juice.jpg' },
    ];

    // Payment handling functions
    function handleNumberInput(num: string) { // Specify num as a string
    payment += num;
}

    function handleBackspace() {
        payment = payment.slice(0, -1);
    }

    function handleClear() {
        payment = '';
    }

    function handleEnter() {
        alert(`Payment submitted: ₱${payment}`);
        payment = ''; // Clear payment after submission
    }

    function increaseQuantity() {
        quantity += 1; // Increment the quantity
    }

    function decreaseQuantity() {
        if (quantity > 0) {
            quantity -= 1; // Decrement the quantity, ensuring it doesn't go below 0
        }
    }

    // New function to handle adding a card
    function handleAddCard(event: CustomEvent) { // Specify event as CustomEvent
        const { code, title } = event.detail;
        // Set quantity to 1 when adding the card
        quantity = 1; // You can also manage multiple cards if needed
    }
</script>

<div class="flex h-screen">
    <Sidebar />
    <div class="flex-grow overflow-hidden flex bg-gray-100">
        
        <!-- Main Dashboard Content -->
        <div class="flex-grow overflow-auto p-4">
            <!-- Filter Bar Menu -->
            <div class="flex space-x-4 mb-4">
                <!-- Category Buttons -->
                {#each ['All', 'Beverages', 'Food', 'Desserts', 'Coffee', 'Tea', 'Juice', 'Sandwich', 'Sushi', 'Pasta', 'Burger'] as category}
                    <button 
                        class="px-6 py-2 rounded-md text-black font-bold"
                        class:bg-cyan-950={selectedCategory === category}
                        class:text-white={selectedCategory === category}
                        class:bg-white={selectedCategory !== category}
                        class:shadow-md={selectedCategory !== category}
                        on:click={() => selectedCategory = category}>
                        {category}
                    </button>
                {/each}
            </div>

            <!-- Content Based on Selected Category -->
            <div class="text-black font-bold ml-1 mb-4">
                {#if selectedCategory === 'All'}
                    <p>Display All Menu</p>
                {:else if selectedCategory === 'Beverages'}
                    <p>Display Beverages Menu</p>
                {:else if selectedCategory === 'Food'}
                    <p>Display Food Menu</p>
                {:else if selectedCategory === 'Desserts'}
                    <p>Display Desserts Menu</p>
                {:else if selectedCategory === 'Coffee'}
                    <p>Display Coffee Menu</p>
                {:else if selectedCategory === 'Tea'}
                    <p>Display Tea Menu</p>
                {:else if selectedCategory === 'Juice'}
                    <p>Display Juice Menu</p>
                {:else if selectedCategory === 'Sandwich'}
                    <p>Display Sandwich Menu</p>
                {:else if selectedCategory === 'Sushi'}
                    <p>Display Sushi Menu</p>
                {:else if selectedCategory === 'Pasta'}
                    <p>Display Pasta Menu</p>
                {:else if selectedCategory === 'Burger'}
                    <p>Display Burger Menu</p>
                {/if}
            </div>

            <!-- Card Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-6 flex-start">
                {#each cardData as { code, title1, title2, price, image }}
                    <Card {code} {title1} {title2} {price} {image} on:add={handleAddCard} />
                {/each}
            </div>
        </div>
    </div>

    <!-- Right Side: Order Panel -->
    <div class="w-64">
        <div class="flex flex-col items-center bg-gray-100 h-full p-4 w-72 shadow-lg fixed right-0 top-0">
            <!-- Order Number Section -->
            <div class="bg-green-800 text-white w-full text-center py-2 rounded-md mb-4">
                <p class="text-sm font-bold">Order Number {orderNumber}</p>
            </div>
            
            <!-- Order Items Section -->
            <div class="space-y-2 w-full mb-4 flex-grow">
                {#if quantity > 0} <!-- Only render if quantity is greater than 0 -->
                <div class="bg-white p-3 rounded-md shadow-md flex items-center justify-between">
                    <p class="text-gray-800 font-semibold">003</p>
                    <p class="text-gray-800 font-semibold">Pasta</p>
                    <div class="flex items-center">
                        <button class="bg-red-500 text-white font-bold py-1 px-2 rounded" on:click={decreaseQuantity}>-</button>
                        <input 
                            type="number" 
                            class="w-14 text-gray-800 font-semibold text-center appearance-none" 
                            bind:value={quantity} 
                            style="border: none; outline: none;" 
                            min="0"
                        />
                        <button class="bg-green-500 -ml-4 text-white font-bold py-1 px-2 rounded" on:click={increaseQuantity}>+</button>
                    </div>
                </div>
                {/if}
            </div>

            <!-- Bottom Section -->
            <div class="w-full mt-auto">
                <!-- Total Cost and Change Section -->
                <div class="flex items-center justify-between w-full mb-4">
                    <p class="text-gray-700 font-semibold">Total Cost:</p>
                    <p class="text-gray-800 font-bold">{totalCost}</p>
                </div>
                <div class="flex items-center justify-between w-full">
                    <p class="text-gray-700 font-semibold">Change:</p>
                    <p class="text-gray-800 font-bold">₱00.00</p> <!-- Replace with dynamic change variable if needed -->
                </div>

                <!-- Payment Input Section -->
                <div class="mb-4">
                    <p class="block text-sm font-bold">Payment:</p>
                    <input
                        type="text"
                        class="w-full py-2 px-4 border rounded bg-gray-100 text-right font-mono text-xl"
                        bind:value={payment}
                        readonly
                    />
                </div>

                <!-- Buttons Section -->
                <div class="grid grid-cols-4 gap-2 w-full mb-4">
                    <!-- Dine In and Take Out Buttons -->
                    <button class="bg-gray-300 text-gray-800 font-bold py-2 rounded col-span-2">Dine In</button>
                    <button class="bg-gray-300 text-gray-800 font-bold py-2 rounded col-span-2">Take Out</button>
                
                    <!-- Number Buttons -->
                    {#each ['7', '8', '9', '⌫', '4', '5', '6', 'Clr', '1', '2', '3', 'Enter', '0', '00', 'Place Order'] as key}                       
                        <button on:click={() => {
                            if (key === '⌫') handleBackspace();
                            else if (key === 'Clr') handleClear();
                            else if (key === 'Enter') handleEnter();
                            else if (key !== 'Place Order') handleNumberInput(key);
                        }}
                        class="bg-gray-200 text-gray-800 font-bold py-2 rounded col-span-{key === 'Place Order' ? '2' : '1'} {key === 'Clr' ? 'bg-red-900 text-white' : ''}">
                            {key}
                        </button>
                    {/each}
                </div>
            </div>
        </div>
    </div>
</div>

