<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}
?>
<nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand">Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</a>
        <div class="d-flex align-items-center">

            <form action="../auth/logout.php" method="POST" class="d-flex">
                <button class="btn btn-success" type="submit">Cerrar Sesión</button>
            </form>
        </div>
    </div>
</nav>