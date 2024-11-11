<script>
    import { onMount } from "svelte";
    import Sidebar from "../sidebar/+page.svelte";
  
    let recentSales = [
      {
        receipt: 1,
        items: "Hotdog ni nandy",
        quantity: "1x",
        totalCost: "₱500.00",
        payAmount: "₱500.00",
        changeDue: "₱0.00",
        orderDate: "11-07-24",
        orderTime: "12:39 AM",
        orderIn: "Nids",
        orderType: "Dine In",
        name: "Sam Pogi",
        totalDiscount: "₱24.00",
      },
      {
        receipt: 1,
        items: "Hotdog ni nandy",
        quantity: "1x",
        totalCost: "₱500.00",
        payAmount: "₱500.00",
        changeDue: "₱0.00",
        orderDate: "11-07-24",
        orderTime: "12:39 AM",
        orderIn: "Nids",
        orderType: "Dine In",
        name: "Sam Pogi",
        totalDiscount: "₱24.00",
      },
    ];
  </script>
  
  <div class="flex h-screen bg-gradient-to-b from-green-500 to-green-700">
    <!-- Sidebar Component -->
    <Sidebar />
  
    <!-- Main Content -->
    <div class="flex-grow p-6 bg-gray-100">
      <!-- Top Card for Total Sales -->
      <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow-md p-6 col-span-1 text-center">
          <div class="text-gray-500 font-medium">Today Total Sales</div>
          <div class="text-3xl font-bold">###</div>
          <div class="text-green-600 text-2xl">₱</div>
        </div>
      </div>
  
      <!-- Recent Sales Header -->
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Recent Sales</h2>
        <button class="bg-gray-800 text-white px-4 py-2 rounded shadow-md">Recent Sales</button>
      </div>
  
      <!-- Sales Table -->
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <table class="w-full text-left table-fixed border-collapse">
          <thead class="bg-gray-800 text-white">
            <tr>
              <th class="p-2">Receipt #</th>
              <th class="p-2">Items</th>
              <th class="p-2">Total Cost</th>
              <th class="p-2">Pay Amount</th>
              <th class="p-2">Change Due</th>
              <th class="p-2">Order Date</th>
              <th class="p-2">Order In</th>
              <th class="p-2">Order Type</th>
              <th class="p-2">Name</th>
              <th class="p-2">Total Discount</th>
              <th class="p-2">Action</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            {#each recentSales as sale, i}
              <tr class="border-t border-gray-300 {i % 2 === 0 ? 'bg-blue-100' : ''}">
                <td class="p-2 text-center">{sale.receipt}</td>
                <td class="p-2">{sale.items} <span class="text-gray-500">{sale.quantity}</span></td>
                <td class="p-2">{sale.totalCost}</td>
                <td class="p-2">{sale.payAmount}</td>
                <td class="p-2">{sale.changeDue}</td>
                <td class="p-2">
                  <span class="bg-green-200 text-green-800 px-2 py-1 rounded">{sale.orderDate}</span>
                  <span class="bg-green-200 text-green-800 px-2 py-1 rounded ml-2">{sale.orderTime}</span>
                </td>
                <td class="p-2">
                  <span class="bg-green-200 text-green-800 px-2 py-1 rounded">{sale.orderIn}</span>
                </td>
                <td class="p-2">{sale.orderType}</td>
                <td class="p-2">{sale.name}</td>
                <td class="p-2">{sale.totalDiscount}</td>
                <td class="p-2 text-center">
                  <button class="bg-red-500 text-white px-3 py-1 rounded">Void</button>
                </td>
              </tr>
            {/each}
          </tbody>
        </table>
      </div>
    </div>
  </div>
  