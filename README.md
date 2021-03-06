# PHPMovies

Miloš Stojanović - milosh.stoyanovic@gmail.com

### Testiranje sa pokretanjem servera
S obzirom da kreiranje korisnika i filmova nije spomenuto kao deo funkcionalnosti, ukoliko se testira dizanjem servera mora prvo da se uradi seed:

```
php artisan db:seed
php artisan serve
```

U tom slučaju API može da se poziva putem korisnika sa poznatim api_key: ```xuusogercnjpzsvyqznfyuceqczpidamjsezxsxwykppudhzgmtgnoxpgahf```

### Testiranje sa pokretanjem testova

```
cp .env .env.testing # APP_ENV=testing # uneti detalje za test bazu
php artisan test
```

### Mesta za poboljšanja
* Category može biti model (id,slug,name) sa one-to-many relationship sa Movie i sa seeder-om, lako ću to ubaciti ako treba
* Proveravanje i oduzimanje dostupnog broja zahteva može biti jedan middleware umesto dva kao sada
* Pretraga po naslovu vraća listu što smatram da je praktičnije (LIKE query), ako treba mogu da promenim da vrati jedan resurs
* Komentari su na engleskom kao što sam navikao da je praktičnije, ne znam kakva je praksa kod Vas po tom pitanju
* Bilo šta drugo što predložite

### API rute

/api/v1/movies

/api/v1/movies/{id}

/api/v1/movies/category/{category}

/api/v1/movies/title/{title}

### Bitni fajlovi

app/Http/Controllers/Controller.php

app/Http/Kernel.php

app/Http/Middleware/CheckUserRequestLimit.php

app/Http/Middleware/ReduceUserRequestLimit.php

app/Models/Movie.php

app/Models/User.php

database/factories/MovieFactory.php

database/factories/UserFactory.php

database/migrations/2014_10_12_000000_create_users_table.php

database/migrations/2021_08_09_180259_create_movies_table.php

database/seeders/MovieSeeder.php

database/seeders/UserSeeder.php

routes/api.php

tests/Feature/*

