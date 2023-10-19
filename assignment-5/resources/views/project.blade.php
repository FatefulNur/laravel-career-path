<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <main class="max-w-screen-xl flex flex-col h-screen m-auto space-y-6">
        <nav class="px-6 py-2 h-16 flex justify-between items-center shadow-lg border-b-2 border-orange-600">
            <div class="font-mono text-2xl text-orange-600 font-semibold italic">
                FOLIO
            </div>
            <ul class="flex items-center h-full text-orange-600 divide-x divide-orange-400">
                <li class="rounded-full px-5 py-2 text-md font-semibold cursor-pointer hover:shadow-lg hover:border-b-2 hover:border-orange-400 @if(request()->path() === "home") {{ "border-b-2 border-orange-400" }} @endif">
                    <a href="{{ url("/home") }}">Home</a>
                </li>
                <li class="rounded-full px-5 py-2 text-md font-semibold cursor-pointer hover:shadow-lg hover:border-b-2 hover:border-orange-400 @if(request()->path() === "experiences") {{ "border-b-2 border-orange-400" }} @endif">
                    <a href="{{ url("/experiences") }}">Experiences</a>
                </li>
                <li class="rounded-full px-5 py-2 text-md font-semibold cursor-pointer hover:shadow-lg hover:border-b-2 hover:border-orange-400 @if(request()->path() === "projects") {{ "border-b-2 border-orange-400" }} @endif">
                    <a href="{{ url("/projects") }}">Projects</a>
                </li>
            </ul>
        </nav>

        <section class="p-5 w-5/6 mx-auto flex-grow">
            <div class="max-w-screen-sm mx-auto space-y-5">
                <img class="block w-full h-full object-cover rounded-lg " src="{{ $project["screenshot"] }}" alt="{{ $project["name"] }}">

                <h1 class="text-3xl text-gray-800 text-left">
                    {{ $project["name"] }}
                    <span class="px-3 py-1 border border-green-500 rounded-full bg-green-100 text-green-800 text-sm shadow-sm shadow-green-800/60 cursor-default">
                        {{ $project["language"] }}
                    </span>
                </h1>
                <p class="text-md text-gray-400">
                    {{ $project["description"] }}
                </p>

                <a href="{{ $project['source'] }}" target="_blank" class="inline-block rounded-full p-2 px-4 bg-orange-600 font-semibold text-md text-white shadow-sm hover:text-orange-600 hover:bg-white hover:ring-2 hover:ring-orange-600">Get Source</a>
            </div>
        </section>

        <footer class="p-4 py-8 w-full bg-orange-600 text-white text-center">
            &copy; {{ env("APP_NAME") }} {{ date("Y") }}
        </footer>

    </main>
</body>

</html>
