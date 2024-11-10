<script lang="ts">
    import { FontAwesomeIcon } from '@fortawesome/svelte-fontawesome';
    import { faTachometerAlt, faBox, faShoppingCart, faClock, faUser, faClipboardList, faChartLine, faTruck, faBoxes, faUndo, faSignOutAlt } from '@fortawesome/free-solid-svg-icons';
    import { faClipboardCheck, faExchangeAlt, faBoxOpen } from '@fortawesome/free-solid-svg-icons';
    import { onMount } from 'svelte';
    let isActive = false;
    let activeIcon = ''; // Track the active icon


    function setActive(icon: string) {
        activeIcon = icon; // Set the active icon
    }
</script>

<div class="flex flex-col h-screen bg-cyan-950 w-14 ">
    <div class="flex justify-center mt-4 mb-24">
        <img src="./icon.png" alt="Logo" class="w-10 h-10 " />
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center">
        <button type="button" on:click={() => { window.location.href = '/main-pos'; setActive('dashboard'); }} class="flex items-center">
            <FontAwesomeIcon icon={faTachometerAlt} class={`text-2xl ${activeIcon === 'dashboard' ? 'text-black' : 'text-white'}`} />
        </button>
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center">
        <button type="button" on:click={() => { window.location.href = '/sales-page'; setActive('sales'); }} class="flex items-center">
            <FontAwesomeIcon icon={faClipboardCheck} class={`text-2xl ${activeIcon === 'sales' ? 'text-black' : 'text-white'}`} />
        </button>
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center">
        <FontAwesomeIcon icon={faExchangeAlt} class={`text-2xl ${activeIcon === 'exchange' ? 'text-black' : 'text-white'}`} />
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
        <button class="bg-yellow-300 text-black rounded-full p-1 mt-2 text-2xs hover:bg-gray-900">
          <FontAwesomeIcon icon={faSignOutAlt} class="text-black" />
        </button>
    </div>
</div>
