<?php
namespace ApeWare\BuilderMacros;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;

/**
 * Dumps the query string with merged bindings
 *
 * @example
 * Model::where('foo', '=', 'bar')
 *     ->where('this', '>' 'that')->ddSql()   <----dumps query string before the orderBy
 *     ->orderBy('foo', 'desc')
 *     ->get();
 *
 * @package App\Providers
 */
class DdSqlServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if (!Builder::hasMacro('ddSql')) {
            Builder::macro ('ddSql', function () {
                // First, grab the query
                // this will look something like `select * from foo where bar = ?`
                $sql = $this->grammar->compileSelect($this);

                // Then, grab the bindings array and preserve int/string types
                $bindings     = collect($this->getBindings($this->bindings))->map(function($binding){
                    return (is_numeric($binding)) ? $binding : "'$binding'"; // quote strings
                });

                // Iterate over the bindings to gather an array of placeholders (? or :name)
                $placeholders = $bindings->map(function($v, $placeholder){
                    if (is_string($placeholder)) return '/:'.$placeholder.'/';  // handle :named placeholders
                    return '/[?]/'; // else handle "?" placeholders
                })->toArray();

                // Replace the placeholder(s) with their binding values in the query
                $query = preg_replace($placeholders, $bindings->toArray(), $sql, 1);

                return dd($query);
            });
        }
    }
}
