<?php

    session_start();

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

    <!-- Bulma -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css" />
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>

    <!-- SCRIPT MOBILE BUTTON -->
    <script src="./public/javascript/btn-mobile.js"></script>
    <!-- SCRIPT MODAL BUTTON -->
    <script src="./public/javascript/btn-modal.js"></script>
    <!-- SCRIPT FAQ BUTTON -->
    <script src="./public/javascript/btn-faq.js"></script>

    <title>Ciência de Dados - FATEC</title>
</head>
<body>
    <!-- NAVBAR -->
    <header class="container">
        <nav class="navbar is-fixed-top padding-right padding-left bg-white" role="navigation" aria-label="main navegation">
            <div class="navbar-brand">
                <a href="#homepage" class="navbar-item"><img src="./public/images/logo.png" alt="logo" style="max-height: 4rem"></a>
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
                    <a href="#sobre" class="navbar-item">Sobre</a>
                    <a href="#curso" class="navbar-item">Curso de Férias</a>
                    <a href="#faq" class="navbar-item">Perguntas Frequentes</a>
                    <a href="blog.php" class="navbar-item">Blog</a>
                </div>
                <!-- BUTTONS OF NAVBAR END -->

                <?php if(isset($_SESSION['dados'])){ ?>
                    <!-- LOGADO  -->
                    <div class="navbar-end">
                        <div class="navbar-item">
                            <div> 
                                <a href="#"><i class="far fa-user btn-user"></i></a>
                                <a href="controller/logout.php"><i class="fas fa-sign-out-alt color-purple"></i></a>
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
                        <h3 class="has-text-danger">Insira um Email Válido!</h3>
                    <?php endif; unset($_SESSION['error_email_invalido']);?>

                    <!-- ERRO CONTA INEXISTENTE -->
                    <?php if(isset($_SESSION['conta_inexistente'])): ?>
                        <h3 class="has-text-danger">Conta Inválida!</h3>
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
                </header>
                <section class="modal-card-body">
                    <form method="post" action="#">
                        
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
                            <input type="text" class="input" name="senha" placeholder="Ex.: !2E21@HT" />
                        </div>
                        <div class="padding-standart">
                            <input type="submit" class="input button bg-purple color-white margin-top" value="Cadastrar">
                        </div>
                    </form>
                </section>
            </div>
        <button class="modal-close is-large" aria-label="close" onClick="closeModal('modalRegistro')"></button>
    </div>

    <!-- HOMEPAGE -->
    <section class="hero banner is-fullheight" id="homepage">
        <div class="hero-body">
            <div class="padding-left">
                <p class="title color-white">
                    Ciência de Dados<br>
                    Fatec Ourinhos
                </p>
                <p class="subtitle color-white">
                    Venha estudar com a gente!
                </p>
                <button class="button is-medium is-fullwidth btn-banner">Vestibular</button>
            </div>
        </div>
    </section>

    <!-- O QUE É CIENCIA DE DADOS -->
    <section class="section is-medium bg-white" id="sobre">
        <h1 class="title container">O QUE É CIÊNCIA DE DADOS?</h1>
        <h2 class="subtitle container">
            Ciência de Dados é uma área interdisciplinar que engloba matemática, estatística, programação, 
            conhecimento de negócio e comunicação. Um  profissional Cientista de Dados busca obter insights através de análises/ 
            estudos de dados para auxiliar a empresa na hora de uma tomada de decisão.
        </h2>
    </section>

    <!-- Social Medias -->
    <section class="hero banner">
        <div class="hero-body">
            <nav class="level">
                <div class="level-item has-text-centered">
                    <div>
                    <p class="heading color-white">Instagram</p>
                    <p class="title color-white"><i class="fab fa-instagram"></i></p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                    <p class="heading color-white">Seguindo</p>
                    <p class="title color-white">123</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                    <p class="heading color-white">Seguidores</p>
                    <p class="title color-white">456K</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                    <p class="heading color-white">Total de Likes</p>
                    <p class="title color-white">789</p>
                    </div>
                </div>
            </nav>
        </div>
    </section>

    <!-- CURSO -->
    <section id="curso">
        <section class="section is-medium">
            <h1 class="title container">MINI CURSO DE FÉRIAS</h1>
            <h2 class="subtitle container">
                O Mincurso de férias - Python 3 veio para fundamentar a sua base de conhecimento na linguagem de programação Python. 
                Desenvolvido e aplicado por alunos da Fatec Ourinhos, este Minicurso será online e gratuito! Serão trabalhados: 
                Tipos primitivos, Operadores lógicos e matemáticos, Condicionais, Laços de repetição e uma Introdução à Estrutura de Dados. 
            </h2>
        </section>

        <div class="container">
            <div class="columns">
                <div class="column is-one-third caixa">
                    <header class="caixa-header">
                        <h3>INTRODUÇÃO AO PYTHON 3<h3>
                    </header>
                    <main class="caixa-content">
                        <p >12/01</p>
                        <p>19H30</p>
                        <button class="border-radius border-none padding-standard margin-top"><a href="https://drive.google.com/drive/folders/12eeGOIrUvekLRojctVf_bdr7qeopNIli" target="_blank">Acessar</a></button>
                    </main>
                </div>
                
                <div class="column is-one-third caixa">
                    <header class="caixa-header">
                        <h3>ESTRUTURAS CONDICIONAIS SIMPLES<h3>
                    </header>
                    <main class="caixa-content">
                        <p>13/01</p>
                        <p>19H30</p>
                        <button class="border-radius border-none padding-standard margin-top"><a href="https://drive.google.com/drive/folders/1d6BlbHOqU1D-vdPWBx-kGKJbRLGDNuXM" target="_blank">Acessar</a></button>
                    </main>
                </div>
                
                <div class="column is-one-third caixa">
                    <header class="caixa-header">
                        <h3>ELIF E <br>FOR<h3>
                    </header>
                    <main class="caixa-content">
                        <p >18/01</p>
                        <p>19H30</p>
                        <button class="border-radius border-none padding-standard margin-top"><a href="https://drive.google.com/drive/folders/1GNupw13Ul_yJWMQXX6_7LEbWYSOaM1RE" target="_blank">Acessar</a></button>
                    </main>
                </div>
            </div>
            
            <div class="columns">
                <div class="column is-one-third caixa">
                    <header class="caixa-header">
                        <h3>LAÇOS DE REPETIÇÃO WHILE<h3>
                    </header>
                    <main class="caixa-content">
                        <p >19/01</p>
                        <p>19H30</p>
                        <button class="border-radius border-none padding-standard margin-top"><a href="https://drive.google.com/drive/folders/1r2mEPyGUqNVDP2yqczj1c1MbUTxcmAmx" target="_blank">Acessar</a></button>
                    </main>
                </div>
                
                <div class="column is-one-third caixa">
                    <header class="caixa-header">
                        <h3>ESTRUTURA DE <br>DADOS<h3>
                    </header>
                    <main class="caixa-content">
                        <p >20/01</p>
                        <p>19H30</p>
                        <button class="border-radius border-none padding-standard margin-top"><a href="https://drive.google.com/drive/folders/1PpGtvH9r9aXsGByIGoBwRAsoazMDz5FK" target="_blank">Acessar</a></button>
                    </main>
                </div>
                
                <div class="column is-one-third caixa">
                    <header class="caixa-header">
                        <h3>BIBLIOTECAS <br>PYTHON<h3>
                    </header>
                    <main class="caixa-content">
                        <p >21/01</p>
                        <p>19H30</p>
                        <button class="border-radius border-none padding-standard margin-top"><a href="https://drive.google.com/drive/folders/16CRL6Th3wVqM5V5UNorCkW2A6k76E5-K" target="_blank">Acessar</a></button>
                    </main>
                </div>
            </div>
        </div>        
    </section>


    <!-- FAQ -->
    <article id="faq">
        <header class="banner is-short section">
            <h1 class="color-white container">Perguntas Frequentes</h1>
        </header>
        
        <div class="container">
            <main class="container">

                <header class="header-message">
                    <h2 class="padding-standard">Mini Curso</h2>
                </header>
                <article class="message margin-left margin-right">
                    <div class="message-header pointer bg-purple" id="q11" onClick="openFaq('q1', 'q11')">
                        <p>Será emitido certificado?</p>
                        <span><i class="fas fa-caret-down"></i></span>
                    </div>
                    <div class="display-none message-body" id="q1">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Pariatur laboriosam eius deleniti blanditiis dolore incidunt aliquid 
                        temporibus, consectetur cumque explicabo! Nostrum quo, autem sint omnis facere hic. Molestiae, magnam quia?
                    </div>
                </article>

                <article class="message margin-left margin-right margin-bottom">
                    <div class="message-header pointer " id="q22" onClick="openFaq('q2', 'q22')">
                        <p>As aulas ficam gravadas?</p>
                        <span><i class="fas fa-caret-down"></i></span>
                    </div>
                    <div class="display-none message-body" id="q2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam consectetur odio officiis totam, 
                        amet facere expedita enim qui quod eius adipisci accusamus dolore, rem quo laborum quasi obcaecati error exercitationem.
                    </div>
                </article>

                <header class="header-message">
                    <h2 class="padding-standard">Blog</h2>
                </header>
                <article class="message margin-left margin-right">
                    <div class="message-header pointer bg-purple" id="q33" onClick="openFaq('q3', 'q33')">
                        <p>Preciso de uma conta para ler os posts?</p>
                        <span><i class="fas fa-caret-down"></i></span>
                    </div>
                    <div class="display-none message-body" id="q3">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Pariatur laboriosam eius deleniti blanditiis dolore incidunt aliquid 
                        temporibus, consectetur cumque explicabo! Nostrum quo, autem sint omnis facere hic. Molestiae, magnam quia?
                    </div>
                </article>

                <article class="message margin-left margin-right margin-bottom">
                    <div class="message-header pointer margin-bottom" id="q44" onClick="openFaq('q4', 'q44')">
                        <p>Qualquer um pode escrever um post?</p>
                        <span><i class="fas fa-caret-down"></i></span>
                    </div>
                    <div class="display-none message-body" id="q4">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam consectetur odio officiis totam, 
                        amet facere expedita enim qui quod eius adipisci accusamus dolore, rem quo laborum quasi obcaecati error exercitationem.
                    </div>
                </article>

            </main>
        </div>
    </article>

    
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