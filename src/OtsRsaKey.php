<?php

namespace App;

class OtsRsaKey
{
    /**
     * @var string
     */
    private $n;
    /**
     * @var string
     */
    private $nForOTClient;
    /**
     * @var string
     */
    private $keyPem;
    /**
     * @var string
     */
    private $p;
    /**
     * @var string
     */
    private $q;
    /**
     * @var string
     */
    private $d;

    public function __construct(string $n, string $nForOTClient, string $keyPem, string $p, string $q, string $d)
    {
        $this->n = $n;
        $this->nForOTClient = $nForOTClient;
        $this->keyPem = $keyPem;
        $this->p = $p;
        $this->q = $q;
        $this->d = $d;
    }

    public function getN(): string
    {
        return $this->n;
    }

    public function getNForOTClient(): string
    {
        return $this->nForOTClient;
    }

    public function getKeyPem(): string
    {
        return $this->keyPem;
    }

    public function getP(): string
    {
        return $this->p;
    }

    public function getQ(): string
    {
        return $this->q;
    }

    public function getD(): string
    {
        return $this->d;
    }
}
