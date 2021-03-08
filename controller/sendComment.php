<?php 

    session_start();

    try{

        $conn = new PDO('mysql:host=localhost;dbname=fatec', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $content = $_POST['comentario'];
        $post_id = $_POST['post_id'];
        $is_admin = $_SESSION['dados']['is_admin'];

        if($is_admin == 1){
            $default = "admin_";
        } else{
            $default = "user_";
        }

        $id_user = $_SESSION['dados'][$default . 'id'];

        $data = date('Y/m/d');

        $stmt = $conn->prepare("INSERT INTO comments(comment_content, comment_date_time, is_admin, user_id, post_id) VALUES (
            :conteudo, :data, :admin, :id, :post
        )");

        $stmt->execute(array(
            'conteudo' => $content,
            'data' => $data,
            'admin' => $is_admin,
            'id' => $id_user,
            'post' => $post_id
        ));

        $_SESSION['success_comment'] = true;
        header('Location: ../post.php?id_post=' . $post_id . '#comment');

    } catch(PDOException $e){
        echo "Error" . $e->getMessage();
    }

?>