<?php
require "assets/database.php";
require "assets/zak.php";
$connection = connectionDB();

if (isset($_GET["id"])) {
    $one_student = getStudent($connection, $_GET["id"]);
    if ($one_student) {
        $first_name = $one_student["first_name"];
        $last_name = $one_student["last_name"];
        $email = $one_student["email"];
        $mobile = $one_student["mobile"];
        $room = $one_student["room"];
        $life = $one_student["life"];
        $password = $one_student["password"];
        $is_admin = $one_student["is_admin"];
        $id = $one_student["id"];
    } else {
        die("Student nenalezen");
    }
} else {
    die("ID není zadáno, student nebyl nalezen");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $room = $_POST["room"];
    $life = $_POST["life"];
    $password = $_POST["password"];
    $is_admin = $_POST["is_admin"];

    updateStudent($connection, $first_name, $last_name, $email, $mobile, $room, $life, $password, $is_admin, $id);
    header("Location: jeden-zak.php?id=$id");
}
?>

<form method="POST">
    <input type="text"
        name="first_name"
        placeholder="Jméno"
        value="<?= htmlspecialchars($first_name)  ?>"
        required><br>

    <input type="text"
        name="last_name"
        placeholder="Příjmení"
        value="<?= htmlspecialchars($last_name) ?>"
        required><br>

    <input type="text"
        name="email"
        placeholder="E-mail"
        value="<?= htmlspecialchars($email) ?>"
        required><br>

    <input type="number"
        name="mobile"
        placeholder="Telefon"
        value="<?= htmlspecialchars($mobile) ?>"
        required><br>

    <input type="text"
        name="room"
        placeholder="Pracovna"
        value="<?= htmlspecialchars($room) ?>"
        required><br>

    <input type="text"
        name="life"
        placeholder="Popisek"
        value="<?= htmlspecialchars($life) ?>"
        required><br>

    <input type="text"
        name="password"
        placeholder="Heslo"
        value="<?= htmlspecialchars($password) ?>"
        required><br>

    <input type="text"
        name="is_admin"
        placeholder="Správce"
        value="<?= htmlspecialchars($is_admin) ?>"
        required><br>

    <button type="submit">Uložit</button>
</form>