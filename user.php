<?php

    session_start();
    include_once('controller/verifySession.php');

    if(!isset($_SESSION['verificado'])){
        $admin = $_POST['admin'];
        $id = $_POST['id'];
    
        if($admin == 1){
            header('Location: user_admin.php');
        }
    }

    $urlAtual = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    $dados = $_SESSION['dados'];

    if(!$dados['user_pic'] == ''){
        $foto = explode("/", $dados['user_pic']);
        $foto = $foto[5];
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
        <div class="padding-left title-banner">
            <p class="title color-white">
                Informações da<br>
                Conta
            </p> 
        </div>
    </div>
</section>


<!-- CONFIGS -->
<main class="container">

    <?php if(isset($_SESSION['sucess_update'])): ?>
        <div class="notification is-success is-light margin-top">
            <button class="delete"></button>
            Conta Atualizada com Sucesso!
        </div>
    <?php endif; unset($_SESSION['sucess_update']);?>

    <form action="controller/updateUser.php" method="post" class="columns padding-standard">
        <div class="column is-half">

            <div class="field">
                <label for="nome" class="size-22 lighter">Nome</label>
                <input type="text" id="nome" class="input is-normal" name="nome" value="<?php echo $dados['user_nome']; ?>">
            </div>

            <div class="field">
                <label for="email" class="size-22 lighter">Email</label>
                <input type="text" id="email" class="input is-normal" name="email" value="<?php echo $dados['user_email']; ?>">
            </div>

            <div class="field">
                <label for="pass" class="size-22 lighter">Senha</label>
                <input type="text" id="pass" class="input is-normal" name="pass" value="<?php echo $dados['user_pass']; ?>">
            </div>

            <div class="field">
                <label for="github" class="size-22 lighter">GitHub</label>
                <input type="text" id="github" class="input is-normal" name="github" value="<?php echo $dados['user_github']; ?>">
            </div>

            <div class="field">
                <label for="linkedin" class="size-22 lighter">Linkedin</label>
                <input type="text" id="linkedin" class="input is-normal" name="linkedin" value="<?php echo $dados['user_linkedin']; ?>">
            </div>

            <div class="field">
                <label for="bio" class="size-22 lighter">Biografia</label>
                <textarea class="textarea" id="bio" rows="5" name="bio"><?php echo $dados['user_bio']; ?></textarea>
            </div>

        </div>

        <div class="column">

            <div class="field">
                <label for="instagram" class="size-22 lighter">Instagram</label>
                <input type="text" id="instagram" class="input is-normal"  name="instagram" value="<?php echo $dados['user_instagram']; ?>">
            </div>

            <div class="field">
                <label for="foto" class="size-22 lighter">Foto</label>
                    <i class="far fa-question-circle margin-left pointer" onClick="openGif()"></i>
                <p class="control">
                    <input type="text" id="foto" class="input is-normal" name="foto" value="<?php echo $dados['user_pic']; ?>">
                </p>
                <img src="./public/images/gif.gif" alt="Como selecionar o link da foto" id="gif" class="display-none">
            </div>

            <?php if(!$dados['user_pic'] == ''): ?>
                <img src="https://docs.google.com/uc?id=<?php echo $foto; ?>" class="img-perfil">
            <?php endif; ?>

            <input type="submit" value="Salvar" class="button btn-login center">
        </form>
        
    </div>
</main>


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