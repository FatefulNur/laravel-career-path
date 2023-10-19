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
                <li class="rounded-full px-5 py-2 text-md font-semibold cursor-pointer hover:shadow-lg hover:border-b-2 hover:border-orange-400 @if(request()->path() === "home") {{ "border-b-2 border-orange-400 shadow-lg" }} @endif">
                    <a href="{{ url("/home") }}">Home</a>
                </li>
                <li class="rounded-full px-5 py-2 text-md font-semibold cursor-pointer hover:shadow-lg hover:border-b-2 hover:border-orange-400 @if(request()->path() === "experiences") {{ "border-b-2 border-orange-400 shadow-lg" }} @endif">
                    <a href="{{ url("/experiences") }}">Experiences</a>
                </li>
                <li class="rounded-full px-5 py-2 text-md font-semibold cursor-pointer hover:shadow-lg hover:border-b-2 hover:border-orange-400 @if(request()->path() === "projects") {{ "border-b-2 border-orange-400 shadow-lg" }} @endif">
                    <a href="{{ url("/projects") }}">Projects</a>
                </li>
            </ul>
        </nav>

        <section class="p-5 max-w-5xl mx-auto flex-grow space-y-4">
            <h1 class="mb-2 text-3xl text-gray-800">Experiences: </h1>
            <div class="grid justify-center grid-cols-1 md:grid-cols-2 gap-2">
                @foreach ($experiences as $experience)
                    <div class="p-4 divide-y divide-gray-300 shadow-lg border-l-4 border-orange-600 rounded-lg">
                        <div class="p-2 space-y-3">
                            <h1 class="text-3xl text-gray-800">{{ $experience['company'] }}</h1>
                            <h2 class="text-md text-gray-500">
                                {{ $experience['title'] }}
                                ({{ $experience['duration']['from'] }} - {{ $experience['duration']['to'] }})
                            </h2>
                            <div class="space-x-1">
                                <span class="text-gray-600 font-semibold">For: </span>
                                @foreach ($experience['roles'] as $role)
                                    <span class="px-3 py-1 border border-green-500 rounded-full bg-green-100 text-green-800 text-sm shadow-sm shadow-green-800/60 cursor-default">
                                        {{ ucwords($role) }}
                                    </span>
                                @endforeach
                            </div>
                            <div class="text-sm text-gray-500">
                                <b>Location: </b> {{ $experience['location'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <footer class="p-4 py-8 w-full bg-orange-600 text-white text-center">
            &copy; {{ env("APP_NAME") }} {{ date("Y") }}
        </footer>
    </main>
</body>

</html>
