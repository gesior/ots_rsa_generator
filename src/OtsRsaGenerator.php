<?php

namespace App;

use phpseclib3\Crypt\RSA;
use RuntimeException;

class OtsRsaGenerator
{
    public function __construct()
    {
        RSA::useInternalEngine();
        RSA::addFileFormat(Decimal::class);
    }

    public function generateKey(int $maximumIterations = 1000): OtsRsaKey
    {
        // 1024-bit key may have 308 or 309 digits in decimal format, Tibia client expect 309 digits
        for ($i = 0; $i < $maximumIterations; $i++) {
            $private = RSA::createKey(1024);
            /** @var array $rawPrivate Call toString to get array from Decimal class */
            $rawPrivate = $private->toString('decimal');

            $n = $rawPrivate['n'];

            if (strlen($n) === 309) {
                $nAsHex = $this->convertDecimalToHex($n);
                $pkcs1Private = $private->toString('PKCS1');
                $p = $rawPrivate['p'];
                $q = $rawPrivate['q'];
                $d = $rawPrivate['d'];

                return new OtsRsaKey($n, $nAsHex, $this->formatKeyForOTClient($n), $pkcs1Private, $p, $q, $d);
            }
        }

        throw new RuntimeException('Random key generation failed. Try again.');
    }

    private function convertDecimalToHex(string $decimal): string
    {
        return gmp_strval(gmp_init($decimal, 10), 16);
    }

    private function formatKeyForOTClient(string $n): string
    {
        $parts = [];
        for ($i = 0; $i <= floor(strlen($n) / 64); $i++) {
            $parts[] = substr($n, $i * 64, 64);
        }

        return 'OTSERV_RSA  = "' . implode("\" ..\n              \"", $parts) . '"';
    }
}
