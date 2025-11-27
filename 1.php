<?php 

// make_hash.php
$plain = '123';
$hash  = password_hash($plain, PASSWORD_DEFAULT); // or PASSWORD_ARGON2ID
echo "<pre>$hash</pre>";
?>