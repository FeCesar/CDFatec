<?php

    session_start();

    try{

        $conn = new PDO('mysql:host=localhost;dbname=fatec', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $email = $_POST['email'];
        $pass = md5($_POST['pass']);
        
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

        if(!verificaEmail($email)){
            $_SESSION['error_email_invalido'] = true;
            header("Location: ../" . $url);
        }



        $sql = "SELECT * FROM administrador WHERE admin_email = '$email' and admin_pass = '$pass'";
        $stmtAdmin = $conn->query($sql);
        $linhasAdmin = $stmtAdmin->rowCount();

        $sql = "SELECT * FROM user WHERE user_email = '$email' and user_pass = '$pass'";
        $stmtUser = $conn->query($sql);
        $linhasUser = $stmtUser->rowCount();

        if($linhasAdmin != 0){
            
            $row = $stmtAdmin->fetch(PDO::FETCH_ASSOC);
            $_SESSION['dados'] = $row;
            header("Location: ../" . $url);

        } 

        elseif($linhasUser != 0){

            $row = $stmtUser->fetch(PDO::FETCH_ASSOC);
            $_SESSION['dados'] = $row;
            header("Location: ../" . $url);

        }
        
        else{
            $_SESSION['conta_inexistente'] = true;
            header("Location: ../" . $url);
        }

    } catch(Exception $e){
        echo "Error" . $e->getMessage();
    }

?>