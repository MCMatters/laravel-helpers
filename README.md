# Laravel Helpers

[![Latest Stable Version](https://poser.pugx.org/mcmatters/laravel-helpers/v/stable)](https://packagist.org/packages/mcmatters/laravel-helpers)
[![Build Status](https://travis-ci.org/MCMatters/laravel-helpers.svg?branch=master)](https://travis-ci.org/MCMatters/laravel-helpers)
[![Maintainability](https://api.codeclimate.com/v1/badges/92772420b0d1cbb32c30/maintainability)](https://codeclimate.com/github/MCMatters/laravel-helpers/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/92772420b0d1cbb32c30/test_coverage)](https://codeclimate.com/github/MCMatters/laravel-helpers/test_coverage)
[![Total Downloads](https://poser.pugx.org/mcmatters/laravel-helpers/downloads)](https://packagist.org/packages/mcmatters/laravel-helpers)

- [Arrays](#arrays)
- [Class](#class)
- [Database](#database)
- [Dev](#dev)
- [Eloquent](#eloquent)
- [Forms](#forms)
- [Generic](#generic)
- [Math](#math)
- [Server](#server)
- [Strings](#strings)
- [Url](#url)

## Arrays

#### `array_has_with_wildcard(array $array, string $keys, bool $searchWithSegment)`

The `array_has_with_wildcard` is analogue of function `array_has` with ability to search with wildcard. Also it can search keys with dots (i.e. when you want to get some data from multiple field when validation is failed).

#### `array_get_random(array $array)`

The `array_get_random` function returns random value instead key, how it makes the `array_rand`.

#### `array_key_by(array $array, string $key)`

The `array_key_by` function returns a new associative array grouped by `$key`.

#### `array_contains(array $array, string $needle, bool $byKey = false)`

The `array_contains` function returns true if array contains given `$needle`. You can also search by array keys. This function searches only in first level of array.

#### `array_has_int_keys(array $array)`

The `array_has_int_keys` function checks whether keys of given array as integer or not.

#### `shuffle_assoc(array $array)`

The `shuffle_assoc` function works like basic `shuffle` but with key preserving.

#### `array_change_key_case_recursive(array $array, int $case = CASE_LOWER)`

The `array_change_key_case_recursive` function changes the case of all keys in an array recursively.

## Class

#### `get_class_constants($class)`

The `get_class_constants` function returns an array with all class constants.

#### `get_class_constants_start_with($class, string $string)`

The `get_class_constants_start_with` function returns an array with constants which start with passed string.

## Database

#### `compile_sql_query($sql, array|null $bindings)`

The `compile_sql_query` function replaces all placeholders given bindings.

#### `get_all_tables(bool $withColumns)`

The `get_all_tables` function returns the list all tables with their columns.

#### `search_entire_database(string $keyword)`

The `search_entire_database` function searches entire database.

#### `query_has_join($query, string $table)`

The `query_has_join` function determines whether query has a joined table.

## Dev

#### `ddq($query, bool $return)`

The `ddq` is analogue of function `dd`, but uses only for database queries.

#### `dump($value, $output)`

The `dump` is analogue of function `dd`, but without stopping php executing script.

## Eloquent

#### `is_morphed_belongs_parent(Model $morphed, Model $parent, string $name, string $type, string $id)`

The `is_morphed_belongs_parent` function determines whether morphed model is belongs to parent.

#### `get_model_from_query($query)`

The `get_model_from_query` function returns model from given `$query`. Supports only Builder and Relation queries.

#### `destroy_models_from_query($query)`

The `destroy_models_from_query` function destroys models from given `$query`. It is very useful for calling model observers when you delete your models.

## Forms

#### `transform_form_element_key(string $key)`

The `transform_form_element_key` function for get the right name for the form element name. ["laravelcollective/html"](https://laravelcollective.com/docs/master/html) uses similar method called "transformKey". It helpful for `Illuminate\Support\MessageBag` when you want to get error from the multiple field, for example from multiple phones.

## Generic

#### `is_production_environment()`

The `is_production_environment` function checks whether the production environment is using.

#### `is_local_environment()`

The `is_local_environment` function checks whether the production local is using.

#### `get_size_types()`

The `get_size_types` function returns the list all available size types.

#### `random_bool()`

The `random_bool` function returns a random boolean value.

#### `casting_bool($value, bool $default)`

The `casting_bool` function returns casted boolean value. 

#### `is_json($json, $returnDecoded)`

The `is_json` function check whether passed string is a json.

#### `is_uuid($string)`

The `is_uuid` function check whether passed value is a valid uuid value.

## Math

#### `calculate_percentage($count, $total, int $decimals)`

The `calculate_percentage` function calculates percentages.

#### `calculate_discount($discount, $total, int $decimals)`

The `calculate_discount` function calculates discount.

#### `calculate_with_discount($discount, $total, int $decimals)`

The `calculate_with_discount` function calculates price with discount.

#### `float_has_remainder(float $number)`

The `float_has_remainder` function checks whether the remainder of the float is not zero.

#### `convert_bytes($value, string $returnType)`

The `convert_bytes` function converts bytes between any sizes.

#### `is_number_even($number)`

The `is_number_even` function checks whether the number is even.

#### `is_number_odd($even)`

The `is_number_odd` function checks whether the number is odd.

#### `in_range($number, $from, $to)`

The `in_range` function checks whether the number is between `$from` and `$to`.

## Server

#### `is_request_method_update($request)`

The `is_request_method_update` function checks whether the current request method is for updating.

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

## Strings

#### `str_lower(string $string)`

The `str_lower` is function wrapper over `Str::lower`.

#### `str_upper(string $string)`

The `str_upper` is function wrapper over `Str::upper`.

#### `str_ucwords(string $string)`

The `str_ucwords` function converts a value to studly caps case with spaces.

#### `strpos_array(string $haystack, $needles, int $offset)`

The `strpos_array` is function wrapper over `strpos`. Added ability to pass `$needle` as an array.

## Url

#### `get_base_url(string $url)`

The `get_base_url` function returns base url.

#### `routes_path(string $path)`

The `routes_path` function returns path to `routes` folder.
