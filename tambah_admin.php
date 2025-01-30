<?php include "header.php"; ?>
    <h2>Add New Admin</h2>
    <form action="process_add_admin.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="namalengkap">Nama Lengkap:</label>
        <input type="text" id="namalengkap" name="namalengkap" required><br><br>
        
        <input type="submit" value="Add Admin">
    </form>
</body>
</html>