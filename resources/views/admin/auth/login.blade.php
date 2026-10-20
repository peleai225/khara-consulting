<!DOCTYPE html>
<html lang="fr" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion - Admin Khara Consulting</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style> body { font-family: 'Manrope', sans-serif; } </style>
</head>
<body class="bg-khara-gray-100 text-khara-slate antialiased">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <div class="flex justify-center mb-6">
                    <div class="size-16 rounded-full bg-khara-red flex items-center justify-center text-white">
                        <span class="material-symbols-outlined text-3xl">corporate_fare</span>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-khara-slate mb-2">Administration</h2>
                <p class="text-khara-gray-500 text-sm">Khara Consulting - Admin Panel</p>
            </div>

            <div class="bg-white p-8 rounded-xl border border-khara-gray-200 shadow-sm">
                <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    @if($errors->any())
                        <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-red-600">error</span>
                                <div>
                                    <p class="text-red-800 font-semibold mb-1">Erreur de connexion</p>
                                    <ul class="list-disc list-inside text-red-700 text-sm space-y-1">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div>
                        <label for="email" class="block text-sm font-bold text-khara-gray-700 mb-2">Adresse email</label>
                        <input type="email" id="email" name="email" required autofocus value="{{ old('email') }}"
                            class="admin-input @error('email') border-red-500 @enderror"
                            placeholder="admin@khara-consulting.com">
                        @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-bold text-khara-gray-700 mb-2">Mot de passe</label>
                        <input type="password" id="password" name="password" required
                            class="admin-input @error('password') border-red-500 @enderror"
                            placeholder="••••••••">
                        @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="rounded text-khara-red focus:ring-khara-red border-khara-gray-300">
                            <span class="text-sm text-khara-gray-600">Se souvenir de moi</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-4 bg-khara-red text-white font-bold rounded-lg hover:bg-khara-red-dark transition-colors shadow-lg shadow-khara-red/20">
                        Se connecter
                        <span class="material-symbols-outlined text-xl">login</span>
                    </button>
                </form>
            </div>

            <div class="text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-khara-gray-500 hover:text-khara-red text-sm transition-colors">
                    <span class="material-symbols-outlined text-lg">arrow_back</span>
                    Retour au site
                </a>
            </div>
        </div>
    </div>
</body>
</html>
