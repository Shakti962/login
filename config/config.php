<?php
// Defining constants
const LOCALHOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'login';

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
$db_select = mysqli_select_db($conn, DB_NAME);
