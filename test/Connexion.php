<?php
$pdo = new PDO("mysql:host=localhost;dbname=chabert0", "chabert", "h9IfJHFJ");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("SELECT identifiantLogin, role, password FROM Login WHERE identifiantLogin = ?");
$stmt->execute([$username]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row && password_verify($password, $row['password'])) {
    session_start();
    $_SESSION['identifiantLogin'] = $row['identifiantLogin'];
    $_SESSION['role'] = $row['role'];

    switch ($_SESSION['role']) {
        case 'admin':
            header("Location: admin.php");
            exit();
        case 'user':
        	//Il faut crée la page user
            header("Location: user.php");
            exit();
        default:
            $message = "Rôle d'utilisateur inconnu.";
            header("Location: login.php?message=" . urlencode($message));
            exit();
    }
} else {
    $message = "Nom d'utilisateur ou mot de passe incorrect.";
    header("Location: login.php?message=" . urlencode($message));
    exit();
}
?>
