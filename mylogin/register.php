<?php
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql_usuario = "SELECT * FROM usuarios WHERE username = ?";
    if($stmt = $conn->prepare($sql_usuario)){
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            echo "<div class='alert alert-danger mt-3'>Usuario ya existente en la base de datos</div>";
        } else {
            $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
            if($stmt = $conn->prepare($sql)){
                $stmt->bind_param("ss", $username, $password);
                if($stmt->execute()){
                    header("Location: dashboard.php");
                } else {
                    echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
                }
            }
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Registrarse</h2>
        <form method="POST" action="register.php"></form>
        <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>
    </div>
</body>
</html>
