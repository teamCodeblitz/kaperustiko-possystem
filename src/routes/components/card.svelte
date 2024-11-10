<script>
    import { Button } from 'flowbite-svelte';
    import { createEventDispatcher } from 'svelte';

    const dispatch = createEventDispatcher();

    // Define props for dynamic data
    export let code = '';
    export let title1 = '';
    export let title2 = '';
    export let price = '';
    export let image = '';
  </script>
  
  <div class="flex items-center justify-center">
    <div class="relative bg-white shadow-lg rounded-lg w-full h-64 p-5 flex">
      
      <!-- Left Image Section -->
      <div class="w-1/2 h-62 bg-gray-200 rounded-lg mr-4">
        <img src={image} alt="Image" class="w-full h-full rounded-lg object-cover" aria-hidden="true">
      </div>
  
      <!-- Right Information Section -->
      <div class="w-1/2 flex flex-col justify-between pt-8">
        <!-- Centered Code Section -->
        <div class="absolute top-3 ml-12 bg-gray-200 text-gray-500 text-xs rounded-full px-2 py-1">
          CODE: {code}
        </div>
  
        <!-- Text Section -->
        <div class="space-y-2 text-left">
          <p class="font-bold text-3xl text-gray-800">{title1}</p>
          <p class="text-gray-500 text-lg">{title2}</p>
        </div>
  
        <!-- Price Section -->
        <p class="text-4xl font-bold text-gray-800">{price}</p>
  
        <!-- Order Button -->
        <Button color="dark" class="w-full" on:click={() => dispatch('add', { code: '003', title: 'Pasta' })}>
          ADD
        </Button>
      </div>
    </div>
  </div>
  