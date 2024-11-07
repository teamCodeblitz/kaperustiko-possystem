<script lang="ts">
    import { FontAwesomeIcon } from '@fortawesome/svelte-fontawesome';
    import { faTachometerAlt, faBox, faShoppingCart, faClock, faUser, faClipboardList, faChartLine, faTruck, faBoxes, faUndo } from '@fortawesome/free-solid-svg-icons';
    import { faClipboardCheck, faExchangeAlt, faBoxOpen } from '@fortawesome/free-solid-svg-icons';
    import { onMount } from 'svelte';
    let isActive = false;

    onMount(() => {
        isActive = window.location.pathname === '/main-pos';
    });
</script>

<div class="flex flex-col h-screen bg-green-950 w-14">
    <div class="flex justify-center mt-4">
        <img src="./icon.png" alt="Logo" class="w-14 h-14" />
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center mt-8 {isActive ? 'bg-yellow-500 rounded-md h-12 ml-1 mr-1' : ''}">
        <FontAwesomeIcon icon={faTachometerAlt} class="text-white text-2xl" />
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center">
        <FontAwesomeIcon icon={faClipboardCheck} class="text-white text-2xl" />
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center">
        <FontAwesomeIcon icon={faExchangeAlt} class="text-white text-2xl" />
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center">
        <FontAwesomeIcon icon={faBoxOpen} class="text-white text-2xl" />
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center">
        <FontAwesomeIcon icon={faBoxes} class="text-white text-2xl" />
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center">
        <FontAwesomeIcon icon={faUndo} class="text-white text-2xl" />
    </div>
    <div class="flex-grow"></div>
    <div class="flex flex-col items-center mb-4">
        <div class="flex justify-center mt-4">
            <img src="./default.jpg" alt="Avatar" class="w-12 h-12 rounded-full border-2 border-white" />
        </div>
        <span class="text-white font-bold mt-2 text-sm">USER</span>
        <button class="bg-stone-950 text-white rounded-full px-1 py-0.5 mt-2 text-xs hover:bg-gray-900">Log Out</button>
    </div>
</div>
