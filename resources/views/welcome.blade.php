<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="min-h-screen bg-green-900 flex items-center justify-center">

  <!-- Main Container -->
  <div class="w-full max-w-6xl bg-white rounded-2xl overflow-hidden shadow-2xl grid md:grid-cols-2">

    <!-- Left Section -->
    <div class="bg-green-50 p-10 flex flex-col justify-between relative">

      <!-- Logo -->
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-green-700 rounded-full flex text-3xl items-center justify-center text-white font-bold">
          t
        </div>
        <span class="text-green-800 font-semibold">
            {{-- chat system title --}}
          talk
        </span>
      </div>

      <!-- Illustration Placeholder -->
      <div class="flex justify-center items-center my-10">
        <img src="https://i.pinimg.com/1200x/7c/03/77/7c03777d88ee2dffef97e812961c7b3d.jpg" alt="" class="rounded-full">
      </div>

      <!-- Footer -->
      <p class="text-xs text-green-700">
        © 2025 Anjali Corporation<br>
        Powered by Deshar
      </p>
    </div>

    <!-- Right Section (Login Form) -->
    <div class="bg-green-800 p-10 flex items-center">
      <div class="w-full max-w-sm mx-auto text-white">

        <h2 class="text-3xl font-bold mb-8">Login</h2>

        <!-- Username -->
        <div class="mb-5">
          <label class="block mb-2 text-sm">Username</label>
          <input
            type="text"
            placeholder="Enter your username"
            class="w-full px-4 py-3 rounded-full bg-green-700 text-white placeholder-green-300
                   focus:outline-none focus:ring-2 focus:ring-green-300
                   transition duration-300 hover:bg-green-600"
          />
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label class="block mb-2 text-sm">Password</label>
          <input
            type="password"
            placeholder="Enter your password"
            class="w-full px-4 py-3 rounded-full bg-green-700 text-white placeholder-green-300
                   focus:outline-none focus:ring-2 focus:ring-green-300
                   transition duration-300 hover:bg-green-600"
          />
        </div>

        <!-- Forgot Password -->
        <div class="text-right mb-6">
          <a href="{{Route('password.request')}}" class="text-sm text-green-300 hover:text-white transition">
            Forgot Password?
          </a>
        </div>

        <!-- Login Button -->
        <button
          class="w-full py-3 rounded-full bg-teal-400 text-green-900 font-semibold
                 hover:bg-teal-300 hover:shadow-lg hover:scale-[1.02]
                 active:scale-95 transition duration-300"
        >
          Login
        </button>

        <!-- Register of there is no account-->
        <p class="text-center text-sm mt-6">
          Don’t have an account?
          <a href="{{route('register')}}" class="text-teal-300 hover:text-white font-medium transition">
            Register Now
          </a>
        </p>

        <!-- Terms and services -->
        <p class="text-center text-xs text-green-300 mt-8">
          <a href="#" class="hover:underline">Terms and Services</a>
        </p>

        <!-- Help section-->
        <p class="text-center text-xs text-green-300 mt-2">
          Have a problem? Contact us at
          <a href="#" class="hover:underline">anjalideshar748@gmail.com</a>
        </p>

      </div>
    </div>

  </div>

</body>
</html>
