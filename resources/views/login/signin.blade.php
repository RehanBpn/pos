@vite('resources/css/app.css')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Sign In</title>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="flex overflow-hidden rounded-xl shadow-2xl w-[850px] h-[500px] bg-white">
        <div class="flex w-1/2 items-center justify-center bg-blue-500">
            <div class="flex h-60 w-60 items-center justify-center rounded-full bg-blue-400">
                <img src="{{ asset('images/user.png') }}" alt="user" class="h-40 w-40 object-center">
            </div>
        </div>
        <div class="flex flex-col justify-center w-1/2 p-16">
            <h1 class="mb-10 text-5xl font-bold text-center">Sign In</h1>
            <form method="POST" action="{{ route('signin') }}" class="flex flex-col gap-5">
                @csrf
                <input type="text" placeholder="new username" name="name" class="rounded-md border border-gray-300 px-4 py-3 outline-none focus:border-blue-400" required>
                <input type="email" placeholder="new email" name="email" class="rounded-md border border-gray-300 px-4 py-3 outline-none focus:border-blue-400" required>
                <div class="relative rounded-md border border-gray-300 px-4 py-3  focus:border-blue-400" x-data="{show : false}">
                    <input :type="show ? 'text' : 'password' " placeholder="password" name="password" class="outline-none">
                    <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-sm" @click="show = !show">
                    <span x-text="show ? 'hide' : 'show'"></span>
                    </button>
                </div>
                <div class="mt-4 flex items-center justify-end gap-4">
                    <a href="{{ route('login.view') }}" class="text-blue-500 hover:underline">Login</a>
                    <button type="submit" class="rounded-full bg-blue-500 px-6 py-2 font-semibold text-white transition duration-200 hover:bg-blue-300">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>