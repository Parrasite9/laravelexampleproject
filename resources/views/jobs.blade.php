<x-layout>
    <x-slot:heading>
        Job Listings
    </x-slot:heading>
    <h1>This is the About page</h1>
    @foreach ($jobs as $job)

        <li>
            <a class="text-blue-700 underline" href="/jobs/{{ $job['id'] }}">
                <strong>{{ $job['title'] }}:</strong> Pays {{ $job['salary'] }} per year
            </a>
        </li>

    @endforeach
</x-layout>