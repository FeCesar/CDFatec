<?php

    session_start();

    try{

        $conn = new PDO('mysql:host=localhost;dbname=fatec', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $github = $_POST['github'];
        $linkedin = $_POST['linkedin'];
        $instagram = $_POST['instagram'];
        $bio = $_POST['bio'];

        $foto = $_POST['foto'];

        $id = $_SESSION['dados']['user_id'];

        $stmt = $conn->prepare("UPDATE user SET user_nome = :nome, user_email = :email, user_pass = :pass, user_github = :github, user_linkedin = :linkedin, user_instagram = :instagram, user_pic = :pic, user_bio = :bio WHERE user_id = :id");
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

        $stmt = $conn->query("SELECT * FROM user WHERE user_id = $id");
        $stmt = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['dados'] = $stmt;
        $_SESSION['verificado'] = true;
        $_SESSION['sucess_update'] = true;
        header('Location: ../user.php');

    } catch(PDOException $e){
        echo "Error" . $e->getMessage();
    }
    
?>