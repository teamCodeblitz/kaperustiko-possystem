<script>
    import { onMount } from "svelte";
    import Sidebar from '../sidebar/+page.svelte';
    import { FontAwesomeIcon } from '@fortawesome/svelte-fontawesome';
    import { faEye, faEdit, faTrash } from '@fortawesome/free-solid-svg-icons';
  
    let items = [
      {
        id: 1,
        name: "Item 1",
        price1: 1000.0,
        price2: 2000.0,
        stock1: 20,
        expDate: "11-07-24",
        status: "Good",
        stock2: 20,
        maxQty: 100,
      },
      {
        id: 2,
        name: "Item 2",
        price1: 1000.0,
        price2: 2000.0,
        stock1: 20,
        expDate: "11-07-24",
        status: "Good",
        stock2: 20,
        maxQty: 100,
      },
      {
        id: 2,
        name: "Item 2",
        price1: 1000.0,
        price2: 2000.0,
        stock1: 20,
        expDate: "11-07-24",
        status: "Good",
        stock2: 20,
        maxQty: 100,
      }
      // Add more items as needed
    ];
  </script>
  
  <!-- Main Layout with Sidebar and Content -->
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar Component -->
    <Sidebar />
  
    <!-- Main Content -->
    <div class="flex-grow p-6 overflow-auto">
      <div class="rounded-lg shadow-lg overflow-hidden">
        <!-- Search Bar and Filters -->
        <div class="flex items-center mb-4">
          <input
            type="text"
            placeholder="Search"
            class="flex-grow p-2 rounded border border-gray-300 focus:outline-none"
          />
          <div class="flex space-x-4 ml-4">
            <select class="p-2 rounded border border-gray-300 focus:outline-none">
              <option>Category</option>
            </select>
            <select class="p-2 rounded border border-gray-300 focus:outline-none">
              <option>Check Status</option>
            </select>
            <button class="p-2 bg-blue-500 text-white rounded">Prepared Item</button>
          </div>
        </div>
  
  
        <!-- Table -->
        <table class="min-w-full table-auto border-collapse bg-white shadow-md rounded-lg overflow-hidden">
          <thead class="bg-gray-800 text-white">
            <tr>
              <th class="p-4 text-center">ID</th>
              <th class="p-4 text-left">Name</th>
              <th class="p-4 text-right">Price 1</th>
              <th class="p-4 text-right">Price 2</th>
              <th class="p-4 text-center">Stock 1</th>
              <th class="p-4 text-center">Exp Date</th>
              <th class="p-4 text-center">Status</th>
              <th class="p-4 text-center">Stock 2</th>
              <th class="p-4 text-center">Max Qty</th>
              <th class="p-4 text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            {#each items as item}
              <tr class="border-gray-300 hover:bg-gray-100 transition duration-200">
                <td class="p-4 text-center">{item.id}</td>
                <td class="p-4">{item.name}</td>
                <td class="p-4 text-right">{item.price1.toFixed(2)}</td>
                <td class="p-4 text-right">{item.price2.toFixed(2)}</td>
                <td class="p-4 text-center">{item.stock1}</td>
                <td class="p-4 text-center">{item.expDate}</td>
                <td class="p-4 text-center">
                  <span class="px-2 py-1 rounded bg-green-200 text-green-800">
                    {item.status}
                  </span>
                </td>
                <td class="p-4 text-center">{item.stock2}</td>
                <td class="p-4 text-center">{item.maxQty}</td>
                <td class="p-4 text-center">
                  <div class="flex justify-center space-x-2">
                    <button class="p-2 text-blue-500 hover:bg-blue-100 rounded transition duration-200">
                      <FontAwesomeIcon icon={faEye} />
                    </button>
                    <button class="p-2 text-green-500 hover:bg-green-100 rounded transition duration-200">
                      <FontAwesomeIcon icon={faEdit} />
                    </button>
                    <button class="p-2 text-red-500 hover:bg-red-100 rounded transition duration-200">
                      <FontAwesomeIcon icon={faTrash} />
                    </button>
                  </div>
                </td>
              </tr>
            {/each}
          </tbody>
        </table>
      </div>
    </div>
  </div>
  