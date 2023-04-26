# laravel-dd-sql
Laravel service provider to dump query string, with merged bindings, from anywhere in the query chain. 

> This package is no longer being supported so I can not guarantee it will continue to work in newer versions of Laravel. Last tested in Laravel 5.

## Usage

### orderByRandom

```php
Model::where('foo', '=', 'bar')
    ->where('this', '>' 'that')->ddSql()   //<----dumps query string before the orderBy
    ->orderBy('foo', 'desc')
    ->get();
```

outputs
```
select * from model where `foo` = `bar` and `this` > `that`
```

## Installation

Add the `ApeWare\BuilderMacros\DdSqlServiceProvider` service provider in `config/app.php`.

## Code Structure

    ├── src
    │   └── DdSqlServiceProvider.php
    ├── .gitignore
    ├── LICENSE.txt
    ├── README.md
    └── composer.json

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
