<x-layout>
    <x-slot:heading>
        Details Page
    </x-slot:heading>
    <h1>Device IP: {{ $device->ip }} </h1>

    <form method="POST" action="/relay/{{ $device->id }}/details">
        @csrf

        <div class="mb-4">
            <label for="value">Device IP:</label>
            <input type="text" name="ip" value="{{ $device->ip }}" class="border p-2">
        </div>

        <div class="button__container flex">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Save</button>
            <a href="/relay">
                <button type="button" class="bg-red-500 text-white px-4 py-2">Return to Relays</button>
            </a>
        </div>
    </form>
</x-layout>