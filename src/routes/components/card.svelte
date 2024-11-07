<script>
    import { Button } from 'flowbite-svelte';
    
    // Define props for dynamic data
    export let code = '001';
    export let title1 = '####';
    export let title2 = '####';
    export let price = '₱00.00';
  </script>
  
  <div class="flex items-center justify-center">
    <div class="relative bg-white shadow-lg rounded-lg w-80 p-5 flex">
      <!-- Image Placeholder (Left Side) -->
      <div class="w-1/2 h-62 bg-gray-200 rounded-lg mr-4"></div>
  
      <!-- Right Side: Code, Text, and Button Section -->
      <div class="w-1/2 flex flex-col justify-between pt-8">
        <!-- Top Code Section -->
        <div class="absolute top-3 right-3 bg-gray-200 text-gray-500 text-xs rounded-full px-2 py-1">
          CODE: {code}
        </div>
  
        <!-- Text Section -->
        <div class="space-y-2 text-left">
          <p class="font-bold text-lg text-gray-800">{title1}</p>
          <p class="font-bold text-lg text-gray-800">{title2}</p>
          <p class="text-xl font-bold text-gray-800">{price}</p>
        </div>
  
        <!-- Order Button -->
        <Button color="dark" class="w-full mt-4">
          ORDER
        </Button>
      </div>
    </div>
  </div>
  