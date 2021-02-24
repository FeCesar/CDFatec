<?php

    try{
        
        $conn = new PDO('mysql:host=localhost;dbname=', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        
        $sql = "CREATE DATABASE IF NOT EXISTS fatec";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();

        if(!$result){
            var_dump($stmt->erroInfo());
            exit;
        }

            $conn->exec("use fatec");

        $sql = "CREATE TABLE IF NOT EXISTS administrador(
            admin_id int primary key auto_increment not null,
            admin_nome varchar(255),
            admin_pic varchar(255),
            admin_email varchar(255),
            admin_pass varchar(255),
            admin_github varchar(255),
            admin_linkedin varchar(255),
            admin_instagram varchar(255)
            )";

        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();

        if(!$result){
            var_dump($stmt->erroInfo());
            exit;
        }

        $sql = "CREATE TABLE IF NOT EXISTS user(
            user_id int primary key auto_increment not null,
            user_nome varchar(255),
            user_email varchar(255),
            user_pass varchar(255),
            admin_github varchar(255),
            admin_linkedin varchar(255),
            admin_instagram varchar(255),
            admin_pic varchar(255)
            )";

        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();

        if(!$result){
            var_dump($stmt->erroInfo());
            exit;
        }

        $sql = "CREATE TABLE IF NOT EXISTS post(
            post_id int primary key auto_increment not null,
            post_title varchar(255),
            post_primeiro_paragrafo text,
            post_segundo_paragrafo text,
            post_terceiro_paragrafo text,
            post_quarto_paragrafo text,
            admin_id int,
                constraint fk_admin_post
                foreign key (admin_id) 
                references administrador(admin_id)
            )";

        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();

        if(!$result){
            var_dump($stmt->errorInfo());
            exit;
        }

        $sql = "CREATE TABLE IF NOT EXISTS comment(
                comment_id int primary key auto_increment not null,
                comment_content text,
                comment_date_time datetime,
                user_id int,
                    constraint fk_user_comment
                    foreign key (user_id)
                    references user (user_id),
                post_id int,
                    constraint fk_post_comment
                    foreign key (post_id)
                    references post(post_id)
            )";

        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();

        if(!$result){
            var_dump($stmt->errorInfo());
            exit;
        }

        header("Location: ../index.php");

    } catch(PDOException $e){
        echo "Error" . $e->getMessage();
    }

?>