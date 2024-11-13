<script lang="ts">
    import 'svelte-routing';
    // Change to default import
    import Card from '../components/card.svelte';
    import Sidebar from '../sidebar/+page.svelte';

    let orderNumber = "#01";
    let totalCost = "₱00.00";
    let selectedCategory = "All"; // Default category is now "All"
    let payment = ''; // Payment input variable
    let quantity = 1; // Change default quantity to 1

    const cardData = [
        { menu_no: '001', code: '001', title1: 'Pizza', title2: 'Pepperoni', price1: '₱250.00', price2: '₱500.00', price3: '₱1000.00', image: './foods/pizza.jpg', label: 'Food' },
        { menu_no: '002', code: '002', title1: 'Burger', title2: 'Cheese', price1: '₱150.00', price2: '₱300.00', price3: '₱600.00', image: './foods/burger.jpg', label: 'Food' },
        { menu_no: '003', code: '003', title1: 'Pasta', title2: 'Carbonara', price1: '₱180.00', price2: '₱360.00', price3: '₱540.00', image: './foods/pasta.jpg', label: 'Food' },
        { menu_no: '004', code: '004', title1: 'Salad', title2: 'Caesar', price1: '₱120.00', price2: '₱240.00', price3: '₱360.00', image: './foods/salad.jpg', label: 'Food' },
        { menu_no: '005', code: '005', title1: 'Steak', title2: 'Ribeye', price1: '₱500.00', price2: '₱1000.00', price3: '₱1500.00', image: './foods/steak.jpg', label: 'Food' },
        { menu_no: '006', code: '006', title1: 'Sushi', title2: 'Nigiri', price1: '₱300.00', price2: '₱600.00', price3: '₱900.00', image: './foods/sushi.jpg', label: 'Food' },
        { menu_no: '007', code: '007', title1: 'Sandwich', title2: 'Ham & Cheese', price1: '₱90.00', price2: '₱180.00', price3: '₱270.00', image: './foods/sandwich.jpg', label: 'Food' },
        { menu_no: '008', code: '008', title1: 'Fries', title2: 'Large', price1: '₱70.00', price2: '₱140.00', price3: '₱210.00', image: './foods/fries.jpg', label: 'Food' },
        { menu_no: '009', code: '009', title1: 'Ice Cream', title2: 'Vanilla', price1: '₱50.00', price2: '₱100.00', price3: '₱150.00', image: './foods/icecream.jpg', label: 'Dessert' },
        { menu_no: '010', code: '010', title1: 'Coffee', title2: 'Latte', price1: '₱100.00', price2: '₱200.00', price3: '₱300.00', image: './foods/coffee.jpg', label: 'Beverage' },
        { menu_no: '011', code: '011', title1: 'Tea', title2: 'Green', price1: '₱80.00', price2: '₱160.00', price3: '₱240.00', image: './foods/tea.jpg', label: 'Beverage' },
        { menu_no: '012', code: '012', title1: 'Juice', title2: 'Orange', price1: '₱60.00', price2: '₱60.00', price3: '₱60.00', image: './foods/juice.jpg', label: 'Beverage' },
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

    // Add a new variable to control the popup visibility
    let isPopupVisible = false;
    let isVariationVisible = false;

    // Function to handle placing an order and showing the popup
    function handlePlaceOrder() {
        isPopupVisible = true; // Show the popup
    }

    // Function to close the popup
    function closePopup() {
        isPopupVisible = false; // Hide the popup
        isVariationVisible = false; // Hide the popup
    }

    // Function to print the receipt
    function printReceipt() {
        window.print(); // Trigger the print dialog
    }

    // Define a type for the selected item to avoid 'never' type error
    type MenuItem = { menu_no: string; code: string; title1: string; title2: string; price1: string; price2: string; price3: string; image: string; label: string; };

    let selectedItem: MenuItem | null = null; // Updated type definition

    // Check if selectedItem is not null before accessing its properties
    let displayedPrice = selectedItem ? (selectedItem as MenuItem).price1 : ''; // Cast to MenuItem

    // Add new variables for size and add-ons
    let selectedSize = ''; // Variable to store selected size
    let selectedAddons: string[] = []; // Array to store selected add-ons

    // Function to handle adding an item with size and add-ons
    function handleAdd(item: MenuItem) {
        selectedItem = item; // Set the selected item
        displayedPrice = item.price1; // Default to the regular price
        console.log('Displayed Price:', displayedPrice); // Log the displayed price
        console.log('Price2:', item.price2); // Log price2
        console.log('Price3:', item.price3); // Log price3
        isVariationVisible = true; // Show the popup
    }

    // Function to handle size selection and update displayed price
    function selectSize(size: string) {
        selectedSize = size; // Set the selected size
        if (selectedItem) { // Check if selectedItem is not null
            if (size === 'Regular') {
                displayedPrice = selectedItem.price1; // Show price for Regular
            } else if (size === 'Large') {
                displayedPrice = selectedItem.price2; // Show price for Large
            } else if (size === 'Family') {
                displayedPrice = selectedItem.price3; // Show price for Family
            }
        }
    }
</script>

<div class="flex h-screen">
    <Sidebar />
    <div class="flex-grow overflow-hidden flex bg-gray-100">
        
        <!-- Main Dashboard Content -->
        <div class="flex-start overflow-auto p-4 w-full">
            <!-- Filter Bar Menu -->
            <div class="flex space-x-4 mb-4 ">
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
            <div class="text-black font-bold mb-4">
                {#if selectedCategory === 'All'}
                    <p>Display All Menu</p>
                {:else if selectedCategory === 'Beverages'}
                    <p>Display Beverages Menu</p>
                {:else if selectedCategory === 'Food'}
                    <p>Display Food Menu</p>
                {:else if selectedCategory === 'Desserts'}
                    <p>Display Desserts Menu</p>
                {/if}
            </div>

            <!-- Card Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6">
                {#each cardData.filter(item => 
                    selectedCategory === 'All' || 
                    (selectedCategory === 'Beverages' && item.label === 'Beverage') || 
                    (selectedCategory === 'Food' && item.label === 'Food') ||
                    (selectedCategory === 'Desserts' && item.label === 'Dessert')
                ) as { code, title1, title2, price1, price2, price3, image, menu_no }}
                    <Card {code} {title1} {title2} {price1} {price2} {price3} {image} {menu_no} onAdd={handleAdd} />
                {/each}
            </div>
        </div>
    </div>

    <!-- Right Side: Order Panel -->
    <div class="w-[380px]">
        <div class="flex flex-col items-center bg-gray-100 h-full p-4 w-[350px] shadow-lg fixed right-0 top-0">
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
                    <p class="text-gray-800 font-bold">₱00.00</p> 
                </div>

                <!-- Payment Input Section -->
                <div class="mb-4">
                    <p class="block text-sm font-bold">Payment:</p>
                    <input
                        type="text"
                        class="w-full py-2 px-4 border-none rounded bg-gray-200 text-right font-mono text-xl"
                        bind:value={payment}
                        readonly
                    />
                </div>

                <!-- Buttons Section -->
                <div class="grid grid-cols-4 gap-2 w-full h-[400px]">
                    <!-- Dine In and Take Out Buttons -->
                    <button class="bg-gray-300 text-gray-800 font-bold py-2 rounded col-span-2">Dine In</button>
                    <button class="bg-gray-300 text-gray-800 font-bold py-2 rounded col-span-2">Take Out</button>
                
                    <!-- Number Buttons -->
                    {#each ['7', '8', '9', '⌫', '4', '5', '6', 'Clr', '1', '2', '3', 'Enter', '0', '00', 'Place Order'] as key}                       
                        <button on:click={() => {
                            if (key === '⌫') handleBackspace();
                            else if (key === 'Clr') handleClear();
                            else if (key === 'Enter') handleEnter();
                            else if (key === 'Place Order') handlePlaceOrder(); // Call the new function
                            else handleNumberInput(key);
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

<!-- Popup component -->
{#if isPopupVisible}
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-8 rounded-lg shadow-lg"> <!-- Increased padding for larger touch targets -->
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="icon.png" alt="Restaurant Logo" class="h-24" /> <!-- Increased logo size for better visibility -->
            </div>
            <!-- Restaurant Details -->
            <h2 class="text-2xl font-bold text-center">Kape Rustiko Restaurant</h2> <!-- Increased font size -->
            <p class="text-center text-lg">Dewey Ave, Subic Bay Freeport Zone</p> <!-- Increased font size for better readability -->
            <p class="text-center text-lg">Contact: (047) 998-0000</p> <!-- Increased font size for better readability -->
            
            <!-- BIR Requirements -->
            <p class="text-center text-lg">TIN: 123-456-789</p> <!-- Increased font size for better readability -->
            <p class="text-center text-lg">Address: Dewey Ave, SBFZ</p> <!-- Increased font size for better readability -->

            <h2 class="text-2xl text-center font-bold mt-4 mb-4">Sales Preview</h2> <!-- Increased font size -->
            <p class="text-lg">Receipt Number: {orderNumber}</p> <!-- Increased font size for better readability -->
            <p class="text-lg">Date and Time: {new Date().toLocaleString()}</p> <!-- Increased font size for better readability -->
            <p class="text-lg">Cashier Name: Mike</p> <!-- Increased font size for better readability -->
            <div class="flex justify-between">
                <h2 class="text-lg font-bold mt-4">Items Ordered:</h2><span class="text-lg font-bold mt-4">Items Price</span>
            </div>
            <ul class="flex justify-between">
                <li class="text-lg">Pasta x {quantity}</li><span class="text-lg">₱00.00</span><!-- Update this line to reflect actual items if needed -->
            </ul>
            <div class="flex justify-between">
                <p class="text-lg font-bold mt-4">Total Amount</p><span class="text-lg font-bold mt-4">₱00.00</span>
            </div>
            <div class="flex justify-between">
                <p class="text-lg">Amount Paid:</p><span class="text-lg">₱00.00</span>
            </div>
            <div class="flex justify-between">
                <p class="text-lg">Change:</p><span class="text-lg">₱00.00</span>
            </div>
            <h2 class="text-2xl text-center font-bold mt-4">Thank You for Dining with Us!</h2> <!-- Increased font size -->
            <div class="flex justify-between mt-4">
                <button on:click={closePopup} class="bg-red-500 text-white py-3 px-6 rounded w-full mr-1">Cancel Order</button> <!-- Increased padding for larger touch targets -->
                <button on:click={printReceipt} class="bg-blue-500 text-white py-3 px-6 rounded w-full ml-1">Print Receipt</button> <!-- Increased padding for larger touch targets -->
            </div>
        </div>
    </div>
{/if}

<!-- Popup for variations, quantity, size, and add-ons -->
{#if isVariationVisible}
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full"> <!-- Increased padding for larger touch targets -->
            <h2 class="text-2xl font-bold text-center mb-6">Add {selectedItem?.title1}</h2> <!-- Increased font size -->
            <p class="text-lg text-center mb-6">Price: {displayedPrice}</p> <!-- Show the updated price -->
            
            <!-- Product Image -->
            {#if selectedItem?.image}
                <img src={selectedItem.image} alt={selectedItem.title1} class="w-full h-[400px] mb-4 rounded" /> <!-- Added product image -->
            {/if}

            <!-- Size Selection -->
            <label for="size" class="block text-sm font-medium mb-2">Size:</label> <!-- Increased margin for better spacing -->
            <div class="flex space-x-4 mb-6 w-full"> <!-- Added flex container for horizontal layout -->
                <button on:click={() => selectSize('Regular')} class="flex-1 p-3 border border-gray-300 rounded-md {selectedSize === 'Regular' ? 'bg-blue-500 text-white' : ''}">Regular</button>
                <button on:click={() => selectSize('Large')} class="flex-1 p-3 border border-gray-300 rounded-md {selectedSize === 'Large' ? 'bg-blue-500 text-white' : ''}">Large</button>
                <button on:click={() => selectSize('Family')} class="flex-1 p-3 border border-gray-300 rounded-md {selectedSize === 'Family' ? 'bg-blue-500 text-white' : ''}">Family</button>
            </div>

            <!-- Add-ons Selection -->
            <label for="addons" class="block text-sm font-medium mb-2">Add-ons:</label> <!-- Increased margin for better spacing -->
            <div class="mb-6"> <!-- Increased margin for better spacing -->
                {#if selectedItem?.label === 'Beverage'}
                    <label class="block mb-4"> <!-- Increased margin for better spacing -->
                        <input type="checkbox" bind:group={selectedAddons} value="Extra Shot" class="mr-2 h-6 w-6" /> Extra Shot
                    </label>
                {:else}
                    <label class="block mb-4"> <!-- Increased margin for better spacing -->
                        <input type="checkbox" bind:group={selectedAddons} value="Extra Cheese" class="mr-2 h-6 w-6" /> Extra Cheese
                    </label>
                    <label class="block mb-4"> <!-- Increased margin for better spacing -->
                        <input type="checkbox" bind:group={selectedAddons} value="Bacon" class="mr-2 h-6 w-6" /> Bacon
                    </label>
                    <label class="block mb-4"> <!-- Increased margin for better spacing -->
                        <input type="checkbox" bind:group={selectedAddons} value="Olives" class="mr-2 h-6 w-6" /> Olives
                    </label>
                {/if}
            </div>

            <label for="quantity" class="block text-sm font-medium mb-2">Quantity:</label> <!-- Increased margin for better spacing -->
            <div class="flex justify-between mb-6"> <!-- Added flex container for button layout -->
                <button on:click={decreaseQuantity} class="flex-1 p-3 border border-gray-300 rounded-md">-</button>
                <input type="number" id="quantity" bind:value={quantity} min="1" class="block w-full p-3 border border-gray-300 rounded-md mx-2 text-center" readonly /> <!-- Centered input -->
                <button on:click={increaseQuantity} class="flex-1 p-3 border border-gray-300 rounded-md">+</button>
            </div>

            <div class="flex justify-between">
                <button on:click={closePopup} class="bg-red-500 text-white py-3 px-6 rounded-md hover:bg-red-600 transition">Cancel</button> <!-- Increased padding for larger touch targets -->
                <button on:click={() => {
                    if (quantity > 0 && selectedSize) { // Check if quantity is greater than 0 and size is selected
                        // Handle adding item logic here
                        closePopup(); // Close the popup after adding
                    } else {
                        alert('Please select a quantity greater than 0 and a size.'); // Alert if quantity is 0 or size is not selected
                    }
                }} class="bg-blue-500 text-white py-3 px-6 rounded-md hover:bg-blue-600 transition">Add to Order</button> <!-- Increased padding for larger touch targets -->
            </div>
        </div>
    </div>
{/if}

