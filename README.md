A password manager for teams build with Laravel.

## User authentication
https://laravel.com/docs/8.x/sanctum#spa-authentication

# Security
All the encryption and key generation happens in the client side. The server will NOT store any **vault keys**, neither user **secret keys**.

For a practical proof of concept, check `client-poc/test.js`.

# Flow
## Registration
The registration requires an email address and a **login password** (`POST /register`).
Both will be stored in the server and will be used to authenticate the user (**login password** will be stored hashed as bcrypt).

### Initial account setup
Then, on the client side, Also, a **secret key** will be randomly generated and the user will be asked to store it safely.
That **secret key** will never be sent to the server. 
Using that **secret key** as a passphrase, a key pair (**private key** and **public key**) will be generated (also on the client side).
The **private key** will be encrypted (with key derivation) with the **secret key**.
The **private key** and the **encrypted private key** (as well as the context used for encrypting the private key) will be send to the server (`POST /keys`).

## Login
An email, a device ID and a **login password** will be send to the server, in order to authenticate the user (`POST /login`).
If the authentication succeed:
If the Device ID is new:
The server will store that Device ID and assign an **authentication token**, that will be used as authentication for further requests.
If the Device ID is not new:
The server will respond with the **authentication token** for that Device Id.

The server will return the **public key** and the **encrypted private key** of that user (`GET /keys`).
The client will try to decrypt the **encrypted private key**, in order to locally verify that the **secret key** is valid.
(Optional: the client could send a signed message to the server, using the user decrypted **private key**, as a proof of success decryption of the **private key**)

## Retriving secrets (TODO)
The client will retrieve the **encrypted secrets** from the server (`GET /secrets`).
The client will decrypt the **encrypted secrets** using the **private key**.

## Storing secrets (TODO)
The client will encrypt the secret using the **public key**.
The client will send the **encrpted secret** to the server (`POST /secrets`).

## Vaults
TODO

## Sharing secrets
TODO

# White Paper
All the encryption and key generation happens in the client side. The server will NOT store any vault keys, neither user secret keys.

Once a user registers, we will ask to create a master password. That password will be used for login in and authenticate with the server, as well as for decrypting local browser data (HTML5 Web Storage).

Also, a secret key will be randomly generated (on the client side) and the user will be asked to store it safely. That secret key will never be sent to the server. Using that secret key as a passphrase, a key pair (private and public key) will be generated (also on the client side), and stored in the server. The public key will be used by the server for encrypting the data, and the private key (together with the secret key) will be used by the client, to decrypt it.

The client will store the private key and the master key, encrypted by the user master password. Once the user sign in from a new session, the server will provide the private key.

When a vault is created, a vault key is randomly generated and encrypted with each users public keys that has access to the vault (again on client side). The users will receive the vault password (encrypted with their public key) on their next sync, and they will be able to decrypt and encrypt the vault content with their private key. Again, the server will never store any vault key.

When a new user is added into a vault, the vault key will be obtained from the user who provided access to that vault. Its own client will decrypt the vault key, encrypt it using the user public key, and transfer it to the server. If there is no user with access to a vault, the vault key will not be able to be recovered anymore.

# ToDo / Improvements
* Consider encrypting keys in DB with Laravel encryption.
* Vaults & Sharing.
