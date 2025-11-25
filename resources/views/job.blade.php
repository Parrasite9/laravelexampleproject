<x-layout>
    <x-slot:heading>
        Job
    </x-slot:heading>

    <h2>{{ $job['title']}} </h2>
    <p>The {{ $job['title'] }} has a salary of {{ $job['salary'] }} per year.</p>
</x-layout>