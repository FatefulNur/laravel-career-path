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

        <section class="p-5 max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 space-y-6">
            <div class="p-0 md:p-5">
                <h1 class="mb-2 text-3xl text-gray-800">Educations: </h1>
                <div class="space-y-2">
                    @foreach ($profile["educations"] as $education)
                        <div class="p-4 divide-y divide-gray-300 max-w-full md:max-w-sm shadow-lg border-l-4 border-orange-600 rounded-lg">
                            <div class="p-2 flex justify-between">
                                <b>Institution:</b>
                                <span class="text-md text-gray-500">{{ $education["institution"] }}</span>
                            </div>
                            <div class="p-2 flex justify-between">
                                <b>Duration: </b>
                                <span class="text-md text-gray-500">{{ $education["duration"]["from"] }} - {{ $education["duration"]["to"] }}</span>
                            </div>
                            <div class="p-2 flex justify-between">
                                <b>Degree</b>
                                <span class="text-md text-gray-500">{{ $education["degree"] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="p-0 md:p-5 text-center flex flex-col items-center space-y-4">
                <div class="text-2xl">
                    I'm <span class="text-orange-600">{{ $profile["name"] }}</span>.
                </div>
                <div class="text-2xl text-">
                    <span class="text-orange-600 font-semibold">
                        {{ Carbon\Carbon::create($profile["dob"])->diffInYears() }}
                    </span> Years Old.
                </div>
                <div class="text-6xl text-gray-800">
                    {{ $profile["title"] }}
                </div>
                <p class="text-md text-gray-500 leading-tight">
                    {{ $profile["bio"] }}
                </p>
                <div class="flex items-center justify-center gap-1">
                    <span class="text-xl font-semibold text-slate-500">Skills: </span>
                    @foreach ($profile["skills"] as $skill)
                        <span class="px-3 py-1 border border-green-500 rounded-full bg-green-100 text-green-800 text-sm shadow-sm shadow-green-800/60 cursor-default">
                            {{ ucwords($skill) }}
                        </span>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="p-0 md:p-5 max-w-5xl mx-auto flex flex-col md:flex-row justify-center gap-2">
            @foreach ($profile["contacts"] as $label => $contact)
                <div class="p-4 flex-1 rounded-lg">
                    <h1 class="pb-2 mb-2 text-xl text-gray-800 border-b-2 border-orange-500">{{ strtoupper($label) }}</h1>
                    @unless ($label === "address")
                        <p class="text-md text-gray-500">{{ $contact }}</p>
                    @else
                    <div class="divide-y divide-gray-300">
                        <div class="p-2 flex justify-between">
                            <b>Country:</b>
                            <span class="text-md text-gray-500">{{ $contact["country"] }}</span>
                        </div>
                        <div class="p-2 flex justify-between">
                            <b>State: </b>
                            <span class="text-md text-gray-500">{{ $contact["state"] }}</span>
                        </div>
                        <div class="p-2 flex justify-between">
                            <b>Street</b>
                            <span class="text-md text-gray-500">{{ $contact["street"] }}</span>
                        </div>
                    </div>
                    @endunless
                </div>
            @endforeach
        </section>

        <footer class="p-4 py-8 w-full bg-orange-600 text-white text-center">
            &copy; {{ env("APP_NAME") }} {{ date("Y") }}
        </footer>
    </main>
</body>

</html>
