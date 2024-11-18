<script lang="ts">
    import { onMount } from "svelte";
    import Sidebar from '../sidebar/+page.svelte';
    import { FontAwesomeIcon } from '@fortawesome/svelte-fontawesome';
    import { faEye, faEdit, faTrash } from '@fortawesome/free-solid-svg-icons';
  
    let items: any[] = [];

    // Fetch menu items from the backend
    onMount(async () => {
        const response = await fetch('http://localhost/kaperustiko-possystem/backend/get_menu.php'); // Update the URL as needed
        if (response.ok) {
            items = await response.json();
            console.log(items); // Debugging log to check the fetched data
        } else {
            console.error('Failed to fetch menu items');
        }
    });
</script>

<!-- Main Layout with Sidebar and Content -->
<div class="flex h-screen bg-gray-100">
    <Sidebar />
    <div class="flex-grow p-6 overflow-auto">
        <div class="rounded-lg shadow-lg overflow-hidden">
            <table class="min-w-full table-auto border-collapse bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-4 text-left">Product Image</th>
                        <th class="p-4 text-left">Product Code</th>
                        <th class="p-4 text-left">Product Name</th>
                        <th class="p-4 text-left">Label</th>
                        <th class="p-4 text-center">Price</th>
                        <th class="p-4 text-center">Qty</th>
                        <th class="p-4 text-center">Last Stock Date & Time</th>
                        <th class="p-4 text-center">Actions</th>
                        <th class="p-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    {#each items as item}
                        <tr class="border-gray-300 hover:bg-gray-100 transition duration-200">
                            <td class="p-4 text-center">
                                <img src={item.image} alt={item.title1} class="w-16 h-16 object-cover" />
                            </td>
                            <td class="p-4 text-left">{item.code}</td>
                            <td class="p-4">{item.title1} {item.title2}</td>
                            <td class="p-4">{item.label}</td>
                            <td class="p-4 text-center">
                              <ul class="text-gray-700 px-2 mt-1">
                                <li>Regular: ₱{item.price1}</li>
                                <li>Large: ₱{item.price2}</li>
                                <li>Family: ₱{item.price3}</li>
                              </ul>
                            </td>
                            <td class="p-4 text-center">{item.qty} {item.qty < 2 ? 'pc' : 'pcs'}</td>
                            <td class="p-4 text-center">
                                {new Date(`${item.stock_date} ${item.stock_time}`).toLocaleString('en-US', {
                                    month: 'long',
                                    day: 'numeric',
                                    year: 'numeric',
                                    hour: 'numeric',
                                    minute: 'numeric',
                                    second: 'numeric',
                                    hour12: true
                                })}
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex justify-center">
                                    <button class="p-2 text-gray-500 hover:bg-gray-100 rounded transition duration-200">
                                        Options
                                    </button>
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                <span class={`p-2 rounded ${item.qty == 0 || item.qty == '' ? 'bg-black text-white' : item.qty >= 1 && item.qty < 10 ? 'bg-red-500 text-white' : item.qty > 11 && item.qty < 20 ? 'bg-yellow-500 text-white' : item.qty > 21 && item.qty < 100 ? 'bg-green-500 text-white' : ''}`}>
                                    {item.qty == 0 || item.qty == '' ? 'Out of Stock' : item.qty >= 1 && item.qty < 10 ? 'Critical' : item.qty > 11 && item.qty < 20 ? 'Warning' : item.qty > 21 && item.qty < 100 ? 'Good' : ''}
                                </span>
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        </div>
    </div>
</div>
  