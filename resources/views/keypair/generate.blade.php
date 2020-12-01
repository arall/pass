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
                    <div id="secret-key">
                        Generating your secret key...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.sodium = {
            onload: function (sodium) {
                console.log('test');
                // Generate a random secret key
                var rand = sodium.randombytes_buf(32);
                key = base32.encode(rand).replace(/=/g, '');
                console.log(key);

                // Show the secret key to the user and wait storage confirmation
                document.getElementById('secret-key').innerHTML = 'This is your secret key: ' + key;

                // Generate key pair using the secret key as passphrase


                
                // Upload the key pairs to the server
            }
        };
    </script>

</x-app-layout>