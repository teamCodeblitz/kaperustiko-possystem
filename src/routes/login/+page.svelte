<script lang="ts">


	let email = 'user@example.com';
	let password = 'password';
	let isLoading = false; // New state variable to control loader visibility

	function handleLogin() {
		console.log('Logging in with', email, password);
		
		isLoading = true; // Set loading state to true

		// Redirect after 5 seconds
		setTimeout(() => {
			isLoading = false; // Reset loading state
			window.location.href = '/main-pos'; 
		}, 3000);
	}

	function handleSubmit() {
		handleLogin(); 
	}
</script>

{#if isLoading} <!-- Conditional rendering for loader -->
<div class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-75 z-50">
    
<div role="status">
    <svg fill="currentColor" viewBox="0 0 1792 1792" class="text-green-500 w-20 h-20 animate-spin"
    xmlns="http://www.w3.org/2000/svg">
    <path
        d="M1760 896q0 176-68.5 336t-184 275.5-275.5 184-336 68.5-336-68.5-275.5-184-184-275.5-68.5-336q0-213 97-398.5t265-305.5 374-151v228q-221 45-366.5 221t-145.5 406q0 130 51 248.5t136.5 204 204 136.5 248.5 51 248.5-51 204-136.5 136.5-204 51-248.5q0-230-145.5-406t-366.5-221v-228q206 31 374 151t265 305.5 97 398.5z" />
</svg>
    <span class="sr-only">Loading...</span>
</div>

</div>
{/if}
<div class="flex flex-col min-h-screen md:flex-row">
    <div class="flex-1 bg-cyan-950 flex items-center justify-center relative left-section">
       
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <div class="image-container">
            <img src="./icon.png" alt="Fallback description if image fails to load" class="max-w-full h-auto" aria-hidden="true" />
        </div>
        <div class="absolute bottom-10 left-10 text-white text-lg">
            <h1 class="font-bold">Welcome to Kape Rustiko POS System</h1>
            <p class="add">Your gateway to an exceptional POS experience. Discover new opportunities with us!</p>
        </div>
    </div>
    <div class="flex-1 flex items-center justify-center">
        <form on:submit|preventDefault={handleSubmit} class="p-6 w-full md:w-2/3">
            <h2 class="text-3xl font-extrabold mb-4 text-center text-gradient">Welcome Back to Your POS System!</h2>
            <p class="text-center mb-6 text-gray-600">Please enter your credentials to access your account.</p>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" bind:value={email} required class="mt-1 block w-full p-2 border border-gray-300 rounded" />
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" bind:value={password} required class="mt-1 block w-full p-2 border border-gray-300 rounded" />
            </div>
            <button type="submit" class="w-full bg-blue-900 text-white p-2 rounded hover:bg-sky-600">Log In</button>
            <p class="mt-4 text-center">Don't Have an Account? 
                <button type="button" class="text-red-500" on:click={() => window.location.href='/register'}>Register</button>
            </p>
            <p class="mt-2 text-center text-sm text-gray-500">Version 1.0.0 Developed by Team Codeblitz</p>
        </form>
    </div>
</div>