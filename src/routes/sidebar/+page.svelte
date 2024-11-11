<script lang="ts">
    import { FontAwesomeIcon } from '@fortawesome/svelte-fontawesome';
    import { faTachometerAlt, faBox, faShoppingCart, faClock, faUser, faClipboardList, faChartLine, faTruck, faBoxes, faUndo, faSignOutAlt } from '@fortawesome/free-solid-svg-icons';
    import { faClipboardCheck, faExchangeAlt, faBoxOpen } from '@fortawesome/free-solid-svg-icons';
    import { onMount } from 'svelte';
    let isActive = { dashboard: false, sales: false, exchange: false, inventory: false }; // Define isActive without activeIcon

    function setActive(icon: keyof typeof isActive) {
        // Reset all to false
        for (const key in isActive) {
            isActive[key as keyof typeof isActive] = false; // Cast key to the correct type
        }
        // Set the clicked icon to true
        isActive[icon] = true; // No need for activeIcon
    }

    onMount(() => {
        const currentPath = window.location.pathname; // Get the current path
        if (currentPath === '/main-pos') {
            setActive('dashboard'); 
        }
        else if (currentPath === '/transaction') {
            setActive('sales');
        }
        else if (currentPath === '/inventory') {
            setActive('inventory');
        }
    });

</script>

<div class="flex flex-col h-screen bg-cyan-950 w-14 ">
    <div class="flex justify-center mt-4 mb-24">
        <img src="./icon.png" alt="Logo" class="w-10 h-10 " />
    </div>
    <div class="flex items-center p-4 hover:bg-cyan-600 justify-center" class:bg-white={isActive.dashboard} class:rounded-[4px]={isActive.dashboard} class:ml-[5px]={isActive.dashboard} class:mr-[5px]={isActive.dashboard} class:h-[50px]={isActive.dashboard}> 
        <button type="button" on:click={() => { window.location.href = '/main-pos'; setActive('dashboard'); }} class="flex items-center">
            <span class:text-cyan-950={isActive.dashboard} class:text-white={!isActive.dashboard}>
                <FontAwesomeIcon icon={faTachometerAlt} class="text-2xl" />
            </span>
        </button>
    </div>
    <div class="flex items-center p-4 hover:bg-cyan-600 justify-center" class:bg-white={isActive.sales} class:rounded-[4px]={isActive.sales} class:ml-[5px]={isActive.sales} class:mr-[5px]={isActive.sales} class:h-[50px]={isActive.sales}>
        <button type="button" on:click={() => { window.location.href = '/transaction'; setActive('sales'); }} class="flex items-center">
            <span class:text-cyan-950={isActive.sales} class:text-white={!isActive.sales}>
                <FontAwesomeIcon icon={faClipboardCheck} class="text-2xl" />
            </span>
        </button>
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center">
        <FontAwesomeIcon icon={faExchangeAlt} class="text-white text-2xl"    />
    </div>
    <div class="flex items-center p-4 hover:bg-cyan-600 justify-center" class:bg-white={isActive.inventory} class:rounded-[4px]={isActive.inventory} class:ml-[5px]={isActive.inventory} class:mr-[5px]={isActive.inventory} class:h-[50px]={isActive.inventory}>
        <button type="button" on:click={() => { window.location.href = '/inventory'; setActive('inventory'); }} class="flex items-center">
            <span class:text-cyan-950={isActive.inventory} class:text-white={!isActive.inventory}>
                <FontAwesomeIcon icon={faBoxOpen} class="text-2xl"    />
            </span>
        </button>
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
            <img src="./default.jpg" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-white" />
        </div>
        <span class="text-white font-bold mt-2 text-sm">USER</span>
        <button class="bg-yellow-300 text-black rounded-full p-1 mt-2 text-2xs hover:bg-gray-900" on:click={() => { 
            localStorage.removeItem('userSession'); 
            window.location.href = '/login'; 
        }}>
          <FontAwesomeIcon icon={faSignOutAlt} class="text-black" />
        </button>
    </div>
</div>
