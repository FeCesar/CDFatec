<?php

    session_start();

    try{

        $conn = new PDO('mysql:host=localhost;dbname=fatec', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $pass = md5($_POST['pass']);
        $github = $_POST['github'];
        $linkedin = $_POST['linkedin'];
        $instagram = $_POST['instagram'];
        $bio = $_POST['bio'];

        $foto = $_POST['foto'];

        $id = $_SESSION['dados']['admin_id'];

        $stmt = $conn->prepare("UPDATE administrador SET admin_nome = :nome, admin_email = :email, admin_pass = :pass, admin_github = :github, admin_linkedin = :linkedin, admin_instagram = :instagram, admin_pic = :pic, admin_bio = :bio WHERE admin_id = :id");
        $stmt->execute(array(
            'nome' => $nome,
            'email' => $email,
            'pass' => $pass,
            'github' => $github,
            'linkedin' => $linkedin,
            'instagram' => $instagram,
            'pic' => $foto,
            'bio' => $bio,
            'id' => $id
        ));

        $stmt = $conn->query("SELECT * FROM administrador WHERE admin_id = $id");
        $stmt = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['dados'] = $stmt;
        $_SESSION['sucess_update'] = true;
        header('Location: ../user_admin.php');

    } catch(PDOException $e){
        echo "Error" . $e->getMessage();
    }
    
?>