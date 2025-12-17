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
      {{ $slot }}
    </div>

  </div>

</body>
</html>
