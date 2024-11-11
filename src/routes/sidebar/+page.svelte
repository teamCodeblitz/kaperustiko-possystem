<script lang="ts">
    import { FontAwesomeIcon } from '@fortawesome/svelte-fontawesome';
    import { faTachometerAlt, faBox, faShoppingCart, faClock, faUser, faClipboardList, faChartLine, faTruck, faBoxes, faUndo, faSignOutAlt } from '@fortawesome/free-solid-svg-icons';
    import { faClipboardCheck, faExchangeAlt, faBoxOpen } from '@fortawesome/free-solid-svg-icons';
    import { onMount } from 'svelte';
    let isActive = { mainPos: false, transaction: false, dashboard: false, inventory: false, delivery: false }; // Define isActive without activeIcon
    let showModal = false; // Define showModal to control the modal visibility

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
            setActive('mainPos'); 
        }
        else if (currentPath === '/transaction') {
            setActive('transaction');
        }
        else if (currentPath === '/dashboard') {
            setActive('dashboard');
        }
        else if (currentPath === '/inventory') {
            setActive('inventory');
        }
        else if (currentPath === '/delivery') {
            setActive('delivery');
        }
    });

    function handleLogout() {
        showModal = true; // Show the modal when logout is initiated
    }

    function confirmLogout() {
        localStorage.removeItem('userSession'); 
        window.location.href = '/login'; 
    }

    function cancelLogout() {
        showModal = false; // Close the modal without logging out
    }

</script>

<div class="flex flex-col h-screen bg-cyan-950 w-14 ">
    <div class="flex justify-center mt-4 mb-24">
        <img src="./icon.png" alt="Logo" class="w-10 h-10 " />
    </div>
    <div class="flex items-center p-4 hover:bg-cyan-600 justify-center" class:bg-white={isActive.mainPos} class:rounded-[4px]={isActive.mainPos} class:ml-[5px]={isActive.mainPos} class:mr-[5px]={isActive.mainPos} class:h-[50px]={isActive.mainPos}> 
        <button type="button" on:click={() => { window.location.href = '/main-pos'; setActive('mainPos'); }} class="flex items-center justify-center">
            <span class:text-cyan-950={isActive.mainPos} class:text-white={!isActive.mainPos}>
                <FontAwesomeIcon icon={faTachometerAlt} class="text-2xl" />
            </span>
        </button>
    </div>
    <div class="flex items-center p-4 hover:bg-cyan-600 justify-center" class:bg-white={isActive.transaction} class:rounded-[4px]={isActive.transaction} class:ml-[5px]={isActive.transaction} class:mr-[5px]={isActive.transaction} class:h-[50px]={isActive.transaction}>
        <button type="button" on:click={() => { window.location.href = '/transaction'; setActive('transaction'); }} class="flex items-center justify-center">
            <span class:text-cyan-950={isActive.transaction} class:text-white={!isActive.transaction}>
                <FontAwesomeIcon icon={faClipboardCheck} class="text-2xl" />
            </span>
        </button>
    </div>
    <div class="flex items-center p-4 hover:bg-cyan-600 justify-center" class:bg-white={isActive.dashboard} class:rounded-[4px]={isActive.dashboard} class:ml-[5px]={isActive.dashboard} class:mr-[5px]={isActive.dashboard} class:h-[50px]={isActive.dashboard}>
        <button type="button" on:click={() => { window.location.href = '/dashboard'; setActive('dashboard'); }} class="flex items-center justify-center">
            <span class:text-cyan-950={isActive.dashboard} class:text-white={!isActive.dashboard}>
                <FontAwesomeIcon icon={faExchangeAlt} class="text-2xl" />
            </span>
        </button>
    </div>
    <div class="flex items-center p-4 hover:bg-cyan-600 justify-center" class:bg-white={isActive.inventory} class:rounded-[4px]={isActive.inventory} class:ml-[5px]={isActive.inventory} class:mr-[5px]={isActive.inventory} class:h-[50px]={isActive.inventory}>
        <button type="button" on:click={() => { window.location.href = '/inventory'; setActive('inventory'); }} class="flex items-center justify-center">
            <span class:text-cyan-950={isActive.inventory} class:text-white={!isActive.inventory}>
                <FontAwesomeIcon icon={faBoxOpen} class="text-2xl"    />
            </span>
        </button>
    </div>
    <div class="flex items-center p-4 hover:bg-cyan-600 justify-center" class:bg-white={isActive.delivery} class:rounded-[4px]={isActive.delivery} class:ml-[5px]={isActive.delivery} class:mr-[5px]={isActive.delivery} class:h-[50px]={isActive.delivery}>
        <button type="button" on:click={() => { window.location.href = '/delivery'; setActive('delivery'); }} class="flex items-center justify-center">
            <span class:text-cyan-950={isActive.delivery} class:text-white={!isActive.delivery}>
                <FontAwesomeIcon icon={faTruck} class="text-2xl" />
            </span>
        </button>
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center">
        <FontAwesomeIcon icon={faBoxes} class="text-white text-2xl" />
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center" role="button" tabindex="0" on:click={() => window.location.reload()} on:keydown={(e) => e.key === 'Enter' && window.location.reload()}>
        <FontAwesomeIcon icon={faUndo} class="text-white text-2xl" />
    </div>
    <div class="flex-grow"></div>
    <div class="flex flex-col items-center mb-4">
        <div class="flex justify-center mt-4">
            <img src="./default.jpg" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-white" />
        </div>
        <span class="text-white font-bold mt-2 text-sm">USER</span>
        <button class="bg-yellow-300 text-black rounded-full p-1 mt-2 text-2xs hover:bg-gray-900" on:click={handleLogout}>
          <FontAwesomeIcon icon={faSignOutAlt} class="text-black" />
        </button>
    </div>
</div>

<!-- Modal for logout confirmation -->
{#if showModal}
<div class="fixed inset-0 flex items-center justify-center z-50">
    <div class="modal-overlay fixed inset-0 bg-black opacity-50"></div>
    <div class="modal-content bg-white rounded-lg shadow-lg p-6 z-10">
        <h2 class="text-lg font-bold mb-4">Confirm Logout</h2>
        <p class="mb-4">Are you sure you want to logout?</p>
        <div class="flex justify-end">
            <button on:click={confirmLogout} class="bg-red-500 text-white rounded px-4 py-2 mr-2 hover:bg-red-600">Yes</button>
            <button on:click={cancelLogout} class="bg-gray-300 text-black rounded px-4 py-2 hover:bg-gray-400">No</button>
        </div>
    </div>
</div>
{/if}
