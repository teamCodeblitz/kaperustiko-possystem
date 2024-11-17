<script lang="ts">
    import { onMount } from "svelte";
    import { FontAwesomeIcon } from "@fortawesome/svelte-fontawesome";
    import { faStar, faUndo, faExclamationTriangle, faTrash, faDollarSign, faPrint } from "@fortawesome/free-solid-svg-icons";
    import Sidebar from "../sidebar/+page.svelte";
    import { Bar, Line, Pie } from 'svelte-chartjs';
    import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement } from 'chart.js';

    ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement);

    let salesRemitItems: any[] = [];

    let inventoryItems: any[] = [
      { id: 1, name: "beef kardereta", quantity: "beef kardereta", disposeDate: "11-07-24", disposeCost: "₱100.00" },
      { id: 2, name: "beef kardereta", quantity: "beef kardereta", disposeDate: "11-07-24", disposeCost: "₱100.00" },
    ];

    // Sample data for charts
    let salesData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [
            {
                label: 'Sales',
                data: [300, 500, 400, 600, 700, 800],
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
            }
        ]
    };

    let inventoryData = {
        labels: [],
        datasets: [
            {
                label: 'Critical',
                data: [],
                backgroundColor: 'red',
            },
            {
                label: 'Warning',
                data: [],
                backgroundColor: 'yellow',
            },
            {
                label: 'Good',
                data: [],
                backgroundColor: 'green',
            }
        ]
    };

    let returnData = {
        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
        datasets: [
            {
                label: 'Returns',
                data: [5, 10, 15, 20],
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                fill: false,
            }
        ]
    };

    let totalSalesToday = 0; // Variable to store today's total sales
    let sortOption = 'qty'; // Declare sortOption with a default value
    let selectedCategory = 'Food'; // Reactive variable for selected category

    onMount(async () => {
        const today = new Date();
        const formattedDate = `${today.getMonth() + 1}/${today.getDate()}/${today.getFullYear()}`; // Format date as MM/DD/YYYY
        const response = await fetch(`http://localhost/kaperustiko-possystem/backend/get_today_sales.php?date=${formattedDate}`); // Use formatted date in the URL
        const data = await response.json();
        if (data.length > 0 && data[0].total_amount) { // Adjusted to check the correct structure of the response
            totalSalesToday = data[0].total_amount; // Update the total sales for today
        }

        // Fetch all sales remit items from the backend
        const responseRemit = await fetch('http://localhost/kaperustiko-possystem/backend/get_remit_sales.php');
        const remitItems = await responseRemit.json();
        salesRemitItems = remitItems; // Store fetched data in salesRemitItems

        fetchDataForCategory(selectedCategory); // Fetch data for Food on mount
    });

    function printPage() {
        window.print();
    }

    function handleCategoryChange(event: Event) {
        selectedCategory = (event.target as HTMLSelectElement).value; // Update selectedCategory with the dropdown value
        console.log("Selected Category:", selectedCategory);
        
        // Fetch and filter data based on selectedCategory
        fetchDataForCategory(selectedCategory); // Call the new function to fetch data
    }

    async function fetchDataForCategory(category: string) {
        const responseMenu = await fetch(`http://localhost/kaperustiko-possystem/backend/get_menu_dashboard.php?label=${category}&label2=${category}`);
        const menuItems = await responseMenu.json();

        // Populate inventoryData with fetched menu items
        inventoryData.labels = menuItems.map((item: { title1: string, qty: number }) => `${item.title1}`); // Set labels to title and qty
        inventoryData.datasets[0].data = menuItems.map((item: { qty: number }) => item.qty); // Set data to qty

        // Set background colors based on qty with a maximum of 30
        inventoryData.datasets[0].backgroundColor = menuItems.map((item: { qty: number }) => {
            const quantity = Math.min(item.qty, 30); // Limit quantity to a maximum of 30
            if (quantity < 10) return 'red'; // Red
            if (quantity < 20) return 'yellow'; // Yellow
            return 'green';
        });
    }
</script>

