<?php

declare(strict_types = 1);

namespace McMatters\Helpers;

/**
 * Class Mysql
 *
 * @package McMatters\Helpers
 */
class Mysql
{
    /**
     * Storages.
     *
     * @see https://dev.mysql.com/doc/refman/5.7/en/storage-requirements.html
     */
    const STORAGE_TINYINT = 1;
    const STORAGE_SMALLINT = 2;
    const STORAGE_MEDIUMINT = 3;
    const STORAGE_INT = 4;
    const STORAGE_BIGINT = 8;
    const STORAGE_FLOAT = 4;
    const STORAGE_DOUBLE = 8;

    /**
     * Sizes.
     *
     * @see https://dev.mysql.com/doc/refman/5.7/en/integer-types.html
     */

    // Tiny integer.
    const SIZE_TINYINT_SIGNED_MIN = -128;
    const SIZE_TINYINT_SIGNED_MAX = 127;
    const SIZE_TINYINT_UNSIGNED_MIN = 0;
    const SIZE_TINYINT_UNSIGNED_MAX = 255;

    // Small integer.
    const SIZE_SMALLINT_SIGNED_MIN = -32768;
    const SIZE_SMALLINT_SIGNED_MAX = 32767;
    const SIZE_SMALLINT_UNSIGNED_MIN = 0;
    const SIZE_SMALLINT_UNSIGNED_MAX = 65535;

    // Medium integer.
    const SIZE_MEDIUMINT_SIGNED_MIN = -8388608;
    const SIZE_MEDIUMINT_SIGNED_MAX = 8388607;
    const SIZE_MEDIUMINT_UNSIGNED_MIN = 0;
    const SIZE_MEDIUMINT_UNSIGNED_MAX = 16777215;

    // Integer.
    const SIZE_INT_SIGNED_MIN = -2147483648;
    const SIZE_INT_SIGNED_MAX = 2147483647;
    const SIZE_INT_UNSIGNED_MIN = 0;
    const SIZE_INT_UNSIGNED_MAX = 4294967295;

    // Big integer.
    const SIZE_BIGINT_SIGNED_MIN = -9223372036854775808;
    const SIZE_BIGINT_SIGNED_MAX = 9223372036854775807;
    const SIZE_BIGINT_UNSIGNED_MIN = 0;
    const SIZE_BIGINT_UNSIGNED_MAX = 18446744073709551615;
}
