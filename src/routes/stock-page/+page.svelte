<script>
    import { onMount } from "svelte";
    import Sidebar from '../sidebar/+page.svelte';
  
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
  <div class="flex h-screen bg-pink-100">
    <!-- Sidebar Component -->
    <Sidebar />
  
    <!-- Main Content -->
    <div class="flex-grow p-6">
      <div class="rounded-lg shadow-lg overflow-hidden">
        <!-- Search Bar and Filters -->
        <div class="flex items-center justify-between p-4 bg-gray-100">
          <input
            type="text"
            placeholder="Search"
            class="w-1/3 p-2 rounded border border-gray-300 focus:outline-none"
          />
          <div class="flex space-x-4">
            <select class="p-2 rounded border border-gray-300 focus:outline-none">
              <option>Category</option>
            </select>
            <select class="p-2 rounded border border-gray-300 focus:outline-none">
              <option>Check Status</option>
            </select>
            <button class="p-2 bg-gray-200 rounded">Prepared Item</button>
          </div>
        </div>
  
        <!-- Table -->
        <table class="w-full text-left table-fixed border-collapse bg-white">
          <thead class="bg-gray-800 text-white">
            <tr>
              <th class="p-2 w-10">Id</th>
              <th class="p-2">Name</th>
              <th class="p-2">Price 1</th>
              <th class="p-2">Price 2</th>
              <th class="p-2">Stock 1</th>
              <th class="p-2">Exp Date</th>
              <th class="p-2">Status</th>
              <th class="p-2">Stock 2</th>
              <th class="p-2">Max Qty</th>
              <th class="p-6">Actions</th>
            </tr>
          </thead>
          <tbody>
            {#each items as item}
              <tr class="border-t border-gray-300">
                <td class="p-2 text-center">{item.id}</td>
                <td class="p-2">{item.name}</td>
                <td class="p-2">{item.price1.toFixed(2)}</td>
                <td class="p-2">{item.price2.toFixed(2)}</td>
                <td class="p-6">{item.stock1}</td>
                <td class="p-2">{item.expDate}</td>
                <td class="p-2">
                  <span class="px-2 py-1 rounded bg-green-200 text-green-800">
                    {item.status}
                  </span>
                </td>
                <td class="p-6">{item.stock2}</td>
                <td class="p-4">{item.maxQty}</td>
                <td class="p-2 flex space-x-2">
                  <button class="p-1 text-blue-500 hover:bg-blue-100 rounded">
                    👁️
                  </button>
                  <button class="p-1 text-green-500 hover:bg-green-100 rounded">
                    ✏️
                  </button>
                  <button class="p-1 text-red-500 hover:bg-red-100 rounded">
                    🗑️
                  </button>
                </td>
              </tr>
            {/each}
          </tbody>
        </table>
      </div>
    </div>
  </div>
  