<div class="flex h-screen bg-gradient-to-b from-green-500 to-green-700">
    <Sidebar />

    <!-- Main Content -->
    <div class="flex-grow p-6 bg-gray-100">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-6 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <div class="text-gray-500">Today's Total Sales</div>
                <div class="text-3xl font-bold">₱{totalSalesToday}</div>
                <div class="text-green-600">
                    <FontAwesomeIcon icon={faDollarSign} />
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <div class="text-gray-500">Overall Total Sales</div>
                <div class="text-3xl font-bold">###</div>
                <div class="text-green-500">
                    <FontAwesomeIcon icon={faUndo} />
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <div class="text-gray-500">Best Seller</div>
                <div class="text-3xl font-bold">###</div>
                <div class="text-green-500">
                    <FontAwesomeIcon icon={faStar} />
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <div class="text-gray-500">Today's Total Shortage</div>
                <div class="text-3xl font-bold">###</div>
                <div class="text-red-500">
                    <FontAwesomeIcon icon={faExclamationTriangle} />
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <div class="text-gray-500">Overall Total Shortage</div>
                <div class="text-3xl font-bold">###</div>
                <div class="text-red-500">
                    <FontAwesomeIcon icon={faTrash} />
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <div class="text-gray-500">Total Dispose Cost</div>
                <div class="text-3xl font-bold">###</div>
                <div class="text-red-500">
                    <FontAwesomeIcon icon={faDollarSign} />
                </div>
            </div>
        </div>

         <!-- Date Sorter -->
         

        <!-- Charts Section -->
        <div class="grid grid-cols-3 gap-2 mb-6">
            <div class="bg-white rounded-lg shadow-lg p-2">
                <h3 class="text-center font-bold text-sm">Sales Chart</h3>
                <Bar data={salesData} />
            </div>
            <div class="bg-white rounded-lg shadow-lg p-2">
                <h3 class="text-center font-bold text-sm">Inventory Chart</h3>
                <select class="bg-white text-black border border-gray-300 rounded p-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" on:change={handleCategoryChange} value={selectedCategory}>
                    <option value="Beverages">Beverages</option>
                    <option value="Food">Food</option>
                    <option value="Dessert">Dessert</option>
                    <option value="Coffee">Coffee</option>
                    <option value="Pasta">Pasta</option>
                    <option value="Burger">Burger</option>
                    <option value="Ulam">Ulam</option>
                </select>
                <Bar data={inventoryData} options={{ 
                    responsive: true, 
                    scales: {
                        y: {
                            max: 30 // Set maximum value for y-axis
                        }
                    }
                }} />
            </div>
            <div class="bg-white rounded-lg shadow-lg p-2">
                <h3 class="text-center font-bold text-sm">Returns Chart</h3>
                <Bar data={returnData} options={{ responsive: true }} />
            </div>
        </div>
        <div class="flex justify-end mb-4 w-full">
            <input type="text" placeholder="Search..." class="bg-white text-black border border-gray-300 rounded p-2 mr-2 flex-grow shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
           
            <button class="ml-2 p-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition duration-200" on:click={printPage}>
                <FontAwesomeIcon icon={faPrint} />
            </button>
        </div>
        <!-- Tables Section -->
        <div class="grid grid-cols-2 gap-4">
            <!-- Sales Remit Table -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gray-800 text-white text-center font-bold p-2">Sales Remit</div>
                <table class="w-full text-left table-fixed border-collapse">
                    <thead class="bg-gray-700 text-white">
                        <tr>
                            <th class="p-2 text-center">Remit ID</th>
                            <th class="p-2 text-center">Name</th>
                            <th class="p-2 text-center">Total Sales</th>    
                            <th class="p-2 text-center">Date</th>
                            <th class="p-2 text-center">Time</th>
                            <th class="p-2 text-center">Shortage</th>
                            <th class="p-2 text-center">Validate</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        {#each salesRemitItems as item}
                            <tr class="border-t border-gray-300 hover:bg-gray-200 transition-colors duration-200">
                                <td class="p-2 text-center">{item.remit_id}</td>
                                <td class="p-2 text-center">{item.cashier_name}</td>
                                <td class="p-2 text-center">₱{item.total_sales}.00</td>
                                <td class="p-2 text-center">{item.remit_date}</td>
                                <td class="p-2 text-center">{item.remit_time}</td>
                                <td class="p-2 text-center">₱{item.remit_shortage}.00</td>
                                <td class="p-2 text-center">
                                    <button class="p-1 {item.validation === 'Validated' ? 'bg-green-500' : item.validation === 'Pending' ? 'bg-yellow-500' : 'bg-gray-200'} text-white rounded">{item.validation}</button>
                                </td>
                            </tr>
                        {/each}
                    </tbody>
                </table>
            </div>

            <!-- Inventory Item Dispose Table -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gray-800 text-white text-center font-bold p-2">Inventory Item Dispose</div>
                <table class="w-full text-left table-fixed border-collapse">
                    <thead class="bg-gray-700 text-white">
                        <tr>
                            <th class="p-2 text-center">Dispose ID</th>
                            <th class="p-2 text-center">Item Name</th>
                            <th class="p-2 text-center">Quantity</th>
                            <th class="p-2 text-center">Dispose Date</th>
                            <th class="p-2 text-center">Dispose Cost</th>
                            <th class="p-2 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        {#each inventoryItems as item}
                            <tr class="border-t border-gray-300 hover:bg-gray-200 transition-colors duration-200">
                                <td class="p-2 text-center">{item.id}</td>
                                <td class="p-2 text-center">{item.name}</td>
                                <td class="p-2 text-center">{item.quantity}</td>
                                <td class="p-2 text-center">{item.disposeDate}</td>
                                <td class="p-2 text-center">{item.disposeCost}</td>
                                <td class="p-2 text-center">
                                    <button class="p-1 bg-gray-200 text-gray-700 rounded">Status</button>
                                </td>
                            </tr>
                        {/each}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
  