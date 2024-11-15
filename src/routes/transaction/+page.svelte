<script lang="ts">
    import { onMount } from "svelte";
    import Sidebar from "../sidebar/+page.svelte";
  
    // Define the type for a sale
    type Sale = {
        receipt: string;
        items: string;
        quantity: string;
        size: string;
        addons: string;
        price: string;
        totalCost: string;
        payAmount: string;
        changeDue: string;
        orderDate: string;
        orderTime: string;
        orderIn: string;
        name: string;
        totalDiscount: string;
        items_ordered: string;
    };
  
    let recentSales: Sale[] = [];
  
    onMount(async () => {
        // Fetch data from your API or database
        const response = await fetch('http://localhost/kaperustiko-possystem/backend/get_sales_information.php'); // Adjust the endpoint as necessary
        const data = await response.json();
  
        // Map the fetched data to the required format
        recentSales = data.map((sale: { 
            receipt_number: string; 
            items_ordered: string; 
            total_amount: number; 
            amount_paid: number; 
            amount_change: number; 
            date: string; 
            time: string; 
            order_take: string; 
            cashier_name: string; 
        }) => ({
            receipt: sale.receipt_number,
            items: JSON.parse(sale.items_ordered).map((item: { title: string }) => item.title).join(", "), // Specify item type
            quantity: JSON.parse(sale.items_ordered).map((item: { quantity: string }) => item.quantity).join(", "), // Specify item type
            size: JSON.parse(sale.items_ordered).map((item: { size: string }) => item.size).join(", "), // Specify item type
            addons: JSON.parse(sale.items_ordered).map((item: { addons: string }) => item.addons).join(", "), // Specify item type
            price: JSON.parse(sale.items_ordered).map((item: { price: string }) => item.price).join(", "), // Specify item type 
            totalCost: `₱${sale.total_amount}`,
            payAmount: `₱${sale.amount_paid}`,
            changeDue: `₱${sale.amount_change}`,
            orderDate: sale.date,
            orderTime: sale.time,
            orderIn: sale.order_take,
            name: sale.cashier_name,
            totalDiscount: "₱0.00", // Adjust if you have discount data
            items_ordered: sale.items_ordered,
        }));
    });
  </script>
  
  <div class="flex h-screen bg-gradient-to-b from-green-500 to-green-700">
    <!-- Sidebar Component -->
    <Sidebar />
  
    <!-- Main Content -->
    <div class="flex-grow p-6 bg-gray-100">
   
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
              <th class="p-3 text-center">Receipt #</th>
              <th class="p-3 text-left">Items</th>
              <th class="p-3 text-right">Total Cost</th>
              <th class="p-3 text-right">Pay Amount</th>
              <th class="p-3 text-right">Change Due</th>
              <th class="p-3 text-center">Order Date</th>
              <th class="p-3 text-center">Order Time</th>
              <th class="p-3 text-center">Order Type</th>
              <th class="p-3 text-center">Cashier</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            {#each recentSales as sale, i}
              <tr class="border-t border-gray-300 {i % 2 === 0 ? 'bg-blue-50' : ''}">
                <td class="p-3 text-center font-semibold">{sale.receipt}</td>
                <td class="p-3 text-left">
                    <ul class="list-none pl-5">
                        {#each JSON.parse(sale.items_ordered) as item}
                            <li>
                                {item.title} {item.quantity} - {item.size} 
                                {#if item.addons && item.addons !== ''}({item.addons}){/if}
                            </li>
                        {/each}
                    </ul>
                </td>
                <td class="p-3 text-right">{sale.totalCost}</td>
                <td class="p-3 text-right">{sale.payAmount}</td>
                <td class="p-3 text-right">{sale.changeDue}</td>
                <td class="p-3 text-center">{sale.orderDate}</td>
                <td class="p-3 text-center">{sale.orderTime}</td>
                <td class="p-3 text-center">{sale.orderIn}</td>
                <td class="p-3 text-center">{sale.name}</td>
              </tr>
            {/each}
          </tbody>
        </table>
      </div>
    </div>
  </div>
  