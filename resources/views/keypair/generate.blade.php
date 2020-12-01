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
                    You will need it to sign in on new devices.
                    We can't recover your Secret Key for you. If you lose it, you won't be able to sign in to your account.
                </div>
            </div>
        </div>
    </div>

    <script>

        window.sodium = {
            onload: function (sodium) {

                const KEY_BYTES = sodium.crypto_secretbox_KEYBYTES;
                const NONCE_BYTES = sodium.crypto_secretbox_NONCEBYTES;

                // User context (seed stored on the server)
                let context = sodium.randombytes_buf(32);
                console.log('Context: ' + btoa(encryptedPrivateKey));

                // Generate a random secret key
                let secretKey = sodium.randombytes_buf(32);
                let secretKey32 = base32.encode(secretKey).replace(/=/g, '');

                // Show the secret key to the user and wait storage confirmation
                document.getElementById('secret-key').innerHTML = 'This is your secret key: ' + secretKey32;

                // Generate Key Pair
                let keyPair = sodium.crypto_box_keypair();
                console.log('Public Key: ' + btoa(keyPair.publicKey));

                // Encrypt Private Key
                let subKey = sodium.crypto_kdf_derive_from_key(KEY_BYTES, 1, context, secretKey);
                let nonce = sodium.crypto_kdf_derive_from_key(NONCE_BYTES, 2, context, secretKey);
                let encryptedPrivateKey = sodium.crypto_secretbox_easy(keyPair.privateKey, nonce, subKey);
                console.log('Encrypted Private Key: ' + btoa(encryptedPrivateKey));

                while(encryptedPrivateKey == null) {
                    console.log('waiting...');
                }

                // Send the Encrypted Private Key to the server
                let data = {
                    'public': btoa(keyPair.publicKey),
                    'private': btoa(encryptedPrivateKey)
                };
                axios.post('{{ route('keypair.save') }}', data).then(function(response){
                    console.log('Encrypted keypair stored in the server!');
                });
            }
        };
    </script>

</x-app-layout>