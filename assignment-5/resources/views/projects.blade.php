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

        <section class="p-5 max-w-5xl mx-auto space-y-4">
            <h1 class="mb-2 text-3xl text-gray-800">Projects: </h1>
            <div class="flex flex-wrap justify-center gap-4">
                @foreach ($projects as $project)
                    <a href="{{ url('/project', ['projectId' => $project['id']]) }}"
                     class="p-2 max-w-xs grow w-72 h-72 bg-orange-400 rounded-lg">
                        <div class="h-full overflow-hidden">
                            <img class="block w-full h-full object-cover rounded-lg hover:scale-105 duration-200" src="{{ $project["screenshot"] }}" alt="{{ $project["name"] }}">
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <footer class="p-4 py-8 w-full bg-orange-600 text-white text-center">
            &copy; {{ env("APP_NAME") }} {{ date("Y") }}
        </footer>
    </main>
</body>

</html>
