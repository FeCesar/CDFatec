<?php

    session_start();
    
    include_once('controller/verifySession.php');
    include_once('controller/verifySessionAdmin.php');
    
    $urlAtual = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    try{

        $conn = new PDO('mysql:host=localhost;dbname=fatec', 'root' , '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $id_post = $_GET['id'];

        $stmt = $conn->query("SELECT * FROM post WHERE post_id = $id_post");
        $dados_post = $stmt->fetch(PDO::FETCH_ASSOC);

        if($dados_post['admin_id'] != NULL){
            $tabela = "administrador";
            $coluna = "admin_id";
            $default = "admin_";

        } else{
            $tabela = "user";
            $coluna = "user_id";
            $default = "user_";
        }

        $id_usuario = $dados_post[$coluna];

        $stmt = $conn->query("SELECT * FROM $tabela WHERE $coluna = $id_usuario");
        $dados_escritor = $stmt->fetch(PDO::FETCH_ASSOC);

        $dados_escritor[$default . 'pic'] = explode("/", $dados_escritor[$default . 'pic']);
        $dados_escritor[$default . 'pic'] = $dados_escritor[$default . 'pic'][5];
        
        $date = new DateTime($dados_post['post_date']);

    } catch(PDOException $e){
        echo "Error" . $e->getMessage();
    }


?>


<!DOCTYPE html>
<html lang="pt_br">
<head>
<!-- Responsive -->
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Icon -->
<link rel="shortcut icon" href="./public/images/logo.png" type="image/x-icon" />

<!-- Default CSS -->
<link rel="stylesheet" href="./public/styles/default.css" />
<link rel="stylesheet" href="./public/styles/espacamentos.css" />
<link rel="stylesheet" href="./public/styles/navbar.css" />
<link rel="stylesheet" href="./public/styles/colors.css" />
<link rel="stylesheet" href="./public/styles/bordes.css" />
<link rel="stylesheet" href="./public/styles/texts.css" />
<link rel="stylesheet" href="./public/styles/displays.css" />
<link rel="stylesheet" href="./public/styles/homepage.css" />
<link rel="stylesheet" href="./public/styles/curso.css" />
<link rel="stylesheet" href="./public/styles/faq.css" />
<link rel="stylesheet" href="./public/styles/footer.css" />
<link rel="stylesheet" href="./public/styles/buttons.css" />
<link rel="stylesheet" href="./public/styles/perfil.css" />
<link rel="stylesheet" href="./public/styles/tables.css" />
<link rel="stylesheet" href="./public/styles/post.css" />

<!-- Bulma -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css" />
<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>

<!-- SCRIPT MOBILE BUTTON -->
<script src="./public/javascript/btn-mobile.js"></script>
<!-- SCRIPT MODAL BUTTON -->
<script src="./public/javascript/btn-modal.js"></script>
<!-- SCRIPT FAQ BUTTON -->
<script src="./public/javascript/btn-faq.js"></script>
<!-- SCRIPT NOTIFICACAO -->
<script src="./public/javascript/notificacao.js"></script>
<!-- SCRIPT ABRE GIF -->
<script src="./public/javascript/btn-abre-gif.js"></script>

<title>Ciência de Dados - FATEC</title>
</head>
<body>
<!-- NAVBAR -->
<header class="container">
    <nav class="navbar is-fixed-top padding-right padding-left bg-white" role="navigation" aria-label="main navegation">
        <div class="navbar-brand">
            <a href="index.php#homepage" class="navbar-item"><img src="./public/images/logo.png" alt="logo" style="max-height: 4rem"></a>
            <!-- MENU MOBILE -->
            <a role="button" class="navbar-burger btn-mobile" aria-label="menu" aria-expanded="false" data-target="navMenu">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <!-- MENU DESKTOP -->
        <div id="navMenu" class="navbar-menu">
            <div class="navbar-start margin-left-short">
                <a href="index.php#sobre" class="navbar-item">Sobre</a>
                <a href="index.php#curso" class="navbar-item">Curso de Férias</a>
                <a href="index.php#faq" class="navbar-item">Perguntas Frequentes</a>
                <a href="blog.php" class="navbar-item">Blog</a>
            </div>
            <!-- BUTTONS OF NAVBAR END -->


            <?php if(isset($_SESSION['dados'])){ ?>
                <?php if($_SESSION['dados']['is_admin'] == 1){$admin = 1; $id = $_SESSION['dados']['admin_id'];}else{$admin = 0; $id = $_SESSION['dados']['user_id'];} ?>
                <!-- LOGADO  -->
                <div class="navbar-end">
                    <div class="navbar-item">
                        <div>
                            <form action="user.php" method="post">
                                <input type="hidden" name="admin" value="<?php echo $admin; ?>">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <label for="submit"><i class="far fa-user pointer"></i></label>
                                <input id="submit" type="submit" value="enviar" class="display-none">
                                <a href="controller/logout.php?a=<?php echo $urlAtual; ?>"><i class="fas fa-sign-out-alt color-purple"></i></a>
                            </form>      
                        </div>
                    </div>
                </div>
            <?php } else{ ?>
                <!-- SEM LOGAR -->
                <div class="navbar-end">
                    <div class="navbar-item">
                        <div>
                            <a class="button btn-login" onClick="openModal('modalRegistro')"><strong>Cadastar</strong></a>
                            <a class="button btn-login" onClick="openModal('modalLogar')">Entrar</a>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if(isset($_SESSION['sucess_conta_criada'])): ?>
                <div class="notification is-success is-light">
                    <button class="delete"></button>
                    Conta Criada com Sucesso!
                </div>
            <?php endif; unset($_SESSION['sucess_conta_criada']);?>

        </div>
    </nav>
</header>
<!-- MODAL LOGIN -->
<div class="modal" id="modalLogar">
    <div class="modal-background"></div>
        <div class="card">
            <header class="modal-card-head">
                <p class="modal-card-title">Entrar</p>

                <!-- ERRO EMAIL INVÁLIDO -->
                <?php if(isset($_SESSION['error_email_invalido'])): ?>
                    <h3 class="has-text-danger padding-standard">Insira um Email Válido!</h3>
                <?php endif; unset($_SESSION['error_email_invalido']);?>

                <!-- ERRO CONTA INEXISTENTE -->
                <?php if(isset($_SESSION['conta_inexistente'])): ?>
                    <h3 class="has-text-danger padding-standard">Conta Inválida!</h3>
                <?php endif; unset($_SESSION['conta_inexistente']); ?>

            </header>
            <section class="modal-card padding-standard">
                <form method="post" action="controller/verifyLogin.php">
                    <div class="field">
                        <p class="control has-icons-left has-icons-right">
                            <input class="input" type="email" name="email" placeholder="Email" required>
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </p>
                    </div>
                    
                    <div class="field">
                        <p class="control has-icons-left">
                            <input class="input" type="password" name="pass" placeholder="Password" required>
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                        </p>

                        <input type="hidden" name="url" value="<?php echo $urlAtual; ?>">
                    </div>
                    <div class="padding-standart">
                        <input type="submit" class="input button bg-purple color-white" value="Entrar">
                    </div>                        
                </form>
            </section>
        </div>
    <button class="modal-close is-large" aria-label="close" onClick="closeModal('modalLogar')"></button>
</div>
<!-- MODAL REGISTRAR -->
<div class="modal" id="modalRegistro">
    <div class="modal-background"></div>
    <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Cadastrar-se</p>

                <!-- ERRO EMAIL INVÁLIDO -->
                <?php if(isset($_SESSION['error_email_invalido_registro'])): ?>
                    <h3 class="has-text-danger padding-standard">Insira um Email Válido!</h3>
                <?php endif; unset($_SESSION['error_email_invalido_registro']);?>

                <!-- ERRO EMAIL INEXISTENTE -->
                <?php if(isset($_SESSION['error_email_utilizado'])): ?>
                    <h3 class="has-text-danger padding-standard">Email já Utilizado!</h3>
                <?php endif; unset($_SESSION['error_email_utilizado']); ?>

            </header>

            <section class="modal-card-body">
                <form method="post" action="controller/verifyCadastro.php">
                    
                    <div class="padding-standart">
                        <label class="label" for="nome">Nome</label>
                        <input type="text" class="input" name="nome" placeholder="Ex.: Felipe Cesar" />
                    </div>
                    <div class="padding-standart">
                        <label class="label" for="email">E-mail</label>
                        <input type="email" class="input" name="email" placeholder="Ex.: seunome@gmail.com" />
                    </div>
                    <div class="padding-standart">
                        <label class="label" for="senha">Senha</label>
                        <input type="text" class="input" name="pass" placeholder="Ex.: !2E21@HT" />
                    </div>
                    <input type="hidden" name="url" value="<?php echo $urlAtual; ?>">
                    <div class="padding-standart">
                        <input type="submit" class="input button bg-purple color-white margin-top" value="Cadastrar">
                    </div>
                </form>
            </section>
        </div>
    <button class="modal-close is-large" aria-label="close" onClick="closeModal('modalRegistro')"></button>
</div>

<!-- HOMEPAGE -->
<section class="hero banner is-halfheight" id="homepage">
    <div class="hero-body">
        <div class="padding-left title-banner margin-top">
            <p class="title color-white">
                <?php echo $dados_post['post_title']; ?>
            </p> 
            <p class="subtitle color-white" style="width: 50%;">
                <?php echo $dados_post['post_subtitle']; ?>
            </p>
        </div>
    </div>
</section>

<main class="container">
    <div class="text">
        <div>
            <?php echo $dados_post['post_content']; ?>
        </div>

        <div id="autor"></div>

        <div class="autor">
            <div class="columns">
                <div class="column is-half">
                    <div class="circle photo" style="background: url('https://docs.google.com/uc?id=<?php echo $dados_escritor[$default . 'pic']; ?>'); background-size: 100%;"></div>    
                </div>
                <div class="column margin-top">
                    <h3><?php echo $dados_escritor[$default . 'nome']; ?></h3>
                    <p><?php echo $dados_escritor[$default . 'bio']; ?></p>
                    <p><?php echo $date->format('d/m/Y'); ?></p>

                    <div class="social">
                        <a href="<?php if($dados_escritor[$default . 'github'] == ''){echo '#autor'; $nada = true;}else{echo $dados_escritor[$default . 'github']; $nada = false;} ?>"  <?php if($nada != true){ echo "target='_blank'";}?>><i class="fab fa-github"></i></a>
                        <a href="<?php if($dados_escritor[$default . 'instagram'] == ''){echo '#autor'; $nada = true;}else{echo $dados_escritor[$default . 'instagram']; $nada = false;} ?>" <?php if($nada != true){ echo "target='_blank'";}?>><i class="fab fa-instagram"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<section class="container padding-standard">
    <form action="controller/postStatus.php" method="post" class="form">
        <input type="hidden" name="id_post" value="<?php echo $id_post; ?>" >
        <input type="submit" name="accept" value="Aceitar Post" class="button btn-login">
        <input type="submit" name="denied" value="Recusar Post" class="button">
    </form>
</section>

<!-- RODAPÉ -->
<footer class="footer banner">
    <div class="content container has-text-centered">
        <div class="columns">
            <div class="column is-half">
                <ul>
                    <li><h3 class="color-white">Contato</h3></li>

                    <i class="far fa-envelope color-white"></i>
                    <li>diretoria@fatec.com</li>
                    <li>fatec@fatec.com</li>

                    <i class="fas fa-phone-alt color-white margin-top"></i>
                    <li>(14) 3323-3721</li>
                    <li>(14) 3343-2212</li>
                </ul>
            </div>
            <div class="column is-half">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3673.9854558809243!2d-49.898355285371196!3d-22.950762745210884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c01976077f0513%3A0x7469ad48478234ac!2sFatec%20Ourinhos!5e0!3m2!1spt-BR!2sbr!4v1614029425312!5m2!1spt-BR!2sbr" 
                width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>  
    </div>
    <h6 class="color-white text-center margin-top">FATEC
        <strong><a href="https://www.fatecourinhos.edu.br/" target="_blank">Ourinhos</a></strong>
    </h6> 
    <h6 class="color-white text-center">Vestibular
        <strong><a href="https://www.vestibularfatec.com.br/" target="_blank">FATEC</a></strong>
    </h6> 
    <h6 class="color-white text-center">Desenvolvido por 
        <strong><a href="https://www.github.com/FeCesar" target="_blank">Felipe Cesar</a></strong>
    </h6>  
</footer>

</body>
</html>