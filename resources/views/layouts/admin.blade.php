<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - ShopEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Admin Navigation -->
    <nav class="bg-gray-800 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Left Side: Logo & Menu -->
                <div class="flex items-center space-x-8">
                    <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold hover:text-gray-300">
                        🛒 ShopEase Admin
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="hover:bg-gray-700 px-3 py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                        📊 Dashboard
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="hover:bg-gray-700 px-3 py-2 rounded {{ request()->routeIs('admin.products.*') ? 'bg-gray-700' : '' }}">
                        📦 Manage Products
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="hover:text-gray-300">Orders</a>
                </div>

                <!-- Right Side: User Info & Actions -->
                <div class="flex items-center space-x-4">
                    <span class="text-gray-300">👤 {{ Auth::user()->name }}</span>
                    <a href="/" target="_blank" class="hover:bg-gray-700 px-3 py-2 rounded">
                        🌐 View Site
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded font-semibold">
                            🚪 Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Success Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded shadow">
                <p class="font-semibold">✅ Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Error Messages -->
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded shadow">
                <p class="font-semibold">❌ Error!</p>
                <p>{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded shadow">
                <p class="font-semibold">⚠️ Please fix the following errors:</p>
                <ul class="list-disc list-inside mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-12">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-gray-600">
            <p>ShopEase Admin Panel © {{ date('Y') }}</p>
        </div>
    </footer>
</body>
</html>