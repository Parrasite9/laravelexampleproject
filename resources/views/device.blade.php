<x-layout>
    <x-slot:heading>
        @if ($device->value < 1)
            <h1>
                You have turned off {{ $device->ip }}
            </h1>
        @else
            <h1>
                You have turned on {{ $device->ip }}
            </h1>
        @endif
    </x-slot:heading>
</x-layout>