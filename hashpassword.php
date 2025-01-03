<?php

require_once 'vendor/autoload.php';

use Illuminate\Hashing\BcryptHasher;

$hasher = new BcryptHasher();
$password = $hasher->make('tenant1');
echo $password;
?>
