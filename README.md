# TMAControl
High Can Fly TMA Controller/Reporter Laravel® 8 Application.

# Limitations
This is a pre-alpha version sort of a technology demonstrator for Ligue de Vol Libre Nord-Pas de Calais-Picardie and DGAC Subdivision de Lille.
Some files are missing for a complete installation:
* All default Laravel 8.x files
* Database initialisation files
* All the files I forgot to manually add to the git repository

# About us
* Me ( Ronan ) I'm a self-employed developper and a paraglider pilot
* We ( High Can Fly ) are a french paragliding club who start the development and the exploitation of a VHF reporter for the TMA Lille 3.1 .

# License
Provided "as is" under MIT license.

# Architecture
Based on client architecture the  system consist basically on a server storing the TMA State and a client broadcasting the TMA State in voice mode over a FM VHF frequency.

## Server
Server module is developped with well known and secured Laravel framework.
Anyone who reach the server can view the public views.
* /tmastatesecuredmessage gives a minimal JSON secured message
* /tmastateview gives a HTML5 response

Associated with that, authenticated users have access  to other routes depending on their roles:
* /tmastatechange (needs the setter role)
* /tmastatechange/list (needs the viewer role)

Changing the state of the TMA is simply adding a line on a table with the current state (active/inactive/system on maintenance).
Viewing list this table on the database.
The different states are uniquely identified with a uuid v4 identifier
```php
     $ids = [
       App\Models\StateMessage {
         id: "1",
         uuid: "a4d651bb-bc98-4e57-ae95-dfa94a415b19",
         message: "TMA active",
       },
       App\Models\StateMessage {
         id: "2",
         uuid: "42917626-92c7-4f16-a5e0-6fab087f42b5",
         message: "TMA inactive",
       },
       App\Models\StateMessage {
         id: "3",
         uuid: "1bebbccc-e29e-4a8c-8834-3cfeae21432d",
         message: "System on maintenance",
       },
     ]
```
For securing the message and giving to the client the ability to check that the message is coming from the authority the message is signed with the private key (RSA) of a X509 certificate. The signature is computed with the standard sha256 signature algorithm.

The secured message is something like:
```json
{"message":"{\"uuid\":\"1bebbccc-e29e-4a8c-8834-3cfeae21432d\",\"timestamp\":\"2021-02-17T17:44:16.000000Z\"}","signature":"02bbb23b24ec76b2190e6cef7f6d645f1b5a3c9dfafd4f9a3513114c967380c7a34ce30eefb0014609d7565364946c9b8401f9c7c9bd3804fdde7b68f19e6a8bc1bfe127a0316973fa92ea3e211dce6ff2d016c7b839a5d5cdf14568b9478d146f08942abe00e2dd4fce73f6d1cda588f9ed9992d8b7788741ecc12cf5600a9a60eaafcba65fc189083858644c6cb510dae41404d8b88f27bbb641e3f3252b9f72937b873048c7a4334819fb3b9061c15334006aaf57ccf74289c6a7428f416dc6401942adb61ef6a8acef32de1589ec82e1df41f7e8c73d56bb1f76baa03e77ca7bc9d5a8926ded488bd16afa3de950411d4710ee6616ebf465d2c935888b324e4efed6afd6c72ce72d7ec118f569ab01a992beedb186d070c6fc27faf6ae38255f18c115d71d159d17c7a338356fb2d8bc202413eebb0c17f608456ec9e46ab3a5346f6c5df2779e94b2c75a67caa93c85675fbe61f915fbd7194e13c87cabf50f6aba0f18b80e3ea4348c70f5fa4d1908e174021deba44e0f180f675fbe4bd94c2c0b099e22e166d53e9e16483633742e8109f01f46b3555f01f807329ec5830916ac298ae8ffcdaade65255feee894c13226352c57538d6bb7e1908089f84b2428d5c0a945cd64a7384b3576e9f6489ac3bb95ba4dd746b22636bff153afb4590c969df26c200fa58dc7a983126c8f8e0fd0739949eff7017c458d3a80b0"}
```
it can be decoded as two javascript variables first is an array:
```javascript
let messsage = {"uuid":"1bebbccc-e29e-4a8c-8834-3cfeae21432d","timestamp":"2021-02-17T17:44:16.000000Z"}
```
second is simply a long string. This is an hexstring reprentation of the binary signature of the message variable.

Given the certificate corresponding to the signing private key a very basic check on Python3 can be done like:
```python
import binascii
from OpenSSL import crypto

certificate = 'pemcertificatestring'
signature = bytes.fromhex(longhexsignature)
server_cert = crypto.load_certificate(crypto.FILETYPE_PEM, certificate)
pubkey = server_cert.get_pubkey()
crypto.verify(server_cert, signature, data, 'sha256')
```
if the signature is wrong it throws an exception otherwise nothing… Well done message is authenticated.

### Installation
* Install Laravel 8 with Jetstream
```bash
composer create-project laravel/laravel TMAControl
cd TMAControl
composer require laravel/jetstream
composer require laravel-lang/lang:~8.0
php artisan jetstream:install livewire --teams
```
* Clone the repository and overwrite the default Laravel files
* Sets the .env
* in .env set three environment variables: 
  * CRYPTO_WEB_PRIV_KEY=/path/to/SERVER_FQDN_privkey.pem
  * CRYPTO_WEB_CERT=/path/to/SERVER_FQDN_cert.pem
  * CRYPTO_WEB_BASE_URL=https://SERVER_FQDN/checkmessage

* Create the DB and migrates it
```bash
php artisan migrate
```
* Manually populate the DB
```php
$user =App\Models\User::create(['name' => 'Ronan Le Meillat', 'email'=>'adhesion@email.club', 'admin'=>Hash::make('aVeryGoodPassword')]);
#create the admin user
$admin_role = App\Models\Role::create(['name' => 'admin']);
$setter_role = App\Models\Role::create(['name' => 'viewer']);
$$viewer_role = App\Models\Role::create(['name' => 'setter']);
#Attach him all the roles
$user->roles()->attach($admin_role);
$user->roles()->attach($setter_role);
$user->roles()->attach($viewer_role);
#optionally may add a standard user
$standard_user =App\Models\User::create(['name' => 'Standard user', 'email'=>'user@email.club', 'admin'=>Hash::make('anotherVeryGoodPassword')]);
#Create the message
App\Models\StateMessage::create(["message"=>"TMA active"])
App\Models\StateMessage::create(["message"=>"TMA inactive"])
App\Models\StateMessage::create(["message"=>"System on maintenance"])
App\Models\StateMessage::all();
#Note the uuid for customizing the clients
#Set the first state
App\Models\StateChange::create(["user_id"=>1,"message_id"=>1])
```

### Funny check
On the server on the tmastateview users can scan a QR code representing a URL with https://SERVER_FQDN/checkmessage?message=XXXX&signature=YYYYYY
The server checks the signature and answer OK or NOK with its internal cerificate

## Python3 tiny Client
See https://github.com/eltorio/TMAControl-Client

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
