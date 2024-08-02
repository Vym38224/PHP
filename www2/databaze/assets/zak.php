<?php
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
function getStudents($connection, $id){
    $sql = "SELECT *
            FROM student
            WHERE id = ?";

    $stmt = mysqli_prepare($connection, $sql);
    if ($stmt === false) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);        
        }
    }
   
}

