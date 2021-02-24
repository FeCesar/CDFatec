<?php

    session_start();

    try{

        $conn = new PDO('mysql:host=localhost;dbname=fatec', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $url = $_POST['url'];
        $url = explode("/", $url);
        $url = $url[2];


        function verificaEmail($emailUser){

            $emailsTypes = ["outlook.com", "hotmail.com", "gmail.com", "fatec.sp.gov.br", "admin.com", "user.com"];
            $emailType = explode("@", $emailUser);
    
            $emailCorreto = [];
    
            foreach ($emailsTypes as $email){
                if($emailType[1] == $email){
                    array_push($emailCorreto, "Válido");
                } else{
                    array_push($emailCorreto, "Inválido");
                }
            }

            return in_array("Válido", $emailCorreto);
        }

        if(!verificaEmail($email) == 1){
            $_SESSION['error_email_invalido_registro'] = true;
            header("Location: ../" . $url);
        } 
        else{

            $sql = "SELECT * FROM administrador WHERE admin_email = '$email'";
            $stmtAdmin = $conn->query($sql);
            $linhasAdmin = $stmtAdmin->rowCount();
    
            $sql = "SELECT * FROM user WHERE user_email = '$email'";
            $stmtUser = $conn->query($sql);
            $linhasUser = $stmtUser->rowCount();
    
            if($linhasAdmin > 0 or $linhasUser > 0){
                $_SESSION['error_email_utilizado'] = true;
                header("Location: ../" . $url);
            } 
            else{
                $stmt = $conn->prepare("INSERT INTO user(user_nome, user_email, user_pass) VALUES (:user_nome, :user_email, :user_pass)");
                $stmt->execute(array(
                    'user_nome' => $nome,
                    'user_email' => $email,
                    'user_pass' => $pass
                ));
    
                $stmt = $conn->query("SELECT * FROM user WHERE user_email = '$email'");
                $dados = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['dados'] = $dados;
                $_SESSION['sucess_conta_criada'] = true;
                header("Location: ../" . $url);
            }
    
        }

    } catch(PDOException $e){
        echo "Error" . $e->getMessage();
    }

?>