<?php

    session_start();

    try{

        $conn = new PDO('mysql:host=localhost;dbname=fatec', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $content = $_POST['content'];
        $id_escritor = $_POST['id_escritor'];

        if($_SESSION['dados']['is_admin'] == 1){
            $local_do_id = "admin_id";
        } else{
            $local_do_id = "user_id";
        }

        $data = date('Y/m/d');

        $stmt = $conn->prepare("INSERT INTO post(post_title, post_subtitle, post_content, post_date, post_postado, $local_do_id) VALUES(:title, :subtitle, :content, :dia, :postado ,:id)");

        $stmt->execute(array(
            'title' => $title,
            'subtitle' => $subtitle,
            'content' => $content,
            'dia' => $data,
            'postado' => 0,
            'id' => $id_escritor
        ));

        $_SESSION['success_send_post'] = true;
        header('Location: ../escrever.php');

    } catch(PDOException $e){
        echo "Error" . $e->getMessage();
    }

?>