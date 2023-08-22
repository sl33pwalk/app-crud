<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Product</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @if (isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark')
        <link href="{{ mix('css/dark-theme.css') }}" rel="stylesheet">
    @endif
    @vite('resources/css/app.css')
</head>

<body class="bg-emerald-100 text-center">

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
        <h1 class="text-4xl font-bold text-emerald-500 mb-6">Create a Product</h1>
        <div class="mb-4">
            @if ($errors->any())
                <ul class="text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <form method="POST" action="{{ route('product.store') }}">
            @csrf
            @method('POST')
            <div class="mb-4">
                <label class="block font-semibold" for="name">Name</label>
                <input class="border rounded py-2 px-3 w-full" type="text" name="name" placeholder="Name" />
            </div>

            <div class="mb-4">
                <label class="block font-semibold" for="qty">Qty</label>
                <input class="border rounded py-2 px-3 w-full" type="text" name="qty" placeholder="Qty" />
            </div>

            <div class="mb-4">
                <label class="block font-semibold" for="price">Price</label>
                <input class="border rounded py-2 px-3 w-full" type="text" name="price" placeholder="Price" />
            </div>

            <div class="mb-4">
                <label class="block font-semibold" for="description">Description</label>
                <input class="border rounded py-2 px-3 w-full" type="text" name="description"
                    placeholder="Description" />
            </div>

            <div>
                <button
                    class="bg-emerald-500 hover:bg-emerald-700 text-white py-2 px-4 rounded transition duration-300 mt-4 flex justify-start space-x-4"
                    type="submit">Save a New Product</button>
            </div>
        </form>

        <form action="{{ route('product.index') }}">
            <div class="mt-4 flex justify-start space-x-4">
                <!-- Используем flex и space-x для выравнивания и отступов между элементами -->
                <input class=" bg-black hover:bg-red-600 text-white py-2 px-4 rounded transition duration-300"
                    type="submit" value="Go back" />
            </div>
        </form>
    </div>
</body>

</html>
