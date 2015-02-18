<?php
include('private/fonctions.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="script.js"></script>
    <link rel="icon" type="image/png" href="img/mouse.png" />
    <title>A2DF Informatique</title>
<header>
    <p class="flotte">
        <img src="img/mouse.png" alt="logo" />
    </p>
    <div><a href="index.php" style="line-height:80px;" class="logo"  ><h1>A2DF Informatique</h1></a>
        <a href="login.php"><img class="imgco" title='Déconnexion' onmouseout="this.src = 'img/co_off.png'" onmouseover="this.src = 'img/co_on.png'" src="img/co_off.png"/></a>
        <div class="log"><?= $_SESSION['user'] ?></div>
    </div>
</header>
<script>
    function openPopUp(URL) {
        new_window = window.open(URL, 'window',
                'toolbar=0,scrollbars=0,location=0, statusbar=0,menubar=0,resizable=0,width=400,height=415,left = 700,top = 150');
    }
    function closePopUp() {
        new_window.close();
    }
</script>
<div id='cssmenu' class="menu">
    <ul>
        <li><a href='listeAppel.php'><span>Appels</span><img class="imgmenu" src="img/phone.png"/></a></li>
        <li><a href='listeAtelier.php'><span>Atelier</span><img class="imgmenu" src="img/toolbox.png"/></a></li>
        <li><a href='listeCommande.php'><span>Commandes</span><img class="imgmenu" src="img/pci.png"/></a></li>
        <li><a href='listeVente.php'><span>Ventes</span><img class="imgmenu" src="img/cart.png"/></a></li>
        <li><a href='listePret.php'><span>Prêts</span><img class="imgmenu" src="img/receipt_share.png"/></a></li>
        <li><a href='listeClient.php'><span>Clients</span><img class="imgmenu" src="img/group.png"/></a></li>
        <li class='last'><a href='listeSav.php'><span>S.A.V.</span><img class="imgmenu" src="img/small_business.png"/></a></li>

        <?php
        if ($_SESSION['user'] == "direction") {
            echo "<br />
        <li><a href='#'><span><s>Comptabilité</s></span><img class='imgmenu' src='img/chart.png'/></a></li>
        <li><a href='listeFournisseur.php'><span>Fournisseurs</span><img class='imgmenu' src='img/lorry.png'/></a></li>
        <li><a href='listePersonnel.php'><span>Personnel</span><img class='imgmenu' src='img/staff.png'/></a></li>
        <li class='last'><a href='listeSession.php'><span>Sessions</span><img class='imgmenu' src='img/lock.png'/></a></li>
        <br /> 
        <li class='last'><a href='listeProduit.php'><span>Magasin</span><img class='imgmenu' src='img/shop.png'/></a></li>";
        }
        ?>
    </ul>
    <br>
    <div class='report'><a href='report.php'><span>Signaler un bug</span></a></div>
</div>

<script>
    var halt = 0;

    function haltTimer() {
        halt = 1;
    }

    function refreshOnIdle() {
        if (halt == 0) {
            window.location.reload();
        }
        else {
            halt = 0;
            window.setTimeout("refreshOnIdle();", 300000);
        }
    }
</script>
</head>
