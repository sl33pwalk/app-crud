<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @if (isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark')
        <link href="{{ mix('css/dark-theme.css') }}" rel="stylesheet">
    @endif

    <title>Product List</title>
</head>

<body class="bg-emerald-100 font-mono text-center">

    {{-- DARK MODE --}}
    <div class="fixed bottom-4 right-4">
        <button id="dark-mode-toggle"
            class="bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded-lg focus:outline-none focus:ring">
            Toggle Dark Mode
        </button>
    </div>

    <script>
        const darkModeToggle = document.querySelector('#dark-mode-toggle');
        const html = document.querySelector('html');

        // Check if there's a theme preference stored, and apply it
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            html.classList.add(savedTheme);
        }

        darkModeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');

            // Store the selected theme in local storage
            const currentTheme = html.classList.contains('dark') ? 'dark' : '';
            localStorage.setItem('theme', currentTheme);
        });
    </script>
    {{--  --}}

    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-bold text-emerald-500 mb-6">Product List</h1>
        @if (Session::has('success'))
            <div class="bg-green-100 border-l-4 border-emerald-500 text-green-700 p-4 mb-6">
                {!! session('success') !!}
            </div>
        @endif
        <div class="flex mb-6">
            <a href="{{ route('product.create') }}"
                class="bg-emerald-500 hover:bg-emerald-700 text-white py-2 px-4 rounded hover:shadow-md transition duration-300">Add
                Product</a>
        </div>
        <div class="mt-6">
            <table class="w-full border">
                <thead>
                    <tr class="bg-emerald-200">
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Qty</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Edit</th>
                        <th class="px-4 py-2">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="border px-4 py-2">{{ $product->name }}</td>
                            <td class="border px-4 py-2">{{ $product->qty }}</td>
                            <td class="border px-4 py-2">{{ $product->price }}</td>
                            <td class="border px-4 py-2">{{ $product->description }}</td>
                            <td class="border px-4 py-2">
                                <div class="flex justify-center text-center">
                                    <a href="{{ route('product.edit', ['product' => $product]) }}"
                                        class="w-full bg-black hover:bg-emerald-700 text-white py-2 px-4 rounded transition duration-300">Edit</a>
                                </div>
                            </td>
                            <td class="border px-4 py-2">
                                <form method="POST" action="{{ route('product.destroy', ['product' => $product]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full bg-black hover:bg-red-700 text-white py-2 px-4 rounded transition duration-300">Delete</button>
                                </form>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
