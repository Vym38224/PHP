<?php

require "url.php";

/**
 * 
 * Získá jednoho studenta z databáze podle id
 * 
 * @param object $connection - aktuální spojení s databází
 * @param int $id - id studenta
 * 
 * @return array - (associativní pole) vrací řádek z tabulky student
 * 
 */
function getStudent($connection, $id)
{
    $sql = "SELECT *
            FROM student
            WHERE id = ?";

    $stmt = mysqli_prepare($connection, $sql);
    if ($stmt === false) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}

/**
 * 
 * Updatuje informace o žákovi v databázi
 * 
 * @param object $connection - napojení na databázi
 * @param string $first_name - křestní jméno žáka
 * @param string $second_name - příjmení žáka
 * @param integer $age - věk žáka
 * @param string $life - informace o žákovi
 * @param string $college - kolej žáka
 * @param integer $id - id žáka
 * 
 * @return void 
 * 
 */
function updateStudent($connection, $first_name, $second_name, $age, $life, $college, $id)
{

    $sql = "UPDATE student
                   SET first_name = ?,
                       second_name = ?,
                       age = ?,
                       life = ?,
                       college = ?
                WHERE id = ?";

    $stmt = mysqli_prepare($connection, $sql);

    if (!$stmt) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($stmt, "ssissi", $first_name, $second_name, $age, $life, $college, $id);

        if (mysqli_stmt_execute($stmt)) {
            redirectUrl("/www2databaze/jeden-zak.php?id=$id");
        }
    }
}


/**
 * 
 * Vymaže studenta z databáze podle daného ID
 * 
 * @param object $connection - propojení s databází
 * @param integer $id - id daného žáka
 * 
 * @return void
 */
function deleteStudent($connection, $id)
{
    $sql = "DELETE
            FROM student
            WHERE id = ?";

    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt === false) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            redirectUrl("/www2databaze/zaci.php");
        }
    }
}


/**
 * 
 * Vrátí všechny žáky z databáze
 * 
 * @param object $connection - připojení do databáze
 * 
 * @return array pole objektů, kde každý objekt je jeden žák  
 */
function getAllStudents($connection, $columns = "*")
{
    $sql = "SELECT $columns 
            FROM student";

    $result = mysqli_query($connection, $sql);

    if ($result === false) {
        echo mysqli_error($connection);
    } else {
        $allStudents = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $allStudents;
    }
}



/**
 * 
 * Přidání žáka do databáze a přesměruje nás na profil žáka
 * 
 * @param object $connection - připojení do databáze
 * @param string $name - jméno
 * @param string $password - heslo
 * 
 * 
 * @return void
 */
function createStudent($connection, $name, $password)
{

    $sql = "INSERT INTO student (name, password) 
    VALUES (?, ?)";

    $statement = mysqli_prepare($connection, $sql);

    if ($statement === false) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($statement, "ssiss", $name, $password);

        if (mysqli_stmt_execute($statement)) {
            $id = mysqli_insert_id($connection);
            redirectUrl("/www2databaze/jeden-zak.php?id=$id");
        } else {
            echo mysqli_stmt_error($statement);
        }
    }
}
