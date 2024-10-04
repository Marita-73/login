<?php
session_start();
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username = ?";
    if($stmt = $conn->prepare($sql)){
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");
            } else {
                echo "<div class='alert alert-danger mt-3'>Contraseña incorrecta</div>";
            }
        } else {
            echo "<div class='alert alert-danger mt-3'>Usuario no encontrado</div>";
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
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="login.php"></form>
        <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-flex justify-content-center p-2">
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </div>
            </form>
    </div>
</body>
</html>