<form method="POST">
        <input type="text"
                name="name"
                placeholder="Jméno"
                value="<?= htmlspecialchars($name)  ?>"
                required><br>

        <input type="text"
                name="password"
                placeholder="Heslo"
                value="<?= htmlspecialchars($password) ?>"
                required><br>

        <input type="submit" value="Registrovat">
</form>