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
    <link rel="stylesheet" href="./public/styles/ciencia-dados.css" />

    <!-- Bulma -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css" />
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>

    <!-- SCRIPT MOBILE BUTTON -->
    <script src="./public/javascript/btn-mobile.js"></script>
    <!-- SCRIPT MODAL BUTTON -->
    <script src="./public/javascript/btn-modal.js"></script>

    <title>Ciência de Dados - FATEC</title>
</head>
<body>
    <!-- NAVBAR -->
    <header class="container">
        <nav class="navbar is-fixed-top padding-right padding-left" role="navigation" aria-label="main navegation">
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
                    <a href="#blog" class="navbar-item">Blog</a>
                </div>
                <!-- BUTTONS OF NAVBAR END -->
                <div class="navbar-end">
                    <div class="navbar-item">
                        <div>
                            <a class="button bg-standard color-white border-none" onClick="openModal('modalRegistro')"><strong>Cadastar</strong></a>
                            <a class="button bg-standard color-white border-none" onClick="openModal('modalLogar')">Entrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- MODAL LOGIN -->
    <div class="modal" id="modalLogar">
        <div class="modal-background"></div>
            <div class="card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Entrar</p>
                </header>
                <section class="modal-card padding-standard">
                    <form method="post" action="#">
                        <div class="field">
                            <p class="control has-icons-left has-icons-right">
                                <input class="input" type="email" name="email" placeholder="Email">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </p>
                        </div>
                        
                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input" type="password" name="pass" placeholder="Password">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </p>
                        </div>
                        <div class="padding-standart">
                            <input type="submit" class="input button bg-standard color-white" value="Entrar">
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
                            <input type="submit" class="input button bg-standard color-white margin-top" value="Cadastrar">
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
            <button class="button is-medium is-fullwidth bg-transparent color-white">Vestibular</button>
            </div>
        </div>
    </section>

    <!-- SECTION -->
    <section class="section is-medium" id="sobre">
        <h1 class="title text-center padding-title">O QUE É CIÊNCIA DE DADOS?</h1>
        <h2 class="subtitle text-center padding-subtitle">
            Ciência de Dados é uma área interdisciplinar que engloba matemática, estatística, programação, 
            conhecimento de negócio e comunicação. Um  profissional Cientista de Dados busca obter insights através de análises/ 
            estudos de dados para auxiliar a empresa na hora de uma tomada de decisão.
        </h2>
    </section>

    <!-- Social Medias -->
    <section class="hero is-primary banner">
        <div class="hero-body">
            <nav class="level">
                <div class="level-item has-text-centered">
                    <div>
                    <p class="heading">Instagram</p>
                    <p class="title"><i class="fab fa-instagram"></i></p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                    <p class="heading">Seguindo</p>
                    <p class="title">123</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                    <p class="heading">Seguidores</p>
                    <p class="title">456K</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                    <p class="heading">Total de Likes</p>
                    <p class="title">789</p>
                    </div>
                </div>
            </nav>
        </div>
    </section>

    <!-- SECTION CURSO DE FÉRIAS -->
<section class="section is-medium" id="curso">
    <h1 class="title text-center padding-title">MINI CURSO DE FÉRIAS</h1>
    <h2 class="subtitle text-center padding-subtitle">
        O Mincurso de férias - Python 3 veio para fundamentar a sua base de conhecimento na linguagem de programação Python. 
        Desenvolvido e aplicado por alunos da Fatec Ourinhos, este Minicurso será online e gratuito! 
        Serão trabalhados: Tipos primitivos, Operadores lógicos e matemáticos, Condicionais, 
        Laços de repetição e uma Introdução à Estrutura de Dados. 
    </h2>
    <div class="container">
        <nav class="level margin-top">
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Introdução Ao Python 3</p>
                    <p class="title">12/01</p>
                    <button class="button is-link margin-top bg-standard">Conteúdo</button>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">ESTRUTURAS CONDICIONAIS SIMPLES</p>
                    <p class="title">13/01</p>
                    <button class="button is-link margin-top bg-standard">Conteúdo</button>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">ELIF E FOR</p>
                    <p class="title">18/01</p>
                    <button class="button is-link margin-top bg-standard">Conteúdo</button>
                </div>
            </div>
        </nav>

        <nav class="level margin-top">
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">LAÇOS DE REPETIÇÃO - WHILE</p>
                    <p class="title">19/01</p>
                    <button class="button is-link margin-top bg-standard">Conteúdo</button>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">ESTRUTURA DE DADOS</p>
                    <p class="title">20/01</p>
                    <button class="button is-link margin-top bg-standard">Conteúdo</button>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">BIBLIOTECAS</p>
                    <p class="title">21/01</p>
                    <button class="button is-link margin-top bg-standard">Conteúdo</button>
                </div>
            </div>
        </nav>
    </div>
    </div>
</section>

</body>
</html>