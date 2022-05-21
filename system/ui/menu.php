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

        <div class="icone-usuario">
            <a href="<?php echo BASE_URL. "/professional"; ?> ">
                <img class="img-fluid rounded" src="<?php echo BASE_URL;?>/data/user/<?php echo $user_id;?>/avatar.png">
            </a>
        </div>

    </nav>

</header>

<!-- Menu -->