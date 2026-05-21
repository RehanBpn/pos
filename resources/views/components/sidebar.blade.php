@vite('resources/css/app.css')

<div class="relative flex border w-full max-w-[20rem] flex-col bg-white p-4 text-gray-700 shadow">

    <div class="p-4 mb-2">
        <h5 class="text-5xl font-semibold">
            Dashboard
        </h5>
    </div>

    <nav class="flex h-full flex-col gap-1 p-2 text-base">

        {{-- Dashboard --}}
        <div class="flex items-center w-full p-3 rounded-lg hover:bg-gray-100">
            <div class="grid mr-4 place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24"
                     fill="currentColor"
                     class="w-10 h-10">
                    <path fill-rule="evenodd"
                        d="M2.25 2.25a.75.75 0 000 1.5H3v10.5a3 3 0 003 3h1.21l-1.172 3.513a.75.75 0 001.424.474l.329-.987h8.418l.33.987a.75.75 0 001.422-.474l-1.17-3.513H18a3 3 0 003-3V3.75h.75a.75.75 0 000-1.5H2.25z"
                        clip-rule="evenodd" />
                </svg>
            </div>

            <a href="{{ route('home') }}"
               class="text-3xl hover:text-gray-400">
                Dashboard
            </a>
        </div>

        {{-- Shop --}}
        <div class="flex items-center w-full p-3 rounded-lg hover:bg-gray-100">

            <div class="grid mr-4 place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24"
                     fill="currentColor"
                     class="w-10 h-10">
                    <path fill-rule="evenodd"
                        d="M7.5 6v.75H5.513..."
                        clip-rule="evenodd" />
                </svg>
            </div>

            <a href="{{ route('shop.index') }}"
               class="text-3xl hover:text-gray-400">
                E-Commerce
            </a>

        </div>

        {{-- Produk --}}
        <div class="flex items-center w-full p-3 rounded-lg hover:bg-gray-100">

            <div class="grid mr-4 place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24"
                     fill="currentColor"
                     class="w-10 h-10">
                    <path fill-rule="evenodd"
                        d="M6.912 3..."
                        clip-rule="evenodd" />
                </svg>
            </div>

            <a href="{{ route('barang.index') }}"
               class="text-3xl hover:text-gray-400">
                Produk
            </a>

        </div>

        {{-- Profile --}}
        <div class="flex items-center w-full p-3 rounded-lg hover:bg-gray-100">

            <div class="grid mr-4 place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24"
                     fill="currentColor"
                     class="w-10 h-10">
                    <path fill-rule="evenodd"
                        d="M18.685 19.097..."
                        clip-rule="evenodd" />
                </svg>
            </div>

            <a href="#"
               class="text-3xl hover:text-gray-400">
                Profile
            </a>

        </div>

        {{-- Settings --}}
        <div class="flex items-center w-full p-3 rounded-lg hover:bg-gray-100">

            <div class="grid mr-4 place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24"
                     fill="currentColor"
                     class="w-10 h-10">
                    <path fill-rule="evenodd"
                        d="M11.078 2.25..."
                        clip-rule="evenodd" />
                </svg>
            </div>

            <a href="#"
               class="text-3xl hover:text-gray-400">
                Settings
            </a>

        </div>

        {{-- Logout --}}
        @auth

        <div class="flex items-center w-full p-3 rounded-lg hover:bg-gray-100">

            <div class="grid mr-4 place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24"
                     fill="currentColor"
                     class="w-10 h-10">
                    <path fill-rule="evenodd"
                        d="M12 2.25..."
                        clip-rule="evenodd" />
                </svg>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="text-3xl hover:text-gray-400">
                    Logout
                </button>
            </form>

        </div>

        <p class="mt-4 text-sm text-gray-500">
            Login sebagai:
            {{ Auth::user()->email }}
        </p>

        @endauth

    </nav>

</div>