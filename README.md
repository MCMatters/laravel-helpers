# Laravel Helpers

[![Latest Stable Version](https://poser.pugx.org/mcmatters/laravel-helpers/v/stable)](https://packagist.org/packages/mcmatters/laravel-helpers)
[![Build Status](https://travis-ci.org/MCMatters/laravel-helpers.svg?branch=master)](https://travis-ci.org/MCMatters/laravel-helpers)
[![Code Climate](https://codeclimate.com/github/MCMatters/laravel-helpers/badges/gpa.svg)](https://codeclimate.com/github/MCMatters/laravel-helpers)
[![Test Coverage](https://codeclimate.com/github/MCMatters/laravel-helpers/badges/coverage.svg)](https://codeclimate.com/github/MCMatters/laravel-helpers/coverage)
[![Total Downloads](https://poser.pugx.org/mcmatters/laravel-helpers/downloads)](https://packagist.org/packages/mcmatters/laravel-helpers)

## Installation

`composer require mcmatters/laravel-helpers`

Then run the command

```bash
php artisan vendor:publish --provider="\McMatters\Helpers\ServiceProvider"
```

If you prefer manual installation, then add to `config/app.php` into `providers` section next line:

```php
'providers' => [
    McMatters\Helpers\ServiceProvider::class,
],
```

Otherwise it will be autodiscovered.

## Configuration

Since `v2.0`, you can disable all helper functions and use helper classes, if you prefer to use helper functions, you can choose what exactly section do you want to use (`array`, `dev`, `string`, etc)

- [Arrays](#arrays)
- [Artisan](#artisan)
- [Class](#class)
- [Database](#database)
- [Dev](#dev)
- [Env](#env)
- [Math](#math)
- [Model](#model)
- [Request](#request)
- [Server](#server)
- [String](#string)
- [Type](#type)
- [Url](#url)

### Arrays

#### `array_first_key(array $array)`

The `array_first_key` function returns first key from the given array.

#### `array_has_with_wildcard(array $array, string $keys, bool $searchWithSegment)`

The `array_has_with_wildcard` is analogue of function `array_has` with ability to search with wildcard. Also it can search keys with dots (i.e. when you want to get some data from multiple field when validation is failed).

#### `array_key_by(array $array, string $key)`

The `array_key_by` function returns a new associative array grouped by `$key`.

#### `array_contains(array $array, string $needle, bool $byKey = false)`

The `array_contains` function returns true if array contains given `$needle`. You can also search by array keys. This function searches only in first level of array.

#### `array_has_only_int_keys(array $array)`

The `array_has_only_int_keys` function checks whether keys of given array as integer or not.

#### `shuffle_assoc(array $array)`

The `shuffle_assoc` function works like basic `shuffle` but with key preserving.

#### `array_change_key_case_recursive(array $array, int $case = CASE_LOWER)`

The `array_change_key_case_recursive` function works like `array_change_key_case` except that it works recursively.

### Artisan

#### `get_php_path()`

The `get_php_path` function returns path to executable `php`.

#### `get_artisan()`

The `get_artisan` function return path to executable `artisan`.

#### `run_background_command(string $command)`

The `run_background_command` function runs the given command in background.

### Class

#### `get_class_constants($class)`

The `get_class_constants` function returns an array with all class constants.

#### `get_class_constants_start_with($class, string $string)`

The `get_class_constants_start_with` function returns an array with constants which start with passed string.

### Database

#### `compile_sql_query($sql, array $bindings = null)`

The `compile_sql_query` function replaces all placeholders given bindings.

#### `get_all_tables(bool $withColumns = true, string $connection = null)`

The `get_all_tables` function returns the list all tables with their columns.

#### `search_entire_database(string $keyword, string $connection = null)`

The `search_entire_database` function searches entire database. It works only with MySQL and SQL drivers.

#### `has_query_join_with($query, string $with)`

The `has_query_join_with` function determines whether query has a joined table.

## Dev

#### `ddq($query, bool $die = false)`

The `ddq` is analogue of function `dd`, but uses only for database queries.

#### `dump($value, bool $output = false)`

The `dump` is analogue of function `dd`, but without stopping php executing script.

### Env

#### `is_production_environment()`

The `is_production_environment` function checks whether the production environment is using.

#### `is_local_environment()`

The `is_local_environment` function checks whether the production local is using.

### Math

#### `calculate_percentage($count, $total, int $decimals)`

The `calculate_percentage` function calculates percentages.

#### `calculate_discount($discount, $total, int $decimals)`

The `calculate_discount` function calculates discount.

#### `calculate_with_discount($discount, $total, int $decimals)`

The `calculate_with_discount` function calculates price with discount.

#### `has_float_remainder(float $number)`

The `has_float_remainder` function checks whether the remainder of the float is not zero.

#### `convert_bytes($value, string $returnType)`

The `convert_bytes` function converts bytes between any sizes.

#### `get_size_types()`

The `get_size_types` function returns the list all available size types.

#### `is_number_even($number)`

The `is_number_even` function checks whether the number is even.

#### `is_number_odd($number)`

The `is_number_odd` function checks whether the number is odd.

#### `is_number_in_range($number, $from, $to)`

The `is_number_in_range` function checks whether the number is in a given range.

## Model

#### `get_model_from_query($query)`

The `get_model_from_query` function returns a model from a query.

#### `destroy_models_from_query($query)`

The `destroy_models_from_query` function destroy all models from a query. Useful when you want to delete many models with calling model's hooks.

#### `is_morphed_belongs_parent(Model $morphed, Model $parent, string $name, string $type, string $id)`

The `is_morphed_belongs_parent` function determines whether morphed model is belongs to parent.

### Request

#### `is_request_method_update($request)`

The `is_request_method_update` function checks whether the current request method is for updating.

### Server

#### `long_processes()`

The `long_processes` function sets the maximum value of the optimal configuration for the server to perform long operations.

#### `get_upload_max_filesize(string $returnType)`

The `get_upload_max_filesize` function returns the value of the `upload_max_filesize` from `php.ini` in any of the formats.

#### `get_post_max_size(string $returnType)`

The `get_post_max_size` function returns the value of the `post_max_size` from `php.ini` in any of the formats.

#### `is_max_post_size_exceeded()`

The `is_max_post_size_exceeded` function checks whether is the permissible size of the value `post_max_size` exceeded.

#### `get_max_response_code()`

The `get_max_response_code` function returns maximum available value for response code.

### String

#### `str_lower(string $string)`

The `str_lower` is function wrapper over `Str::lower`.

#### `str_upper(string $string)`

The `str_upper` is function wrapper over `Str::upper`.

#### `str_ucwords(string $string)`

The `str_ucwords` function converts a value to studly caps case with spaces.

### Type

#### `random_bool()`

The `random_bool` function returns a random boolean value.

#### `casting_bool($value, bool $default)`

The `casting_bool` function returns casted boolean value. 

#### `is_json($json, $returnDecoded)`

The `is_json` function check whether passed string is a json.

#### `is_uuid($string)`

The `is_uuid` function check whether passed value is a valid uuid value.

## Url

#### `get_base_url(string $url)`

The `get_base_url` function returns base url.

#### `get_host_url(string $url, bool $stripWww = true)`

The `get_host_url` function returns host url.

#### `routes_path(string $path)`

The `routes_path` function returns path to `routes` folder.
