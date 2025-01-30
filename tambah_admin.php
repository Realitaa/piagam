<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Admin</title>
</head>
<body>
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