<?php
if (!defined('ROOTPATH')) {
    require '../root.php';
}

$sel_lang = "ptb";
require ROOTPATH . '/lang/' . $sel_lang . "/auth/login.php";

?>
<!DOCTYPE html>
<html lang="ptb">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="/SEIA/media/icone_seia.svg"></link>
  <link rel="stylesheet" href="/SEIA/style/header.css">
    <link rel="stylesheet" href="/SEIA/style/body.css">
    <link rel="stylesheet" href="/SEIA/style/responsivo.css">
    <link rel="stylesheet" href="/SEIA/style/animacoes.css">
  <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"-->
  <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"-->
  <script src="/SEIA/scripts/mobile-navbar.js"></script>
  <script src="/SEIA/scripts/mostrar_senha.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<header id="header-branco">

    <nav>

      <img class="logo" src="/SEIA/media/logo_seia.svg"></img>

      <div class="mobile-menu">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
      </div>

      <ul class="nav-list">
        <!--<li><p>Esqueceu a senha? Então <a class='text-danger text-underline' href="index.php?action=passRecovery"><u>Recupere sua senha</u></a>!</p></li>-->
        <a href="index.php?action=showTherms"><li class="criar-conta"><p>Criar conta</p></li></a>
      </ul>

    </nav>  

</header><!--cabecalho-->
  
<div class="corpo">

    <div class="container" id="tela-login">

        <?php if(isset($data['error']) && $data['error']){ ?>
            <div class="alert alert-danger" role="alert">
            Nome de usuário ou senha errados.
            </div>
        <?php } ?>
                
            
        <h2><?php echo $lang['login_header'];?></h2>

        <div class="desenho-e-texto">
            
                <div class="texto">

                    <form action="index.php?action=login" method="post" class="formulario-login">

                        <div class="form-group">
                            <label for="sigin_username"><?php echo $lang['login_username'];?></label>
                            <input type="text" class="form-control" id="sigin_username" name="sigin_username">
                        </div>

                        <div class="form-group">
                            <label for="sigin_pass"><?php echo $lang['login_pass'];?></label>
                            <input type="password" class="form-control" id="sigin_pass" name="sigin_pass">
                            <div id="olho-senha" class="lnr-eye" onclick="mostrarSenha()">
                                <img src="/SEIA/media/icones/mostrar_senha.svg"></img>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                <?php echo $lang['login_button'];?>
                            </button>
                        </div>

                        <a class='text-danger text-underline' href="index.php?action=passRecovery">
                            <p>Esqueceu nome de usuário ou senha?</p>
                        </a>
                    
                    </form>
                
                </div>

                <div class="barra-vertical"></div>

                <div class="barra-horizontal"></div>

                

                <div class="desenho" id="cerebro-carregando">
                    <img src="/SEIA/media/vetores/cerebro_carregando.svg"></img>
                </div>

        </div>    
        
    </div><!--container-->

</div>

<footer>

  <p>Este sistema está em desenvolvimento na Universidade Federal do ABC. Esta é a versão de testes.</p>

</footer>

</body>
</html>