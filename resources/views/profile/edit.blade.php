<x-default-page>
    <div class="h-full flex flex-col overflow-y-auto bg-[#f8fafc]">
        
        <!-- Main Content -->
        <div class="max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-16 relative">
            
            <!-- Sleek Header -->
            <div class="mb-10 animate-fade-in-up">
                <div class="flex items-center gap-4 mb-3">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-500 to-emerald-500 flex items-center justify-center text-white shadow-lg shadow-teal-200">
                        <i class="fas fa-user-edit text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-semibold text-gray-900 tracking-tight">Profile Settings</h1>
                        <p class="text-gray-500 font-medium mt-1">
                            Manage your account details.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Sidebar: Profile Summary -->
                <div class="space-y-6">
                    <div class="bg-white rounded-[2rem] shadow-sm border border-teal-100/60 overflow-hidden hover:shadow-md transition-all duration-300">
                        <div class="p-8 flex flex-col items-center bg-gradient-to-b from-teal-50/50 to-white relative">
                            <!-- Background Pattern -->
                            <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#14b8a6 1px, transparent 1px); background-size: 20px 20px;"></div>
                            
                            <div class="relative w-36 h-36 mb-6 group cursor-pointer inline-block z-10">
                                <div class="absolute inset-0 bg-gradient-to-br from-teal-400 to-emerald-500 rounded-full blur-md opacity-20 group-hover:opacity-40 transition-opacity duration-300"></div>
                                @if(auth()->user()->profile_photo_url)
                                    <img src="{{ auth()->user()->profile_photo_url }}" class="w-full h-full rounded-full object-cover shadow-lg border-4 border-white relative z-10 transition-transform duration-300 group-hover:scale-105" alt="">
                                @else
                                    <div class="w-full h-full rounded-full bg-gradient-to-br from-teal-500 to-emerald-600 flex items-center justify-center text-white font-bold text-6xl shadow-lg border-4 border-white relative z-10 transition-transform duration-300 group-hover:scale-105">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="absolute bottom-1 right-2 w-10 h-10 bg-teal-500 text-white rounded-full flex items-center justify-center border-4 border-white shadow-md hover:bg-teal-600 hover:scale-110 transition-all z-20">
                                    <i class="fas fa-camera text-sm"></i>
                                </div>
                            </div>
                            
                            <h2 class="text-xl font-semibold text-gray-900 text-center tracking-tight mb-1 relative z-10">{{ auth()->user()->name }}</h2>
                            <p class="text-sm text-gray-500 font-medium mb-5 relative z-10">{{ auth()->user()->email }}</p>
                            
                            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-100 shadow-sm relative z-10">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse ring-4 ring-emerald-100"></span> Online Now
                            </span>
                        </div>
                        <div class="bg-gray-50/80 px-8 py-5 border-t border-gray-100 flex justify-between items-center">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Member Since</span>
                            <span class="text-sm font-semibold text-gray-700">{{ auth()->user()->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Forms -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Update Profile Information Form -->
                    <div class="bg-white rounded-[2rem] shadow-sm border border-teal-100/60 p-8 sm:p-10 relative overflow-hidden transition-all duration-300 hover:shadow-md hover:border-teal-200 group">
                        <div class="absolute top-0 right-0 w-48 h-48 bg-gradient-to-bl from-teal-50/80 to-transparent rounded-bl-[4rem] -mr-16 -mt-16 z-0 opacity-0 group-hover:opacity-100 transition-all duration-500 hidden sm:block"></div>
                        <div class="relative z-10 max-w-xl form-container">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Update Password Form -->
                    <div class="bg-white rounded-[2rem] shadow-sm border border-teal-100/60 p-8 sm:p-10 transition-all duration-300 hover:shadow-md hover:border-teal-200 group overflow-hidden relative">
                        <div class="absolute top-0 right-0 w-48 h-48 bg-gradient-to-bl from-sky-50/80 to-transparent rounded-bl-[4rem] -mr-16 -mt-16 z-0 opacity-0 group-hover:opacity-100 transition-all duration-500 hidden sm:block"></div>
                        <div class="relative z-10 max-w-xl form-container">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Delete User Form -->
                    <div class="bg-gradient-to-br from-white to-red-50/30 rounded-[2rem] shadow-sm border border-red-50 p-8 sm:p-10 transition-all duration-300 hover:shadow-md hover:border-red-200 group overflow-hidden relative">
                        <div class="absolute top-0 right-0 w-48 h-48 bg-gradient-to-bl from-red-50/80 to-transparent rounded-bl-[4rem] -mr-16 -mt-16 z-0 opacity-0 group-hover:opacity-100 transition-all duration-500 hidden sm:block"></div>
                        <div class="relative z-10 max-w-xl form-container">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Premium Typography for Form Partial Headers */
        .form-container section header h2 {
            font-size: 1.25rem !important;
            font-weight: 600 !important;
            color: #0f172a !important;
            letter-spacing: -0.025em;
            margin-bottom: 0.25rem;
        }
        .form-container section header p {
            color: #64748b !important;
            font-size: 0.95rem !important;
            line-height: 1.5;
        }
        
        /* Smooth Input Focus State */
        .form-container input[type="text"], 
        .form-container input[type="email"], 
        .form-container input[type="password"] {
            transition: all 0.2s ease-in-out;
            background-color: #f8fafc;
        }
        .form-container input[type="text"]:focus, 
        .form-container input[type="email"]:focus, 
        .form-container input[type="password"]:focus {
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.15) !important;
            border-color: #14b8a6 !important;
        }
    </style>
</x-default-page>
