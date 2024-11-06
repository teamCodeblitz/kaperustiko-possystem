<script>
    let email = '';
    let password = '';
    let firstName = '';
    let lastName = '';
    let middleName = '';
    let contactNumber = '';
    
    const handleSubmit = () => {
        // Handle form submission
        console.log('Email:', email);
        console.log('Password:', password);
        console.log('First Name:', firstName);
        console.log('Last Name:', lastName);
        console.log('Middle Name:', middleName);
        console.log('Contact Number:', contactNumber);
    };
</script>

<style>
    
    /* ANIMATED BACKGROUND */
    
    .circles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
    }
    
    .circles li {
      position: absolute;
      display: block;
      list-style: none;
      width: 20px;
      height: 20px;
      background-color: #838383;
      animation: animate 25s linear infinite;
      bottom: -150px;
    }
    
    .circles li:nth-child(1) {
      left: 25%;
      width: 80px;
      height: 80px;
      animation-delay: 0s;
    }
    
    .circles li:nth-child(2) {
      left: 10%;
      width: 20px;
      height: 20px;
      animation-delay: 2s;
      animation-duration: 12s;
    }
    
    .circles li:nth-child(3) {
      left: 70%;
      width: 20px;
      height: 20px;
      animation-delay: 4s;
    }
    
    .circles li:nth-child(4) {
      left: 40%;
      width: 60px;
      height: 60px;
      animation-delay: 0s;
      animation-duration: 18s;
    }
    
    .circles li:nth-child(5) {
      left: 65%;
      width: 20px;
      height: 20px;
      animation-delay: 0s;
    }
    
    .circles li:nth-child(6) {
      left: 75%;
      width: 110px;
      height: 110px;
      animation-delay: 3s;
    }
    
    .circles li:nth-child(7) {
      left: 35%;
      width: 150px;
      height: 150px;
      animation-delay: 7s;
    }
    
    .circles li:nth-child(8) {
      left: 50%;
      width: 25px;
      height: 25px;
      animation-delay: 15s;
      animation-duration: 45s;
    }
    
    .circles li:nth-child(9) {
      left: 20%;
      width: 15px;
      height: 15px;
      animation-delay: 2s;
      animation-duration: 35s;
    }
    
    .circles li:nth-child(10) {
      left: 85%;
      width: 150px;
      height: 150px;
      animation-delay: 0s;
      animation-duration: 11s;
    }
    
    @keyframes animate {
      0% {
        transform: translateY(0) rotate(0deg);
        opacity: 1;
        border-radius: 0;
      }
    
      100% {
        transform: translateY(-1000px) rotate(720deg);
        opacity: 0;
        border-radius: 50%;
      }
    }
    
    .image-container {
        position: relative;
        z-index: 2;

    }

    </style>
    <div class="flex flex-col min-h-screen md:flex-row">
        <div class="flex-1 bg-green-700 flex items-center justify-center relative left-section">
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
                <img src="./logo.png" alt="Fallback description if image fails to load" class="max-w-full h-auto" aria-hidden="true" />
            </div>
            <div class="absolute bottom-10 left-10 text-white text-lg">
                <h1 class="font-bold">Welcome to Kape Rustiko POS System</h1>
                <p class="add">Your gateway to an exceptional POS experience. Discover new opportunities with us!</p>
            </div>
        </div>
    <div class="flex-1 flex items-center justify-center">
        <form on:submit|preventDefault={handleSubmit} class="p-6 w-full md:w-2/3">
            <h2 class="text-3xl font-extrabold mb-4 text-center text-gradient">Be guided by system administrator</h2>
            <p class="text-center mb-6 text-gray-600">To get started, please fill in your details to create an account.</p>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" bind:value={email} required class="mt-1 block w-full p-2 border border-gray-300 rounded" placeholder="Enter your email"/>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" bind:value={password} required class="mt-1 block w-full p-2 border border-gray-300 rounded" placeholder="Enter your password"/>
            </div>
            <div class="mb-4">
                <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" id="firstName" bind:value={firstName} required class="mt-1 block w-full p-2 border border-gray-300 rounded" placeholder="Enter your first name"/>
            </div>
            <div class="mb-4">
                <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" id="lastName" bind:value={lastName} required class="mt-1 block w-full p-2 border border-gray-300 rounded" placeholder="Enter your last name"/>
            </div>
            <div class="mb-4">
                <label for="middleName" class="block text-sm font-medium text-gray-700">Middle Name</label>
                <input type="text" id="middleName" bind:value={middleName} class="mt-1 block w-full p-2 border border-gray-300 rounded" placeholder="Enter your middle name (optional)"/>
            </div>
            <div class="mb-4">
                <label for="contactNumber" class="block text-sm font-medium text-gray-700">Contact Number</label>
                <input type="tel" id="contactNumber" bind:value={contactNumber} required class="mt-1 block w-full p-2 border border-gray-300 rounded" placeholder="Enter your contact number"/>
            </div>
            <button type="submit" class="w-full bg-green-500 text-white p-2 rounded hover:bg-green-600">Register</button>
            <p class="mt-4 text-center">Already Have an Account? <button type="button" class="text-red-500" on:click={() => window.location.href='/login'}>Login Now</button></p>
        </form>
    </div>
</div>
