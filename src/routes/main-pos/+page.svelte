<script lang="ts">
	import 'svelte-routing';
	// Change to default import
	import Card from '../components/card.svelte';
	import Sidebar from '../sidebar/+page.svelte';

	let orderNumber = '#01';
	let totalCost = '₱00.00';
	let selectedCategory = 'All'; // Default category is now "All"
	let payment = ''; // Payment input variable
	let quantity = 1; // Change default quantity to 1
	let isPopupVisible = false;
	let isVariationVisible = false;
	let selectedItem: MenuItem | null = null; // Updated type definition
	let selectedItemDetails: { title: string; price: string; size: string; quantity: number; addons: string[] } | null = null; // New variable to store selected item details
	let orderedItems: { title: string; price: string; size: string; quantity: number; addons: string[] }[] = []; // New array to store ordered items

	// Check if selectedItem is not null before accessing its properties
	let displayedPrice = selectedItem ? (selectedItem as MenuItem).price1 : ''; // Cast to MenuItem

	// Add new variables for size and add-ons
	let selectedSize = ''; // Variable to store selected size
	let selectedAddons: string[] = []; // Array to store selected add-ons

	let isCodePopupVisible = false; // New variable to control the code input popup visibility
	let voidIndex: number | null = null; // Store the index of the item to void
	let inputCode = '123456'; // Variable to store the input code

	const cardData = [
		{
			menu_no: '001',
			code: '001',
			title1: 'Pizza',
			title2: 'Pepperoni',
			price1: '₱250.00',
			price2: '₱500.00',
			price3: '₱1000.00',
			image: './foods/pizza.jpg',
			label: 'Food'
		},
		{
			menu_no: '002',
			code: '002',
			title1: 'Burger',
			title2: 'Cheese',
			price1: '₱150.00',
			price2: '₱300.00',
			price3: '₱600.00',
			image: './foods/burger.jpg',
			label: 'Food'
		},
		{
			menu_no: '003',
			code: '003',
			title1: 'Pasta',
			title2: 'Carbonara',
			price1: '₱180.00',
			price2: '₱360.00',
			price3: '₱540.00',
			image: './foods/pasta.jpg',
			label: 'Food'
		},
		{
			menu_no: '004',
			code: '004',
			title1: 'Salad',
			title2: 'Caesar',
			price1: '₱120.00',
			price2: '₱240.00',
			price3: '₱360.00',
			image: './foods/salad.jpg',
			label: 'Food'
		},
		{
			menu_no: '005',
			code: '005',
			title1: 'Steak',
			title2: 'Ribeye',
			price1: '₱500.00',
			price2: '₱1000.00',
			price3: '₱1500.00',
			image: './foods/steak.jpg',
			label: 'Food'
		},
		{
			menu_no: '006',
			code: '006',
			title1: 'Sushi',
			title2: 'Nigiri',
			price1: '₱300.00',
			price2: '₱600.00',
			price3: '₱900.00',
			image: './foods/sushi.jpg',
			label: 'Food'
		},
		{
			menu_no: '007',
			code: '007',
			title1: 'Sandwich',
			title2: 'Ham & Cheese',
			price1: '₱90.00',
			price2: '₱180.00',
			price3: '₱270.00',
			image: './foods/sandwich.jpg',
			label: 'Food'
		},
		{
			menu_no: '008',
			code: '008',
			title1: 'Fries',
			title2: 'Large',
			price1: '₱70.00',
			price2: '₱140.00',
			price3: '₱210.00',
			image: './foods/fries.jpg',
			label: 'Food'
		},
		{
			menu_no: '009',
			code: '009',
			title1: 'Ice Cream',
			title2: 'Vanilla',
			price1: '₱50.00',
			price2: '₱100.00',
			price3: '₱150.00',
			image: './foods/icecream.jpg',
			label: 'Dessert'
		},
		{
			menu_no: '010',
			code: '010',
			title1: 'Coffee',
			title2: 'Latte',
			price1: '₱100.00',
			price2: '₱200.00',
			price3: '₱300.00',
			image: './foods/coffee.jpg',
			label: 'Beverage'
		},
		{
			menu_no: '011',
			code: '011',
			title1: 'Tea',
			title2: 'Green',
			price1: '₱80.00',
			price2: '₱160.00',
			price3: '₱240.00',
			image: './foods/tea.jpg',
			label: 'Beverage'
		},
		{
			menu_no: '012',
			code: '012',
			title1: 'Juice',
			title2: 'Orange',
			price1: '₱60.00',
			price2: '₱60.00',
			price3: '₱60.00',
			image: './foods/juice.jpg',
			label: 'Beverage'
		}
	];

	// Payment handling functions
	function handleNumberInput(num: string) {
		// Specify num as a string
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

	// Function to handle placing an order and showing the popup
	function handlePlaceOrder() {
		isPopupVisible = true; // Show the popup
	}

	// Function to close the popup
	function closePopup() {
		isPopupVisible = false; // Hide the popup
		isVariationVisible = false; // Hide the popup
	}

	// Function to print the receipt and reset the state
	function printReceipt() {
		// Reset all relevant variables
		orderNumber = '#01';
		totalCost = '₱00.00';
		selectedCategory = 'All';
		payment = '';
		quantity = 1;
		isPopupVisible = false;
		isVariationVisible = false;
		selectedItem = null;
		selectedItemDetails = null;
		orderedItems = [];
		selectedSize = '';
		selectedAddons = [];
		voidIndex = null;
		inputCode = '123456';
		// Reload the page
		location.reload();
	}

	// Define a type for the selected item to avoid 'never' type error
	type MenuItem = {
		menu_no: string;
		code: string;
		title1: string;
		title2: string;
		price1: string;
		price2: string;
		price3: string;
		image: string;
		label: string;
	};

	// Function to format price with commas
	function formatPrice(price: number): string {
		return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	// Function to handle adding an item with size and add-ons
	function handleAdd(item: MenuItem) {
		selectedItem = item; // Set the selected item
		isVariationVisible = true; // Show the popup
	}

    function handleOrder(item: MenuItem) {
        selectedItem = item;
        const newItem = { // Create a new item object
            title: item.title1,
            price: item.price1 ? formatPrice(quantity * parseFloat(item.price1.replace('₱', '').replace(',', ''))) : '₱0.00',
            size: selectedSize,
            quantity: quantity,
            addons: selectedAddons
        };
        orderedItems = [...orderedItems, newItem]; // Create a new array reference
        console.log('Updated Ordered Items:', orderedItems); // Log the updated array
        selectedItem = null; // Reset selected item after adding to order
        closePopup(); // Close the popup after adding the item
    }

	// Function to handle size selection and update displayed price
	function selectSize(size: string) {
		 selectedSize = size; // Set the selected size
		 if (selectedItem) {
			 // Check if selectedItem is not null
			 if (size === 'Regular') {
				 displayedPrice = formatPrice(quantity * parseFloat(selectedItem.price1.replace('₱', '').replace(',', ''))); // Update price based on quantity
			 } else if (size === 'Large') {
				 displayedPrice = formatPrice(quantity * parseFloat(selectedItem.price2.replace('₱', '').replace(',', ''))); // Update price based on quantity
			 } else if (size === 'Family') {
				 displayedPrice = formatPrice(quantity * parseFloat(selectedItem.price3.replace('₱', '').replace(',', ''))); // Update price based on quantity
			 }
		 }
	}

	// Reactive statement to update displayedPrice based on quantity, selectedItem, and selectedSize
	$: {
		if (selectedItem) {
			let price = 0;
			if (selectedSize === 'Regular') {
				price = parseFloat(selectedItem.price1.replace('₱', '').replace(',', ''));
			} else if (selectedSize === 'Large') {
				price = parseFloat(selectedItem.price2.replace('₱', '').replace(',', ''));
			} else if (selectedSize === 'Family') {
				price = parseFloat(selectedItem.price3.replace('₱', '').replace(',', ''));
			}
			displayedPrice = formatPrice(quantity * price); // Update displayed price based on quantity
		}
	}

	// Function to handle voiding an order item
	function voidOrder(index: number) {
		voidIndex = index; // Store the index of the item to void
		isCodePopupVisible = true; // Show the code input popup
	}

	// Function to confirm voiding the order
	function confirmVoid() {
		if (inputCode.length === 6) {
			orderedItems.splice(voidIndex!, 1); // Remove the item at the specified index
			voidIndex = null; // Reset the index
			inputCode = ''; // Clear the input code
			isCodePopupVisible = false; // Hide the popup
		} else {
			alert('Please enter a valid 6-digit code.'); // Alert for invalid code
		}
	}

	// Function to close the code input popup
	function closeCodePopup() {
		isCodePopupVisible = false; // Hide the popup
		inputCode = ''; // Clear the input code
	}
</script>

<div class="flex h-screen">
	<Sidebar />
	<div class="flex flex-grow overflow-hidden bg-gray-100">
		<!-- Main Dashboard Content -->
		<div class="flex-start w-full overflow-auto p-4">
			<!-- Filter Bar Menu -->
			<div class="mb-4 flex space-x-4">
				<!-- Category Buttons -->
				{#each ['All', 'Beverages', 'Food', 'Desserts', 'Coffee', 'Tea', 'Juice', 'Sandwich', 'Sushi', 'Pasta', 'Burger'] as category}
					<button
						class="rounded-md px-6 py-2 font-bold text-black"
						class:bg-cyan-950={selectedCategory === category}
						class:text-white={selectedCategory === category}
						class:bg-white={selectedCategory !== category}
						class:shadow-md={selectedCategory !== category}
						on:click={() => (selectedCategory = category)}
					>
						{category}
					</button>
				{/each}
			</div>

			<!-- Content Based on Selected Category -->
			<div class="mb-4 font-bold text-black">
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
			<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
				{#each cardData.filter((item) => selectedCategory === 'All' || (selectedCategory === 'Beverages' && item.label === 'Beverage') || (selectedCategory === 'Food' && item.label === 'Food') || (selectedCategory === 'Desserts' && item.label === 'Dessert')) as { code, title1, title2, price1, price2, price3, image, menu_no }}
					<Card
						{code}
						{title1}
						{title2}
						{price1}
						{price2}
						{price3}
						{image}
						{menu_no}
						onAdd={handleAdd}
					/>
				{/each}
			</div>
		</div>
	</div>

	<!-- Right Side: Order Panel -->
	<div class="w-[380px]">
		<div
			class="fixed right-0 top-0 flex h-full w-[350px] flex-col items-center bg-gray-100 p-4 shadow-lg"
		>
			<!-- Order Number Section -->
			<div class="mb-4 w-full rounded-md bg-green-800 py-2 text-center text-white">
				<p class="text-sm font-bold">Order Number {orderNumber}</p>
			</div>

			<!-- Order Items Section -->
			<div class="mb-4 w-full flex-grow space-y-2 overflow-y-auto max-h-[400px]">
				{#if orderedItems.length > 0}
					{#each orderedItems as item, index}
						<div class="flex items-center justify-between rounded-md bg-white p-4 shadow-md transition-transform transform hover:scale-105">
							<div class="flex flex-col">
								<p class="font-semibold text-gray-800">{item.title} x {item.quantity}</p>
								<p class="text-gray-600">Size: {item.size}</p>
								<p class="text-gray-600">Add-ons: {item.addons.join(', ') || 'None'}</p>
							</div>
							<p class="font-semibold text-gray-800 text-lg">₱{item.price}</p>
							<button on:click={() => voidOrder(index)} class="text-red-500">Void</button>
						</div>
					{/each}
				{:else}
					<p class="text-gray-600 text-center">No items ordered yet.</p>
				{/if}
			</div>

			<!-- Bottom Section -->
			<div class="mt-auto w-full p-4 rounded-lg shadow-md">
				<!-- Total Cost and Change Section -->
				<div class="mb-4 flex w-full items-center justify-between border-b pb-2">
					<p class="font-semibold text-gray-700">Total Cost:</p>
					<p class="font-bold text-gray-800">₱{orderedItems.reduce((total, item) => total + parseFloat(item.price.replace('₱', '').replace(',', '')), 0).toFixed(2)}</p>
				</div>
				<div class="flex justify-between">
					<p class="text-lg">Amount Paid:</p>
					<span class="text-lg">₱{payment}</span>
				</div>
				<div class="flex justify-between">
					<p class="text-lg">Change:</p>
					<span class="text-lg">₱{orderedItems.length > 0 && payment ? 
						(parseFloat(payment.replace('₱', '').replace(',', '')) - 
						orderedItems.reduce((total, item) => total + parseFloat(item.price.replace('₱', '').replace(',', '')), 0)).toFixed(2) 
						: '0.00'}</span>
				</div>
			</div>

			<!-- Buttons Section -->
			<div class="grid h-[400px] w-full grid-cols-4 gap-2">
				<!-- Dine In and Take Out Buttons -->
				<button class="col-span-2 rounded bg-gray-300 py-2 font-bold text-gray-800"
					>Dine In</button
				>
				<button class="col-span-2 rounded bg-gray-300 py-2 font-bold text-gray-800"
					>Take Out</button
				>

				<!-- Number Buttons -->
				{#each ['7', '8', '9', '⌫', '4', '5', '6', 'Clr', '1', '2', '3', 'Void', '0', '00', 'Place Order'] as key, index}
					<button
						on:click={() => {
							if (key === '⌫') handleBackspace();
							else if (key === 'Clr') handleClear();
							else if (key === 'Void') voidOrder(index);
							else if (key === 'Place Order')
								handlePlaceOrder(); // Call the new function
							else handleNumberInput(key);
						}}
						class="rounded bg-gray-200 py-2 font-bold text-gray-800 col-span-{key ===
						'Place Order'
							? '2'
							: '1'} {key === 'Void' ? 'bg-red-900 text-white' : ''}"
					>
						{key}
					</button>
				{/each}
			</div>
		</div>
	</div>
</div>

<!-- Popup component -->
{#if isPopupVisible}
	<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
		<div class="rounded-lg bg-white p-8 shadow-lg">
			<!-- Increased padding for larger touch targets -->
			<!-- Logo -->
			<div class="mb-4 flex justify-center">
				<img src="icon.png" alt="Restaurant Logo" class="h-24" />
				<!-- Increased logo size for better visibility -->
			</div>
			<!-- Restaurant Details -->
			<h2 class="text-center text-2xl font-bold">Kape Rustiko Restaurant</h2>
			<!-- Increased font size -->
			<p class="text-center text-lg">Dewey Ave, Subic Bay Freeport Zone</p>
			<!-- Increased font size for better readability -->
			<p class="text-center text-lg">Contact: (047) 998-0000</p>
			<!-- Increased font size for better readability -->

			<!-- BIR Requirements -->
			<p class="text-center text-lg">TIN: 123-456-789</p>
			<!-- Increased font size for better readability -->
			<p class="text-center text-lg">Address: Dewey Ave, SBFZ</p>
			<!-- Increased font size for better readability -->

			<h2 class="mb-4 mt-4 text-center text-2xl font-bold">Sales Preview</h2>
			<!-- Increased font size -->
			<p class="text-lg">Receipt Number: {orderNumber}</p>
			<!-- Increased font size for better readability -->
			<p class="text-lg">Date and Time: {new Date().toLocaleString()}</p>
			<!-- Increased font size for better readability -->
			<p class="text-lg">Cashier Name: Mike</p>
			<!-- Increased font size for better readability -->
			<div class="flex justify-between">
				<h2 class="mt-4 text-lg font-bold">Items Ordered:</h2>
				<span class="mt-4 text-lg font-bold">Items Price</span>
			</div>
			<ul>
				{#each orderedItems as item}
					<li class="flex justify-between text-lg">
						{item.title} x {item.quantity} {item.size} {item.addons.length > 0 ? `(${item.addons.join(', ')})` : ''}
						<span>₱{item.price}</span>
					</li>
				{/each}
			</ul>
			<div class="flex justify-between">
				<p class="mt-4 text-lg font-bold">Total Amount</p>
				<span class="mt-4 text-lg font-bold">₱{orderedItems.reduce((total, item) => total + parseFloat(item.price.replace('₱', '').replace(',', '')), 0).toFixed(2)}</span>
			</div>
			<div class="flex justify-between">
				<p class="text-lg">Amount Paid:</p>
				<span class="text-lg">₱{payment}</span>
			</div>
			<div class="flex justify-between">
				<p class="text-lg">Change:</p>
				<span class="text-lg">₱{orderedItems.length > 0 && payment ? 
					(parseFloat(payment.replace('₱', '').replace(',', '')) - 
					orderedItems.reduce((total, item) => total + parseFloat(item.price.replace('₱', '').replace(',', '')), 0)).toFixed(2) 
					: '0.00'}</span>
			</div>
			<h2 class="mt-4 text-center text-2xl font-bold">Thank You for Dining with Us!</h2>
			<!-- Increased font size -->
			<div class="mt-4 flex justify-between">
				<button on:click={closePopup} class="mr-1 w-full rounded bg-red-500 px-6 py-3 text-white"
					>Cancel Order</button
				>
				<!-- Increased padding for larger touch targets -->
				<button on:click={printReceipt} class="ml-1 w-full rounded bg-blue-500 px-6 py-3 text-white"
					>Print Receipt</button
				>
				<!-- Increased padding for larger touch targets -->
			</div>
		</div>
	</div>
{/if}

<!-- Popup for variations, quantity, size, and add-ons -->
{#if isVariationVisible}
	<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70">
		<div class="w-full max-w-md rounded-lg bg-white p-8 shadow-lg">
			<!-- Increased padding for larger touch targets -->
			<h2 class="mb-6 text-center text-2xl font-bold">Add {selectedItem?.title1}</h2>
			<!-- Increased font size -->
			<p class="mb-6 text-center text-lg">Price: ₱{displayedPrice}</p>
			<!-- Show the updated price -->

			<!-- Product Image -->
			{#if selectedItem?.image}
				<img
					src={selectedItem.image}
					alt={selectedItem.title1}
					class="mb-4 h-[400px] w-full rounded"
				/>
				<!-- Added product image -->
			{/if}

			<!-- Size Selection -->
			<label for="size" class="mb-2 block text-sm font-medium">Size:</label>
			<!-- Increased margin for better spacing -->
			<div class="mb-6 flex w-full space-x-4">
				<!-- Added flex container for horizontal layout -->
				<button
					on:click={() => selectSize('Regular')}
					class="flex-1 rounded-md border border-gray-300 p-3 {selectedSize === 'Regular'
						? 'bg-blue-500 text-white'
						: ''}">Regular</button
				>
				<button
					on:click={() => selectSize('Large')}
					class="flex-1 rounded-md border border-gray-300 p-3 {selectedSize === 'Large'
						? 'bg-blue-500 text-white'
						: ''}">Large</button
				>
				<button
					on:click={() => selectSize('Family')}
					class="flex-1 rounded-md border border-gray-300 p-3 {selectedSize === 'Family'
						? 'bg-blue-500 text-white'
						: ''}">Family</button
				>
			</div>

			<!-- Add-ons Selection -->
			<label for="addons" class="mb-2 block text-sm font-medium">Add-ons:</label>
			<!-- Increased margin for better spacing -->
			<div class="mb-6">
				<!-- Increased margin for better spacing -->
				{#if selectedItem?.label === 'Beverage'}
					<label class="mb-4 block">
						<!-- Increased margin for better spacing -->
						<input
							type="checkbox"
							bind:group={selectedAddons}
							value="Extra Shot"
							class="mr-2 h-6 w-6"
						/> Extra Shot
					</label>
				{:else}
					<label class="mb-4 block">
						<!-- Increased margin for better spacing -->
						<input
							type="checkbox"
							bind:group={selectedAddons}
							value="Extra Cheese"
							class="mr-2 h-6 w-6"
						/> Extra Cheese
					</label>
					<label class="mb-4 block">
						<!-- Increased margin for better spacing -->
						<input type="checkbox" bind:group={selectedAddons} value="Bacon" class="mr-2 h-6 w-6" />
						Bacon
					</label>
					<label class="mb-4 block">
						<!-- Increased margin for better spacing -->
						<input
							type="checkbox"
							bind:group={selectedAddons}
							value="Olives"
							class="mr-2 h-6 w-6"
						/> Olives
					</label>
				{/if}
			</div>

			<label for="quantity" class="mb-2 block text-sm font-medium">Quantity:</label>
			<!-- Increased margin for better spacing -->
			<div class="mb-6 flex justify-between">
				<!-- Added flex container for button layout -->
				<button on:click={decreaseQuantity} class="flex-1 rounded-md border border-gray-300 p-3"
					>-</button
				>
				<input
					type="number"
					id="quantity"
					bind:value={quantity}
					min="1"
					class="mx-2 block w-full rounded-md border border-gray-300 p-3 text-center"
				/>
				<!-- Centered input -->
				<button on:click={increaseQuantity} class="flex-1 rounded-md border border-gray-300 p-3"
					>+</button
				>
			</div>

			<div class="flex justify-between">
				<button
					on:click={closePopup}
					class="rounded-md bg-red-500 px-6 py-3 text-white transition hover:bg-red-600"
					>Cancel</button
				>
				<!-- Increased padding for larger touch targets -->
				<button
					on:click={() => selectedItem && handleOrder(selectedItem)}
					class="rounded-md bg-blue-500 px-6 py-3 text-white transition hover:bg-blue-600"
					>Add to Order</button
				>
				<!-- Increased padding for larger touch targets -->
			</div>
		</div>
	</div>
{/if}

<!-- Popup for voiding an order -->
{#if isCodePopupVisible}
	<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70">
		<div class="w-full max-w-md rounded-lg bg-white p-8 shadow-lg">
			<h2 class="mb-4 text-center text-2xl font-bold">Input 6-Digit Code</h2>
			<input
				type="text"
				bind:value={inputCode}
				maxlength="6"
				class="w-full rounded border border-gray-300 p-2 text-center"
				placeholder="Enter 6-digit code"
			/>
			<div class="flex justify-between mt-4">
				<button on:click={closeCodePopup} class="rounded-md bg-red-500 px-4 py-2 text-white">Cancel</button>
				<button on:click={confirmVoid} class="rounded-md bg-blue-500 px-4 py-2 text-white">Confirm</button>
			</div>
		</div>
	</div>
{/if}
