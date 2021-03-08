<?php 

    session_start();

    try{

        $conn = new PDO('mysql:host=localhost;dbname=fatec', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $id_post = $_POST['id_post'];

        if(isset($_POST['accept'])){
            $status = $_POST['accept'];
        } else{
            $status = $_POST['denied'];
        }

        $status = str_split($status, 1);
        $status = $status[0];


        if($status == 'A'){
            $decider = 1;
        } else{
            $decider = 3;
        }

        $stmt = $conn->prepare("UPDATE post SET post_postado = :decider WHERE post_id = :id_post");
        $stmt->execute(array(
            'decider' => $decider,
            'id_post' => $id_post
        ));

        if($decider == 1){
            $_SESSION['success_was_blog'] = true;
        } else{
            $_SESSION['success_wasnt_blog'] = true;
        }

        header('Location: ../user_admin.php');


    } catch(PDOException $e){
        echo "Error" . $e->getMessage();
    }

?>