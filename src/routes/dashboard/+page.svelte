<script>
    import { onMount } from "svelte";
    import { FontAwesomeIcon } from "@fortawesome/svelte-fontawesome";
    import { faStar, faUndo, faExclamationTriangle, faTrash, faPesoSign, faPrint } from "@fortawesome/free-solid-svg-icons";
    import Sidebar from "../sidebar/+page.svelte";
    import { Bar, Line, Pie } from 'svelte-chartjs';
    import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement } from 'chart.js';

    ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement);

    let salesRemitItems = [
      { id: 1, name: "Nandy pogi", totalSales: "₱1000.00", date: "₱1000.00", shortage: "₱10.00" },
      { id: 2, name: "Nandy padin", totalSales: "₱1000.00", date: "₱1000,00", shortage: "₱10.00" },
    ];

    let inventoryItems = [
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
        labels: ['Item A', 'Item B', 'Item C'],
        datasets: [
            {
                label: 'Inventory',
                data: [50, 30, 20],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
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

    function printPage() {
        window.print();
    }
</script>

<div class="flex h-screen bg-gradient-to-b from-green-500 to-green-700">
    <Sidebar />

    <!-- Main Content -->
    <div class="flex-grow p-6 bg-gray-100">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-6 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <div class="text-gray-500">Today Total Sales</div>
                <div class="text-3xl font-bold">###</div>
                <div class="text-green-600">
                    <FontAwesomeIcon icon={faPesoSign} />
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <div class="text-gray-500">Return Items</div>
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
                <div class="text-gray-500">Expired Items</div>
                <div class="text-3xl font-bold">###</div>
                <div class="text-red-500">
                    <FontAwesomeIcon icon={faExclamationTriangle} />
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <div class="text-gray-500">Total Dispose Items</div>
                <div class="text-3xl font-bold">###</div>
                <div class="text-red-500">
                    <FontAwesomeIcon icon={faTrash} />
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <div class="text-gray-500">Total Dispose Cost</div>
                <div class="text-3xl font-bold">###</div>
                <div class="text-red-500">
                    <FontAwesomeIcon icon={faPesoSign} />
                </div>
            </div>
        </div>

         <!-- Date Sorter -->
         <div class="flex justify-end mb-4 w-full">
            <input type="text" placeholder="Search..." class="bg-white text-black border border-gray-300 rounded p-2 mr-2 flex-grow shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <select class="bg-white text-black border border-gray-300 rounded p-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="sort-asc">Sort by Date (Asc)</option>
                <option value="sort-desc">Sort by Date (Desc)</option>
            </select>
            <button class="ml-2 p-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition duration-200" on:click={printPage}>
                <FontAwesomeIcon icon={faPrint} />
            </button>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-3 gap-2 mb-6">
            <div class="bg-white rounded-lg shadow-lg p-2">
                <h3 class="text-center font-bold text-sm">Sales Chart</h3>
                <Bar data={salesData} />
            </div>
            <div class="bg-white rounded-lg shadow-lg p-2">
                <h3 class="text-center font-bold text-sm">Inventory Chart</h3>
                <Bar data={inventoryData} options={{ responsive: true }} />
            </div>
            <div class="bg-white rounded-lg shadow-lg p-2">
                <h3 class="text-center font-bold text-sm">Returns Chart</h3>
                <Bar data={returnData} options={{ responsive: true }} />
            </div>
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
                            <th class="p-2 text-center">Shortage</th>
                            <th class="p-2 text-center">Validate</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        {#each salesRemitItems as item}
                            <tr class="border-t border-gray-300 hover:bg-gray-200 transition-colors duration-200">
                                <td class="p-2 text-center">{item.id}</td>
                                <td class="p-2 text-center">{item.name}</td>
                                <td class="p-2 text-center">{item.totalSales}</td>
                                <td class="p-2 text-center">{item.date}</td>
                                <td class="p-2 text-center">{item.shortage}</td>
                                <td class="p-2 text-center">
                                    <button class="p-1 bg-gray-200 text-gray-700 rounded">Validate</button>
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
  