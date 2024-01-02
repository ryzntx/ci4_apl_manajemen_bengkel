# CodeIgniter 4 | Apl Manajemen Bengkel

## Installasi

* Download / clone repository ini
``````
git clone https://github.com/ryzntx/ci4_apl_manajemen_bengkel.git
``````
* jalankan perintah pada terminal
  ``````
  composer install
  ``````
* Buat database baru dengan nama "db_bengkel" atau yang lain
* rename file env menjadi .env
* buka file .env dan sesuaikan pada bagian
    ``````
    database.default.hostname = localhost
    database.default.database = db_bengkel
    database.default.username = root
    database.default.password = 
    ``````
* jalankan perintah pada terminal
  ``````
  php spark migrate -all
  ``````
* jalankan server dengan perintah 
  ``````
  php spark serve
  ``````



