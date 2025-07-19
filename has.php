<?php
$password_plain = "1234";
echo "Password: $password_plain <br>";
echo "Hash: " . password_hash($password_plain, PASSWORD_DEFAULT);
