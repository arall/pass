// NodeJS client for testing purposes
const _sodium = require('libsodium-wrappers');
var base32 = require('base32');

(async() => {
    await _sodium.ready;
    const sodium = _sodium;

    // Generate a random secret key
    let rand = sodium.randombytes_buf(32);
    let secretkey = base32.encode(rand).toUpperCase().replace(/=/g, '');
    console.log('Secret key: ' + secretkey);

    // Generate key pair using the secret key as passphrase
    let keypair = sodium.crypto_box_keypair();
    console.log(keypair.publicKey.toString());

    // Encrypt the private key (with key derivation)
    let context = 'private key encryption';
    let key = sodium.crypto_kdf_derive_from_key(128, 1, context, secretkey);
    let nonce = sodium.crypto_kdf_derive_from_key(24, 2, context, secretkey);
    let encrypted = sodium.crypto_secretbox_easy('This is a test string', nonce, key);
    console.log(encrypted.toString());

    // Send the encrypted private key to the server

    // Decrypt the private key (for testing)

    // Create a vault
    let vaultKey = '';
    let vault = {
        'name': 'Test vault',
        'key': vaultKey,
        'items': []
    }

    // Encrypt the vault key with user public key

    // Send the encrypted vault to the server

    // Send the user user encrypted vault key to the server

    // Create an "Item" (json)
    let item = {
        'name': 'Test item',
        'data': {
            'password': 'super-secure-password'
        }
    };

    // Decrypt the vault items with the user private key

    // Add the item to the vault
    vault.items.push(item);

    // Encrypt the vault items with the user public key

    // Send the new vault content to the server

})();