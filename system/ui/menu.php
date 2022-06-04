<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$sel_lang = "ptb";
if(!defined('ROOTPATH')){
    require '../root.php';
}
require ROOTPATH . '/lang/' . $sel_lang . "/menu.php";
require_once ROOTPATH . '/utils/GetData.php';


require_once ROOTPATH . '/utils/checkUser.php';
checkUser(["professional","admin","student"], BASE_URL);


$user_id = $_SESSION['username'];
?>

<!-- Menu bts-->

<body>

<div class="conteiner-modal">
    <div class="modal" id="trocar-avatar">

        <div class="fechar-modal" onclick="fecharModal()">
            <img src="/SEIA/media/icones/cancelar_branco.svg"></img>
        </div>

        <h2>Mudar foto de perfil<div class="barra-horizontal"></div></h2>
        
        <form id="swapAvatarTemplate"class="d-none" enctype="multipart/form-data" autocomplete="off" action="" method="post">
    
            <div class="input-group mb-3">
                <input name="student_id" id="student_id" type="text" hidden value="<?php echo $student_data['id'];?>">
                <input required name="stimuli_file" id="stimuli_image" onchange="modal_loadFile(event)" class="inputFile" accept="image/*" type="file" style="display: none;">

                <div class="input-group-prepend">
                    <button  onclick="document.querySelector('#stimuli_image').click();"class="btn btn-outline-secondary" type="button">Selecionar arquivo</button>
                </div>

                <input id="inp_fileName" type="text" readonly class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">

            </div>

            <div class="container" id="preview"></div>

            <div class="modal-footer">
                <button id="modal-accept" type="button" class="btn btn-primary">Confirmar</button>
            </div>

        </form>

    </div>
</div>

<div id="menu-usuario">

    <nav>

        <div class="fechar-modal" onclick="fecharMenu()">
            <img src="/SEIA/media/icones/cancelar_branco.svg"></img>
        </div>

        <div class="area-img-user">
            <div class="img-user">
                <img class="img-fluid rounded" src="<?php echo BASE_URL;?>/data/user/<?php echo $user_id;?>/avatar.png">
            </div>
        </div>

        <p><?php echo $user_id;?></p>

        <ul>
            <li>
                <button onclick="janelaModal()" class=" mt-1 btn btn-danger btn-lg btn-block border border-dark "type="button">
                    <img src="/SEIA/media/menu_usuario/camera_fotografica.svg">Mudar foto de perfil</button>
            </li>

            <a href="<?php echo BASE_URL;?>/auth/index.php?action=changePassword" type="button">                
                <li><img src="/SEIA/media/menu_usuario/configuracoes.svg">Alterar senha</li>
            </a>

            <a href="<?php echo BASE_URL;?>/auth/index.php?action=logout" type="button">
                <li><img src="/SEIA/media/menu_usuario/logout.svg">Sair</li>
            </a>
        </ul>

    </nav>

</div><!--menu-usuario-->

<div class="fundo-escuro" onclick="fecharMenu()"></div>

<header id="header-normal" class="menu">

    <!--<nav>

        <<button id="UIMenu" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>Menu
        </button>

    </nav>-->    

    <nav><!-- Links -->

        <img class="logo" src="/SEIA/media/icone_seia_branco.svg"></img>

        <div class="mobile-menu">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>

        <ul>

            <a href="<?php echo BASE_URL . "/activity";?>">
                <li>
                    <img class="icone-branco" src="/SEIA/media/header/minhas_atividades.svg"></img>
                    <img class="icone-azul" src="/SEIA/media/header/minhas_atividades_azul.svg"></img>
                    <p><?php echo $lang["activities"];?></p>
                </li>
            </a>

            <a href="<?php echo BASE_URL . "/stimuli";?>">
                <li>
                    <img class="icone-branco" src="/SEIA/media/header/estimulos.svg"></img>
                    <img class="icone-azul" src="/SEIA/media/header/estimulos_azul.svg"></img>
                    <p><?php echo $lang["stimuli"];?></p>
                </li>
            </a>

            <a href="<?php echo BASE_URL . "/professional?action=student";?>">
                <li>
                    <img class="icone-branco" src="/SEIA/media/header/estudantes.svg"></img>
                    <img class="icone-azul" src="/SEIA/media/header/estudantes_azul.svg"></img>
                    <p><?php echo $lang["students"];?></p>
                </li>
            </a>
                        
            <a href="<?php echo BASE_URL . "/activity/index.php?action=reinforcementIndex";?>">
                <li>
                    <img class="icone-branco" src="/SEIA/media/header/reforcos.svg"></img>
                    <img class="icone-azul" src="/SEIA/media/header/reforcos_azul.svg"></img>
                    <p><?php echo $lang["reforcos"];?></p>
                </li>
            </a>
                        
            <a href="<?php echo BASE_URL . "/activity/index.php?action=userTemplateIndex";?>">
                <li>
                    <img class="icone-branco" src="/SEIA/media/header/repositorio.svg"></img>
                    <img class="icone-azul" src="/SEIA/media/header/repositorio_azul.svg"></img>
                    <p>Templates</p>
                </li>
            </a>            

        </ul>

        <div class="icone-usuario" onclick="exibirMenu()">

            <div class="mais-usuario">
                <div class="bolinha"></div>
                <div class="bolinha"></div>
                <div class="bolinha"></div>
            </div>

            <a href="<?php echo BASE_URL. "/professional"; ?> ">
                <img class="img-fluid rounded" src="<?php echo BASE_URL;?>/data/user/<?php echo $user_id;?>/avatar.png">
            </a>
            
        </div>

    </nav>

</header>

<!-- Menu -->