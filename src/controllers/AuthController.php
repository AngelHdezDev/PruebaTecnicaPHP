<?php
class AuthController
{
    public static function register($nombre, $email, $password)
    {
        require __DIR__ . '/../../config/db.php';

        
        $checkEmailSql = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
        $checkStmt = $pdo->prepare($checkEmailSql);
        $checkStmt->bindParam(':email', $email);
        $checkStmt->execute();
        $emailExists = $checkStmt->fetchColumn();

        if ($emailExists) {
            echo "<div class='alert alert-danger'>El correo ya está registrado. Intente con otro.</div>";
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->execute();

        echo "<div class='alert alert-success'>Usuario registrado con éxito.</div>";
    }


    public static function login($email, $password)
    {
        require __DIR__ . '/../../config/db.php';

        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            error_log("Password hash in DB: " . $user['password']);
            error_log("Password provided: " . $password);
            $isPasswordValid = password_verify($password, $user['password']);
            error_log("Password is valid: " . ($isPasswordValid ? 'true' : 'false'));

            if ($isPasswordValid) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nombre'];

               
                header("Location: ../../views/products/list.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Correo o password incorrectos.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Correo o password incorrectos.</div>";
        }
    }


    public static function logout()
    {
        session_destroy();
        header("Location: login.php");
        exit();
    }

    public static function checkAuthentication()
    {
        if (!isset($_SESSION['is_authenticated']) || !$_SESSION['is_authenticated']) {
            header("Location: login.php"); // Redirigir si no está autenticado
            exit();
        }
    }


}
