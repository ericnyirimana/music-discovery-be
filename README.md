# Music Discovery

Music Discovery is an APP that consumes <a href="https://www.last.fm/api">LAST FM APIs</a> and enables to get Artists and Albums information

### Clone repository

Before starting the installation you need to clone the repository through the below git command:

    git clone https://github.com/ericnyirimana/music-discovery-be.git

### Add Environment Variables

Create .env in the root folder and add the below variables

    DB_HOST=mysql
    
    GOOGLE_CLIENT_ID={YOUR_GOOGLE_CLIENT_ID}
    GOOGLE_CLIENT_SECRET={YOUR_GOOGLE_CLIENT_SECRET}
    GOOGLE_REDIRECT_URL={YOUR_GOOGLE_REDIRECT_URL}
    
    SESSION_DRIVER=cookie
    SANCTUM_STATEFUL_DOMAINS=.yourdomain
    SESSION_DOMAIN=.yourdomain
    
    LAST_FM_API_URL=https://ws.audioscrobbler.com/2.0/
    LAST_FM_KEY={YOUR_LAST_FM_API_KEY}

### Installing using sail up

Laravel Sail is a light-weight command-line interface for interacting with Laravel's default Docker development environment. Sail provides a great starting point for building a Laravel application using PHP, MySQL, and Redis without requiring prior Docker experience.

```
> ./vendor/bin/sail up
```

### Running migration

Open another terminal while sail up is done and run the below command

```
> ./vendor/bin/sail artisan migrate
```

### Running migration

Open another terminal while sail up is done and run the below command

```
> ./vendor/bin/sail artisan migrate
```

#### Run the server

```
> ./vendor/bin/sail artisan serve
```

>Access the app through <a href="http://localhost">http://localhost</a>



### Endpoints

| Enpoint | Methods  | Description  |
| ------- | --- | --- |
| /api/v1/albums | POST | Add favorite album |
| /api/v1/albums | GET | Get favorite albums |
| /api/v1/albums/<id> | GET | Get specific favorite album |
| /api/v1/albums/<id> | DELETE | Delete a favorite album |
| /api/v1/albums/<id> | UPDATE | Update a favorite album |
| /api/v1/artists | POST | Create a favorite artist |
| /api/v1/artists | GET | Get all favorite artists |
| /api/v1/artists/<id> | GET | Get a specific favorite artist |
| /api/v1/artists/<id> | DELETE | Delete a favorite artist |
| /api/v1/artists/<id> | UPDATE | Delete a favorite artist |

### Responses

#### On success

>{ "status": 200, "data": [ { ... }] }
​
#### On error

>{ "status": 400, "message": "relevant-error-message" }


## Contributors

- NYIRIMANA Eric

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

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

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
