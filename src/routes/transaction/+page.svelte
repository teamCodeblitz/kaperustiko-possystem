<script>
    import { onMount } from "svelte";
    import Sidebar from "../sidebar/+page.svelte";
  
    let salesRemitItems = [
      { id: 1, name: "Nandy pogi", totalSales: "₱1000.00", date: "₱1000.00", shortage: "₱10.00" },
      { id: 2, name: "Nandy padin", totalSales: "₱1000.00", date: "₱1000,00", shortage: "₱10.00" },
    ];
  
    let inventoryItems = [
      { id: 1, name: "beef kardereta", quantity: "beef kardereta", disposeDate: "11-07-24", disposeCost: "₱100.00" },
    ];
  </script>
  
  <div class="flex h-screen bg-gradient-to-b from-green-500 to-green-700">
    <!-- Sidebar Component -->
    <Sidebar />
  
    <!-- Main Content -->
    <div class="flex-grow p-6 bg-gray-100">
      <!-- Statistics Cards -->
      <div class="grid grid-cols-6 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
          <div class="text-gray-500">Today Total Sales</div>
          <div class="text-3xl font-bold">###</div>
          <div class="text-green-600">₱</div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
          <div class="text-gray-500">Return Items</div>
          <div class="text-3xl font-bold text-green-500">🔄</div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
          <div class="text-gray-500">Best Seller</div>
          <div class="text-3xl font-bold text-green-500">⭐</div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
          <div class="text-gray-500">Expired Items</div>
          <div class="text-3xl font-bold text-red-500">❗</div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
          <div class="text-gray-500">Total Dispose Items</div>
          <div class="text-3xl font-bold text-red-500">🚮</div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
          <div class="text-gray-500">Total Dispose Cost</div>
          <div class="text-3xl font-bold text-red-500">₱</div>
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
                <th class="p-2">Remit id</th>
                <th class="p-2">Name</th>
                <th class="p-2">Total Sales</th>
                <th class="p-2">Date</th>
                <th class="p-2">Shortage</th>
                <th class="p-2">Validate</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              {#each salesRemitItems as item}
                <tr class="border-t border-gray-300">
                  <td class="p-2 text-center">{item.id}</td>
                  <td class="p-2">{item.name}</td>
                  <td class="p-2">{item.totalSales}</td>
                  <td class="p-2">{item.date}</td>
                  <td class="p-2">{item.shortage}</td>
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
                <th class="p-2">Dispose id</th>
                <th class="p-2">Item Name</th>
                <th class="p-2">Quantity</th>
                <th class="p-2">Dispose Date</th>
                <th class="p-2">Dispose Cost</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              {#each inventoryItems as item}
                <tr class="border-t border-gray-300">
                  <td class="p-2 text-center">{item.id}</td>
                  <td class="p-2">{item.name}</td>
                  <td class="p-2">{item.quantity}</td>
                  <td class="p-2">{item.disposeDate}</td>
                  <td class="p-2">{item.disposeCost}</td>
                </tr>
              {/each}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  