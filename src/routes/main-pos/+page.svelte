<script lang="ts">
    import 'svelte-routing';
    // Change to default import
    import Card from '../components/card.svelte';
    import Sidebar from '../sidebar/+page.svelte';

    let orderNumber = "#01";
    let totalCost = "₱00.00";
    let selectedCategory = "Food"; // Default category is "Food"
    let payment = ''; // Payment input variable

    const cardData = [
        { code: '001', title1: 'Pizza', title2: 'Pepperoni', price: '₱250.00' },
        { code: '002', title1: 'Burger', title2: 'Cheese', price: '₱150.00' },
        { code: '003', title1: 'Pasta', title2: 'Carbonara', price: '₱180.00' },
        { code: '004', title1: 'Salad', title2: 'Caesar', price: '₱120.00' },
        { code: '005', title1: 'Steak', title2: 'Ribeye', price: '₱500.00' },
        { code: '006', title1: 'Sushi', title2: 'Nigiri', price: '₱300.00' },
        { code: '007', title1: 'Sandwich', title2: 'Ham & Cheese', price: '₱90.00' },
        { code: '008', title1: 'Fries', title2: 'Large', price: '₱70.00' },
        { code: '009', title1: 'Ice Cream', title2: 'Vanilla', price: '₱50.00' },
        { code: '010', title1: 'Coffee', title2: 'Latte', price: '₱100.00' },
        { code: '011', title1: 'Tea', title2: 'Green', price: '₱80.00' },
        { code: '012', title1: 'Juice', title2: 'Orange', price: '₱60.00' },
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
</script>

<div class="flex h-screen">
    <!-- Left Side: Sidebar and Main Content -->
    <div class="flex-grow overflow-hidden flex bg-gray-100">
        <Sidebar />
        <!-- Main Dashboard Content -->
        <div class="flex-grow overflow-auto p-4">
            <!-- Filter Bar Menu -->
            <div class="flex space-x-4 mb-4 ml-16">
                <!-- Category Buttons -->
                {#each ['All', 'Beverages', 'Food', 'Desserts', 'richard'] as category}
                    <button 
                        class="px-6 py-2 rounded-full text-black font-bold"
                        class:bg-stone-950={selectedCategory === category}
                        class:text-white={selectedCategory === category}
                        class:bg-gray-300={selectedCategory !== category}
                        on:click={() => selectedCategory = category}>
                        {category}
                    </button>
                {/each}
            </div>

            <!-- Content Based on Selected Category -->
            <div class="mt-12 ml-16 text-black font-bold">
                {#if selectedCategory === 'All'}
                    <p>Display All Menu</p>
                {:else if selectedCategory === 'Beverages'}
                    <p>Display Beverages Menu</p>
                {:else if selectedCategory === 'Food'}
                    <p>Display Food Menu</p>
                {:else if selectedCategory === 'Desserts'}
                    <p>Display Desserts Menu</p>
                {:else if selectedCategory === 'richard'}
                    <p>Display richard Menu</p>
                {/if}
            </div>

            <!-- Card Grid -->
            <div class="grid grid-cols-3 gap-2 mt-6">
                {#each cardData as { code, title1, title2, price }}
                    <Card {code} {title1} {price} />
                {/each}
            </div>
        </div>
    </div>

    <!-- Right Side: Order Panel -->
    <div class="w-64">
        <div class="flex flex-col items-center bg-gray-100 h-full p-4 w-64 shadow-lg fixed right-0 top-0">
            <!-- Order Number Section -->
            <div class="bg-green-800 text-white w-full text-center py-2 rounded-md mb-4">
                <p class="text-sm font-bold">Order Number {orderNumber}</p>
            </div>
            
            <!-- Order Items Section -->
            <div class="space-y-2 w-full mb-4 flex-grow">
                <div class="bg-white p-3 rounded-md shadow-md">
                    <p class="text-gray-800 font-semibold">₱00.00</p>
                </div>
                <div class="bg-white p-3 rounded-md shadow-md">
                    <p class="text-gray-800 font-semibold">####</p>
                    <p class="text-gray-800">₱00.00</p>
                </div>
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
                    {#each ['7', '8', '9', '⌫', '4', '5', '6', 'Del', '1', '2', '3', 'Enter', '0', '00', 'Place Order'] as key}                       
                        <button on:click={() => {
                            if (key === '⌫') handleBackspace();
                            else if (key === 'Del') handleClear();
                            else if (key === 'Enter') handleEnter();
                            else if (key !== 'Place Order') handleNumberInput(key);
                        }}
                        class="bg-gray-200 text-gray-800 font-bold py-2 rounded col-span-{key === 'Place Order' ? '2' : '1'}">
                            {key}
                        </button>
                    {/each}
                </div>
            </div>
        </div>
    </div>
</div>

