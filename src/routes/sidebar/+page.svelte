<script lang="ts">
    import { FontAwesomeIcon } from '@fortawesome/svelte-fontawesome';
    import { faTachometerAlt, faTruck, faBoxes, faUndo, faSignOutAlt, faChevronLeft, faChevronRight } from '@fortawesome/free-solid-svg-icons';
    import { faClipboardCheck, faExchangeAlt, faBoxOpen } from '@fortawesome/free-solid-svg-icons';
    import { onMount } from 'svelte';
    let isActive = { mainPos: false, transaction: false, dashboard: false, inventory: false, delivery: false, return: false }; // Define isActive without activeIcon
    let showModal = false; // Define showModal to control the modal visibility
    let sidebarWidth = 'w-18'; // Define a variable for sidebar width

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
        else if (currentPath === '/return') {
            setActive('return');
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

    function toggleSidebarWidth() {
        sidebarWidth = sidebarWidth === 'w-18' ? 'w-[220px]' : 'w-18'; // Toggle width
    }

</script>

<div class={`flex flex-col h-screen bg-cyan-950 ${sidebarWidth} sidebar`}>
    <div class="flex justify-center">
        {#if sidebarWidth === 'w-[220px]'}
            <img src="./icon2.png" alt="Logo" class="w-[200px] h-[200px] mt-[-15px] mb-[-5px] " />
        {:else}
            <img src="./icon.png" alt="Logo" class="w-[50px] h-[50px] mt-4 mb-[100px] " />
        {/if}
    </div>
    <div class="flex items-center p-4 hover:bg-cyan-600 justify-center mb-[50px]">
        <button type="button" on:click={() => { toggleSidebarWidth(); }} class="flex items-center justify-center">
            {#if sidebarWidth === 'w-[220px]'}
                <span class="text-white text-2xl font-bold">
                    Collapse
                </span>
            {:else}
                <span class="text-white">
                    <FontAwesomeIcon icon={faChevronRight} class="text-3xl" />
                </span>
            {/if}
        </button>
    </div>
    <div class="flex items-center p-4 hover:bg-cyan-600 justify-center" class:bg-white={isActive.mainPos} class:rounded-[4px]={isActive.mainPos} class:ml-[5px]={isActive.mainPos} class:mr-[5px]={isActive.mainPos} class:h-[50px]={isActive.mainPos}> 
        <button type="button" on:click={() => { window.location.href = '/main-pos'; setActive('mainPos'); }} class="flex items-center justify-center">
            {#if sidebarWidth === 'w-[220px]'}
                <span class:text-cyan-950={isActive.mainPos} class:text-white={!isActive.mainPos} class="text-2xl font-bold">Main POS</span>
            {:else}
                <span class:text-white={!isActive.mainPos}>
                    <FontAwesomeIcon icon={faTachometerAlt} class="text-3xl" />
                </span>
            {/if}
        </button>
    </div>
    <div class="flex items-center p-4 hover:bg-cyan-600 justify-center" class:bg-white={isActive.transaction} class:rounded-[4px]={isActive.transaction} class:ml-[5px]={isActive.transaction} class:mr-[5px]={isActive.transaction} class:h-[50px]={isActive.transaction}>
        <button type="button" on:click={() => { window.location.href = '/transaction'; setActive('transaction'); }} class="flex items-center justify-center">
            {#if sidebarWidth === 'w-[220px]'}
                <span class:text-cyan-950={isActive.transaction} class:text-white={!isActive.transaction} class="text-2xl font-bold">Transaction</span>
            {:else}
                <span class:text-white={!isActive.transaction}>
                    <FontAwesomeIcon icon={faClipboardCheck} class="text-3xl" />
                </span>
            {/if}
        </button>
    </div>
    <div class="flex items-center p-2 hover:bg-cyan-600 justify-center" class:bg-white={isActive.dashboard} class:rounded-[4px]={isActive.dashboard} class:ml-[5px]={isActive.dashboard} class:mr-[5px]={isActive.dashboard} class:h-[50px]={isActive.dashboard}>
        <button type="button" on:click={() => { window.location.href = '/dashboard'; setActive('dashboard'); }} class="flex items-center justify-center">
            {#if sidebarWidth === 'w-[220px]'}
                <span class:text-cyan-950={isActive.dashboard} class:text-white={!isActive.dashboard} class="text-2xl font-bold">Dashboard</span>
            {:else}
                <span class:text-white={!isActive.dashboard}>
                    <FontAwesomeIcon icon={faExchangeAlt} class="text-3xl" />
                </span>
            {/if}
        </button>
    </div>
    <div class="flex items-center p-4 hover:bg-cyan-600 justify-center" class:bg-white={isActive.inventory} class:rounded-[4px]={isActive.inventory} class:ml-[5px]={isActive.inventory} class:mr-[5px]={isActive.inventory} class:h-[50px]={isActive.inventory}>
        <button type="button" on:click={() => { window.location.href = '/inventory'; setActive('inventory'); }} class="flex items-center justify-center">
            {#if sidebarWidth === 'w-[220px]'}
                <span class:text-cyan-950={isActive.inventory} class:text-white={!isActive.inventory} class="text-2xl font-bold">Inventory</span>
            {:else}
                <span class:text-white={!isActive.inventory}>
                    <FontAwesomeIcon icon={faBoxOpen} class="text-3xl" />
                </span>
            {/if}
        </button>
    </div>
    <div class="flex items-center p-4 hover:bg-cyan-600 justify-center" class:bg-white={isActive.delivery} class:rounded-[4px]={isActive.delivery} class:ml-[5px]={isActive.delivery} class:mr-[5px]={isActive.delivery} class:h-[50px]={isActive.delivery}>
        <button type="button" on:click={() => { window.location.href = '/delivery'; setActive('delivery'); }} class="flex items-center justify-center">
            {#if sidebarWidth === 'w-[220px]'}
                <span class:text-cyan-950={isActive.delivery} class:text-white={!isActive.delivery} class="text-2xl font-bold">Delivery</span>
            {:else}
                <span class:text-white={!isActive.delivery}>
                    <FontAwesomeIcon icon={faTruck} class="text-3xl" />
                </span>
            {/if}
        </button>
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center" class:bg-white={isActive.return} class:rounded-[4px]={isActive.return} class:ml-[5px]={isActive.return} class:mr-[5px]={isActive.return} class:h-[50px]={isActive.return}>
        <button type="button" on:click={() => { window.location.href = '/return'; setActive('return'); }} class="flex items-center justify-center">
            {#if sidebarWidth === 'w-[220px]'}
                <span class:text-cyan-950={isActive.return} class:text-white={!isActive.return} class="text-2xl font-bold">Return</span>
            {:else}
                <span class:text-white={!isActive.return}>
                    <FontAwesomeIcon icon={faBoxes} class="text-3xl" />
                </span>
            {/if}
    </div>
    <div class="flex items-center p-4 hover:bg-green-600 justify-center" role="button" tabindex="0" on:click={() => window.location.reload()} on:keydown={(e) => e.key === 'Enter' && window.location.reload()}>
        {#if sidebarWidth === 'w-[220px]'}
            <span class="text-white text-2xl font-bold">Reload</span>
        {:else}
            <span class:text-white={!isActive.return}>
                <FontAwesomeIcon icon={faUndo} class="text-3xl" />
            </span>
        {/if}
    </div>
    <div class="flex-grow"></div>
    <div class="flex flex-col items-center mb-4">
        <div class="flex justify-center mt-4">
            <img src="./default.jpg" alt="Avatar" class="w-[50px] h-[50px] rounded-full border-2 border-white" />
        </div>
        <span class="text-white font-bold mt-2 text-sm">USER</span>
        <button class="bg-yellow-300 text-black rounded-full p-1 mt-2 text-lg hover:bg-gray-900" on:click={handleLogout}>
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
