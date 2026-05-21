@vite('resources/css/app.css')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Login</title>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="flex overflow-hidden rounded-xl shadow-2xl w-[850px] h-[500px] bg-white">
        <div class="flex flex-col justify-center w-1/2 p-16">
            <h1 class="mb-10 text-5xl font-bold text-center">Login</h1>
            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
                @csrf
                <input type="email" placeholder="email" name="email" class="rounded-md border border-gray-300 px-4 py-3 outline-none focus:border-blue-400" required>
                <div class="relative rounded-md border border-gray-300 px-4 py-3  focus:border-blue-400" x-data="{show : false}">
                    <input :type="show ? 'text' : 'password' " placeholder="password" name="password" class="outline-none">
                    <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-sm" @click="show = !show">
                    <span x-text="show ? 'hide' : 'show'"></span>
                    </button>
                </div>
                <div class="mt-4 flex items-center justify-end gap-4">
                    <a href="" class="text-blue hover:underline">Sign in</a>
                    <button type="submit" class="rounded-full bg-blue-500 px-6 py-2 font-semibold text-white transition duration-200 hover:bg-blue-300">Login</button>
                </div>
            </form>
            {{-- Error message --}}
            @error('email')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
            @error('password')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex w-1/2 items-center justify-center bg-blue-500">
            <div class="flex h-60 w-60 items-center justify-center rounded-full bg-blue-400">
                <img src="" alt="" class="h-40 w-40 object-center">
            </div>
        </div>
    </div>
</body>
</html>