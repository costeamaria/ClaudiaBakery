<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'claudia1';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// Check connection
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (!isset($_POST['username'], $_POST['password'])) {
    exit('Completati username si password!');
}

if ($stmt = $con->prepare('SELECT id, password FROM adminlogin WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();

    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verify the password
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['nume_user'] = $_POST['username'];
        $_SESSION['pass'] = $_POST['password'];
        $_SESSION['id'] = $id;
        echo 'Bine ati venit' . $_SESSION['username'] . '!';
        header('Location: vizualizare_produs.php');
    } else {
    // password incorrect
    echo 'Parola incorecta!';
    }
    } else {
    // username incorect
    echo 'Username incorect!';
    }
    $stmt->close();
?>
