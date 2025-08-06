<?php

$dsn = "mysql:host=".DB_HOSTNAME.";dbname=".DB_DATABASE.";charset=utf8";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
);
$pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, $opt);

function dbQuery($query, $values = []) {
    global $pdo;
    $stmt = $pdo->prepare($query);
    $stmt->execute($values);

    // Check if the query is an INSERT statement
    if (stripos(trim($query), 'insert') === 0) {
        return $pdo->lastInsertId();
    }

    // For other queries, return the statement object as before
    return $stmt;
}

