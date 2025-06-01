<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login & Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Custom tailwind color */
    :root {
      --color-primary: #1775F1;
    }
    body {
      background-color: var(--color-primary);
    }
    .text-primary {
      color: var(--color-primary);
    }
    .bg-primary {
      background-color: var(--color-primary);
    }
    .border-primary {
      border-color: var(--color-primary);
    }
    .focus\:border-primary:focus {
      border-color: var(--color-primary);
      outline: none;
      box-shadow: 0 0 0 3px rgba(23, 117, 241, 0.3);
    }
    .focus\:ring-primary:focus {
      --tw-ring-color: var(--color-primary);
    }
    button.tab-btn {
      cursor: pointer;
      user-select: none;
    }
    .loading {
      opacity: 0.6;
      pointer-events: none;
    }
    .spinner {
      display: inline-block;
      width: 16px;
      height: 16px;
      border: 2px solid #ffffff;
      border-radius: 50%;
      border-top-color: transparent;
      animation: spin 1s ease-in-out infinite;
    }
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4">
  <div class="max-w-md bg-white w-full space-y-8 p-8 border border-gray-200 rounded-lg shadow-lg">
    <div class="flex justify-center mb-6 space-x-6">
      <button id="loginTab" class="tab-btn px-6 py-2 font-semibold rounded-md border-b-4 border-primary text-primary focus:outline-none">
        Login
      </button>
      <button id="registerTab" class="tab-btn px-6 py-2 font-semibold rounded-md border-b-4 border-transparent text-gray-500 hover:text-primary focus:outline-none">
        Register
      </button>
    </div>

    <!-- Alert Container -->
    <div id="alertContainer" class="hidden"></div>

    <!-- Login Form -->
    <form id="loginForm" class="space-y-6" autocomplete="off">
      <div>
        <label for="loginEmail" class="block mb-1 font-medium text-gray-700">Email address</label>
        <input
          id="loginEmail"
          name="email"
          type="email"
          required
          class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-md placeholder-gray-400 focus:border-primary focus:ring-2 focus:ring-primary"
          placeholder="you@example.com"
        />
      </div>
      <div>
        <label for="loginPassword" class="block mb-1 font-medium text-gray-700">Password</label>
        <input
          id="loginPassword"
          name="password"
          type="password"
          required
          class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-md placeholder-gray-400 focus:border-primary focus:ring-2 focus:ring-primary"
          placeholder="********"
        />
      </div>
      <div>
        <button
          type="submit"
          id="loginBtn"
          class="w-full py-3 bg-primary text-white font-semibold rounded-md hover:bg-blue-600 transition"
        >
          Sign In
        </button>
      </div>
    </form>

    <!-- Register Form -->
    <form id="registerForm" class="hidden space-y-6" autocomplete="off">
      <div>
        <label for="registerName" class="block mb-1 font-medium text-gray-700">Full Name</label>
        <input
          id="registerName"
          name="name"
          type="text"
          required
          class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-md placeholder-gray-400 focus:border-primary focus:ring-2 focus:ring-primary"
          placeholder="Your full name"
        />
      </div>
      <div>
        <label for="registerEmail" class="block mb-1 font-medium text-gray-700">Email address</label>
        <input
          id="registerEmail"
          name="email"
          type="email"
          required
          class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-md placeholder-gray-400 focus:border-primary focus:ring-2 focus:ring-primary"
          placeholder="you@example.com"
        />
      </div>
      <div>
        <label for="registerPhone" class="block mb-1 font-medium text-gray-700">Phone Number</label>
        <input
          id="registerPhone"
          name="nomer_telepon"
          type="tel"
          required
          pattern="[0-9+\(\)\-\.\s]{6,20}"
          class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-md placeholder-gray-400 focus:border-primary focus:ring-2 focus:ring-primary"
          placeholder="+62 812 3456 7890"
        />
      </div>
      <div>
        <label for="registerAddress" class="block mb-1 font-medium text-gray-700">Address</label>
        <textarea
          id="registerAddress"
          name="alamat"
          rows="2"
          required
          class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-md placeholder-gray-400 focus:border-primary focus:ring-2 focus:ring-primary resize-none"
          placeholder="Your full address"
        ></textarea>
      </div>
      <div>
        <label for="registerPassword" class="block mb-1 font-medium text-gray-700">Password</label>
        <input
          id="registerPassword"
          name="password"
          type="password"
          required
          class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-md placeholder-gray-400 focus:border-primary focus:ring-2 focus:ring-primary"
          placeholder="********"
        />
      </div>
      <div>
        <label for="registerConfirmPassword" class="block mb-1 font-medium text-gray-700">Confirm Password</label>
        <input
          id="registerConfirmPassword"
          name="password_confirmation"
          type="password"
          required
          class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-md placeholder-gray-400 focus:border-primary focus:ring-2 focus:ring-primary"
          placeholder="********"
        />
      </div>
      <div>
        <button
          type="submit"
          id="registerBtn"
          class="w-full py-3 bg-primary text-white font-semibold rounded-md hover:bg-blue-600 transition"
        >
          Register
        </button>
      </div>
    </form>
  </div>

  <script>
    // Configuration
    const API_BASE_URL = 'http://localhost:8000/api/v1'; // Sesuaikan dengan URL Laravel Anda
    
    document.addEventListener('DOMContentLoaded', () => {
      const loginTab = document.getElementById('loginTab');
      const registerTab = document.getElementById('registerTab');
      const loginForm = document.getElementById('loginForm');
      const registerForm = document.getElementById('registerForm');
      const alertContainer = document.getElementById('alertContainer');

      // Tab switching functionality
      loginTab.addEventListener('click', () => {
        loginTab.classList.add('border-primary', 'text-primary');
        loginTab.classList.remove('text-gray-500', 'border-transparent');
        registerTab.classList.remove('border-primary', 'text-primary');
        registerTab.classList.add('text-gray-500', 'border-transparent');

        loginForm.classList.remove('hidden');
        registerForm.classList.add('hidden');
        clearAlert();
      });

      registerTab.addEventListener('click', () => {
        registerTab.classList.add('border-primary', 'text-primary');
        registerTab.classList.remove('text-gray-500', 'border-transparent');
        loginTab.classList.remove('border-primary', 'text-primary');
        loginTab.classList.add('text-gray-500', 'border-transparent');

        registerForm.classList.remove('hidden');
        loginForm.classList.add('hidden');
        clearAlert();
      });

      // Utility functions
      function showAlert(message, type = 'error') {
        const alertClass = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700';
        alertContainer.innerHTML = `
          <div class="border px-4 py-3 rounded ${alertClass}" role="alert">
            <span class="block sm:inline">${message}</span>
          </div>
        `;
        alertContainer.classList.remove('hidden');
      }

      function clearAlert() {
        alertContainer.classList.add('hidden');
        alertContainer.innerHTML = '';
      }

      function setLoading(button, isLoading) {
        if (isLoading) {
          button.innerHTML = '<span class="spinner"></span> Loading...';
          button.classList.add('loading');
        } else {
          button.innerHTML = button.id === 'loginBtn' ? 'Sign In' : 'Register';
          button.classList.remove('loading');
        }
      }

      // API call functions
      async function loginUser(formData) {
        const headers = {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        };

        // Add CSRF token for web routes
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (csrfToken) {
          headers['X-CSRF-TOKEN'] = csrfToken.getAttribute('content');
        }

        const response = await fetch(`${API_BASE_URL}/login`, {
          method: 'POST',
          headers: headers,
          credentials: 'same-origin', // Include cookies for CSRF
          body: JSON.stringify(formData)
        });

        const data = await response.json();
        
        if (!response.ok) {
          // Handle validation errors
          if (data.errors) {
            const errorMessages = Object.values(data.errors).flat().join(', ');
            throw new Error(errorMessages);
          }
          throw new Error(data.message || 'Login failed');
        }
        
        return data;
      }

      async function registerUser(formData) {
        const headers = {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        };

        // Add CSRF token for web routes
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (csrfToken) {
          headers['X-CSRF-TOKEN'] = csrfToken.getAttribute('content');
        }

        const response = await fetch(`${API_BASE_URL}/register`, {
          method: 'POST',
          headers: headers,
          credentials: 'same-origin', // Include cookies for CSRF
          body: JSON.stringify(formData)
        });

        const data = await response.json();
        
        if (!response.ok) {
          // Handle validation errors
          if (data.errors) {
            const errorMessages = Object.values(data.errors).flat().join(', ');
            throw new Error(errorMessages);
          }
          throw new Error(data.message || 'Registration failed');
        }
        
        return data;
      }

      // Form submit handlers
      loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const loginBtn = document.getElementById('loginBtn');
        
        try {
          setLoading(loginBtn, true);
          clearAlert();
          
          const formData = new FormData(loginForm);
          const data = Object.fromEntries(formData);
          
          const result = await loginUser(data);
          
          // Save token to localStorage (optional)
          if (result.token) {
            localStorage.setItem('auth_token', result.token);
          }
          
          showAlert('Login successful!', 'success');
          
          // Redirect or do something after successful login
          setTimeout(() => {
            // window.location.href = '/dashboard'; // Uncomment to redirect
            console.log('Login successful:', result);
          }, 1500);
          
        } catch (error) {
          showAlert(error.message);
        } finally {
          setLoading(loginBtn, false);
        }
      });

      registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const registerBtn = document.getElementById('registerBtn');
        
        try {
          setLoading(registerBtn, true);
          clearAlert();
          
          const formData = new FormData(registerForm);
          const data = Object.fromEntries(formData);
          
          // Client-side password confirmation check
          if (data.password !== data.password_confirmation) {
            throw new Error('Passwords do not match!');
          }
          
          const result = await registerUser(data);
          
          // Save token to localStorage if provided
          if (result.token) {
            localStorage.setItem('auth_token', result.token);
          }
          
          showAlert('Registration successful! Please login.', 'success');
          
          // Switch to login tab after successful registration
          setTimeout(() => {
            loginTab.click();
            registerForm.reset();
          }, 1500);
          
        } catch (error) {
          showAlert(error.message);
        } finally {
          setLoading(registerBtn, false);
        }
      });
    });
  </script>
</body>
</html>