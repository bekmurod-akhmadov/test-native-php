<?php
$username = 'root';
$password = '';
$host = 'localhost';
$database = 'test';

try {
    $db = new PDO("mysql:host = $host;dbname=$database" , $username , $password);
}catch (PDOException $e){
    echo "Bazaga ulanishda xatolik yuz berdi" . $e->getMessage();
}