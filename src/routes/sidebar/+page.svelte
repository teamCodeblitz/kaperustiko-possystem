<script lang="ts">
    import { FontAwesomeIcon } from '@fortawesome/svelte-fontawesome';
    import { faTachometerAlt, faBox, faShoppingCart, faClock } from '@fortawesome/free-solid-svg-icons';
</script>

<div class="flex flex-col h-screen bg-green-800 w-16">
    <div class="flex justify-center mt-4">
        <img src="./icon.png" alt="Logo" class="w-14 h-14" />
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center mt-8">
        <FontAwesomeIcon icon={faTachometerAlt} class="text-white text-2xl" />
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center">
        <FontAwesomeIcon icon={faBox} class="text-white text-2xl" />
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center">
        <FontAwesomeIcon icon={faShoppingCart} class="text-white text-2xl" />
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center">
        <FontAwesomeIcon icon={faClock} class="text-white text-2xl" />
    </div>
    <div class="flex-grow"></div>
    <div class="flex flex-col items-center mb-4">
        <div class="flex justify-center mt-4">
            <img src="./default.jpg" alt="Avatar" class="w-12 h-12 rounded-full border-2 border-white" />
        </div>
        <span class="text-white font-bold mt-2 text-sm">USER</span>
        <button class="bg-gray-800 text-white rounded-full px-1 py-0.5 mt-2 text-xs hover:bg-gray-900">Log Out</button>
    </div>
</div>
