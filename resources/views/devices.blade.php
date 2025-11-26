<x-layout>
    <x-slot:heading>
        Device List
    </x-slot:heading>

    @foreach ($devices as $device )
        <div class="flex justify-around mb-4">
            <div class="deviceContainer">
                <div>DEVICE NAME: {{ $device->ip }} </div>
            </div>

            <div class="powerContainer">
                @if ($device->value < 1)
                    <button class="bg-red-400" onClick="turnOnRelay('{{ $device->ip }}')">OFF</button>
                @else
                    <button class="bg-green-400" onClick="turnOffRelay('{{ $device->ip }}')">ON</button>
                @endif
            </div>
        </div>
        <span class="border-solid border-2 border-blue-400 w-full"></span>

    @endforeach


    <script>
        function turnOnRelay(ip) {
            fetch(`/relay/${ip}/1`)
            .then(response => response.text())
            .then(data => {
                console.log(data);
                location.reload()
            })
        }

        function turnOffRelay(ip) {
             fetch(`/relay/${ip}/0`)
             .then(response => response.text())
             .then(data => {
                console.log(data);
                location.reload();
             })
        }
    </script>
</x-layout>