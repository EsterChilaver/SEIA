
<!DOCTYPE html>
<html lang="ptb">
    
  <head>
    <title>SEIA - Sistema de Ensino Baseado em Inteligência Artificial</title>
    <link rel="shortcut icon" href="/SEIA/media/icone_seia.svg"></link>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/SEIA/style/header.css">
    <link rel="stylesheet" href="/SEIA/style/body.css">
    <link rel="stylesheet" href="/SEIA/style/responsivo.css">
    <link rel="stylesheet" href="/SEIA/style/animacoes.css">
    <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </head>

  <body> 
    
  <header id="header-normal">

    <nav>

      <img class="logo" src="/SEIA/media/logo_seia_branco.svg"></img>

      <div class="mobile-menu">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
      </div>

      <ul class="nav-list" id="nav-list-normal">
        <a href="index.php?action=loginForm"><li><p>Entrar</p></li></a>
        <!--<li><p>Esqueceu a senha? Então <a class='text-danger text-underline' href="index.php?action=passRecovery"><u>Recupere sua senha</u></a>!</p></li>-->
        <a href="index.php?action=showTherms"><li class="criar-conta"><p>Criar conta</p></li></a>
      </ul>

    </nav>  

  </header><!--cabecalho-->

<div class="corpo">

  <div class="container" id="tela-inicial">

      <div class="desenho-e-texto">

        <div class="desenho">

          <img src="/SEIA/media/vetores/balao.svg" id="balao"></img>
          <img src="/SEIA/media/vetores/nuvens.svg" id="nuvens"></img>

        </div>

        <div class="texto">

          <h1>Sobre o SEIA</h1>

          <div class="barra-horizontal"></div>

          <p class="texto-conteudo">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet tellus gravida, consectetur nisl in, ornare libero. Suspendisse lacinia felis tincidunt magna facilisis, eu lacinia urna finibus. Phasellus massa mi, laoreet quis convallis sit amet, vulputate ut tortor. Fusce condimentum orci et neque volutpat, id suscipit sem auctor.</p>
        
        </div>

      </div>

  </div>

</div>

<footer>

  <p>Este sistema está em desenvolvimento na Universidade Federal do ABC. Esta é a versão de testes.</p>

</footer> 

  <script src="/SEIA/scripts/mobile-navbar.js"></script>

  </body>
</html>