<?php

use App\OtsRsaGenerator;

require "vendor/autoload.php";

$rsaGenerator = new OtsRsaGenerator();
try {
    $randomRsaKey = $rsaGenerator->generateKey();
} catch(RuntimeException $exception) {
    echo $exception->getMessage();
    exit;
}
?>
<html lang="en">
<head>
    <title>OTS RSA Generator</title>
</head>
<body>
<h2>Random RSA generator for OTSes</h2>
<h3>N (modulus) - for Tibia Client:</h3>
<input type="text" style="width:100%" value="<?= $randomRsaKey->getN() ?>"/>
<h3>N (modulus) - for Tibia Client 12+:</h3>
<input type="text" style="width:100%" value="<?= $randomRsaKey->getNasHex() ?>"/>
<h3>N (modulus) - for OTClient:</h3>
<textarea style="width:100%" rows="5"><?= $randomRsaKey->getNForOTClient() ?></textarea>
<h3>key.pem - for new servers:</h3>
<textarea style="width:100%" rows="15"><?= $randomRsaKey->getKeyPem() ?></textarea>
<h3>P (prime1) - for old servers:</h3>
<input type="text" style="width:100%" value="<?= $randomRsaKey->getP() ?>"/>
<h3>Q (prime2) - for old servers:</h3>
<input type="text" style="width:100%" value="<?= $randomRsaKey->getQ() ?>"/>
<h3>D (privateExponent) - for very old servers:</h3>
<input type="text" style="width:100%" value="<?= $randomRsaKey->getD() ?>"/>
<br />
<br />
Code available on <a href="https://github.com/gesior/ots_rsa_generator">https://github.com/gesior/ots_rsa_generator</a>
</body>
</html>
