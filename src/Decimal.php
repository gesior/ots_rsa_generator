<?php

namespace App;

use phpseclib3\Math\BigInteger;

/**
 * Decimal format for RSA key 'toString' method of phpseclib formatter.
 * Hack to get access to protected attributes.
 */
class Decimal
{
    public static function getShortName(): string
    {
        return 'decimal';
    }

    private static function bytesToNumber($bytes): string
    {
        $base62 = gmp_strval(gmp_init(bin2hex($bytes), 16), 62);
        return gmp_strval(gmp_init($base62, 62), 10);
    }

    public static function savePrivateKey(
        BigInteger $n,
        BigInteger $e,
        BigInteger $d,
        array $primes,
        array $exponents,
        array $coefficients,
        $password = ''
    ): array {
        return [
            'e' => self::bytesToNumber($e->toBytes()),
            'n' => self::bytesToNumber($n->toBytes()),
            'p' => self::bytesToNumber($primes[1]->toBytes()),
            'q' => self::bytesToNumber($primes[2]->toBytes()),
            'd' => self::bytesToNumber($d->toBytes())
        ];
    }

    public static function savePublicKey(BigInteger $n, BigInteger $e): array
    {
        return [
            'e' => self::bytesToNumber($e->toBytes()),
            'n' => self::bytesToNumber($n->toBytes()),
        ];
    }
}
