<?php
session_start();  
if (isset($_POST["usuario"]) && isset($_POST["password"])) {
    $user_var = $_POST["usuario"];
    $password_var = $_POST['password'];

    $base = Database::getInstance();
    $con = $base->getConnection();

    $sql = "SELECT id, password, email FROM usuario WHERE usuario = ? AND estado = 1";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $user_var);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password_var, $row['password'])) {
            $_SESSION['conticomtc'] = $row['id'];
            // $_SESSION['success_message'] = "Inicio de sesión exitoso.";
            header("Location: index");
            exit;
        } else {
            $_SESSION['error_message'] = "Contraseña incorrecta.";
            header("Location: index.php?view=login");
            exit;
        }
    } else {
        $_SESSION['error_message'] = "Usuario no encontrado o cuenta desactivada.";
        header("Location: index.php?view=login");
        exit;
    }
} else {
    header("Location: index.php?view=login");
    exit;
} ?>