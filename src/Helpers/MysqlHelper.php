<?php

declare(strict_types=1);

namespace McMatters\Helpers\Helpers;

class MysqlHelper
{
    /**
     * Storages.
     *
     * @see https://dev.mysql.com/doc/refman/5.7/en/storage-requirements.html
     */
    public const STORAGE_TINYINT = 1;
    public const STORAGE_SMALLINT = 2;
    public const STORAGE_MEDIUMINT = 3;
    public const STORAGE_INT = 4;
    public const STORAGE_BIGINT = 8;
    public const STORAGE_FLOAT = 4;
    public const STORAGE_DOUBLE = 8;

    /**
     * Sizes.
     *
     * @see https://dev.mysql.com/doc/refman/5.7/en/integer-types.html
     */

    // Tiny integer.
    public const SIZE_TINYINT_SIGNED_MIN = -128;
    public const SIZE_TINYINT_SIGNED_MAX = 127;
    public const SIZE_TINYINT_UNSIGNED_MIN = 0;
    public const SIZE_TINYINT_UNSIGNED_MAX = 255;

    // Small integer.
    public const SIZE_SMALLINT_SIGNED_MIN = -32768;
    public const SIZE_SMALLINT_SIGNED_MAX = 32767;
    public const SIZE_SMALLINT_UNSIGNED_MIN = 0;
    public const SIZE_SMALLINT_UNSIGNED_MAX = 65535;

    // Medium integer.
    public const SIZE_MEDIUMINT_SIGNED_MIN = -8388608;
    public const SIZE_MEDIUMINT_SIGNED_MAX = 8388607;
    public const SIZE_MEDIUMINT_UNSIGNED_MIN = 0;
    public const SIZE_MEDIUMINT_UNSIGNED_MAX = 16777215;

    // Integer.
    public const SIZE_INT_SIGNED_MIN = -2147483648;
    public const SIZE_INT_SIGNED_MAX = 2147483647;
    public const SIZE_INT_UNSIGNED_MIN = 0;
    public const SIZE_INT_UNSIGNED_MAX = 4294967295;

    // Big integer.
    public const SIZE_BIGINT_SIGNED_MIN = -9223372036854775808;
    public const SIZE_BIGINT_SIGNED_MAX = 9223372036854775807;
    public const SIZE_BIGINT_UNSIGNED_MIN = 0;
    public const SIZE_BIGINT_UNSIGNED_MAX = 18446744073709551615;
}
