<?php 

    session_start();

    try{

        $conn = new PDO('mysql:host=localhost;dbname=fatec', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $nome = $_POST['nome'];
        $email = $_POST['email'];

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
            $_SESSION['error_email_invalido_newslatter'] = true;
            header("Location: ../" . $url . "#newslatter");
        } else{
            
            $stmt = $conn->query("SELECT * FROM newslatter WHERE new_email = '$email'");
            $stmt = $stmt->rowCount();

            if($stmt != 0){
                $_SESSION['error_email_cadastrado'] = true;
                header("Location: ../" . $url . "#newslatter");
            } else{

                $stmt = $conn->prepare("INSERT INTO newslatter(new_nome, new_email) VALUES(:new_nome, :new_email)");
                $stmt->execute(array(
                    'new_nome' => $nome,
                    'new_email' => $email
                ));

                $_SESSION['success_email_cadastrado'] = true;
                header("Location: ../" . $url . "#newslatter");
            }

        }
        

    } catch(PDOException $e){
        echo "Erro" . $e->getMessage();
    }

?>