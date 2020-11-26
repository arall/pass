<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Your Secret Key
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Generating your secret key...
                </div>
            </div>
        </div>
    </div>

    <script>

        // Generate a random secret key
        // Show the secret key to the user and wait storage confirmation

        // Generate key pair using the secret key as password
        // Upload the key pairs to the server

        window.sodium = {
            onload: function (sodium) {
                let h = sodium.crypto_generichash(64, sodium.from_string('test'));
                console.log(sodium.to_hex(h));
            }
        };
    </script>

</x-app-layout>