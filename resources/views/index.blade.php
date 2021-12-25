<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Chamada IPVG</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="flex flex-col h-screen justify-between">
        <header class="mb-10">
            <nav>
                <div class="border shadow-lg border-gray-300">
                    <div class="py-4 flex justify-between items-center mx-auto max-w-6xl">
                        <div class="">
                            <p class="">EBD IPVG</p>
                            <p class="mt-2">Jovens</p>
                        </div>

                        <div class="space-x-8">
                            <a href="#" class="">Link 1</a>
                            <a href="#" class="">Link 2</a>
                            <a href="#" class="">Link 3</a>
                        </div>

                        <div class="flex items-center">

                            <div class="shrink-0">
                                <img class="rounded-full" src="https://i.pravatar.cc/50" alt="avatar">
                            </div>

                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="text-xs ml-4">Sair</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main class="mb-auto">
            <div>
                <h2 class="text-center font-bold text-lg">Lista de alunos da sala Jovens</h2>
            </div>

            <div class="max-w-4xl border border-gray-300 mx-auto mt-8 p-4">

                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-green-100">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                nome
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                idade
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://i.pravatar.cc/50" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        Antonio Orlando
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">35</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                              Ativo
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Detalhes</a>
                                        </td>
                                    </tr>

                                    <!-- More people... -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <footer class="">
            <div class="bg-gray-300 flex">
                <div class="py-6 flex items-center max-w-6xl mx-auto">
                    <div>
                        <span class="text-sm text-gray-700">Desenvolvido por <a href="https://twitter.com/_orlandokun" target="_blank">Orlando</a></span>
                    </div>
                </div>
            </div>
        </footer>
    </body>

</html>
