<x-layout>
    <x-slot:heading>
        Device List
    </x-slot:heading>

    @foreach ($devices as $device )
        <div class="flex justify-around mb-4">
            <div class="deviceContainer">
                <div>DEVICE NAME: {{ $device->ip }} </div>
            </div>

            <div class="powerContainer flex">
                <div class="onOffButton">
                    @if ($device->value < 1)
                        <button class="bg-red-400 px-4 hover:bg-red-200" onClick="turnOnRelay('{{ $device->id }}')">OFF</button>
                    @else
                        <button class="bg-green-400 px-4 hover:bg-red-200" onClick="turnOffRelay('{{ $device->id }}')">ON</button>
                    @endif
                </div>

                <div class="detailsButton ml-4">
                    <a href="/relay/{{ $device->id }}/details">
                        <button class="bg-gray-700 text-white hover:bg-gray-400 px-4">See Details</button>
                    </a>
                </div>

            </div>
        </div>
        <span class="border-solid border-2 border-blue-400 w-full"></span>

    @endforeach


    <script>
        function turnOnRelay(id) {
            fetch(`/relay/${id}/1`)
            .then(response => response.text())
            .then(data => {
                console.log(data);
                location.reload()
            })
        }

        function turnOffRelay(id) {
             fetch(`/relay/${id}/0`)
             .then(response => response.text())
             .then(data => {
                console.log(data);
                location.reload();
             })
        }
    </script>
</x-layout>