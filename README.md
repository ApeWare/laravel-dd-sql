# laravel-dd-sql
Laravel service provider to dump query string, with merged bindings, from anywhere in the query chain. 

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
