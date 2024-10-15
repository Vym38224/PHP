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

        <input type="submit" value="Registrovat">
</form>