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
    <div><a href="http://localhost/A2DF/index.php" style="line-height:80px;" class="logo"  ><h1>A2DF Informatique</h1></a>
         <a href="login.php"><?= $_SESSION['user'] ?><img class="imgco" onmouseout="this.src = 'img/co_off.png'" onmouseover="this.src = 'img/co_on.png'" src="img/co_off.png" /></a>
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
        <li><a href='http://localhost/A2DF/listeAppel.php'><span>Appels</span><img class="imgmenu" src="img/phone.png" alt="phone" /></a></li>
        <li><a href='http://localhost/A2DF/listeAtelier.php'><span>Atelier</span><img class="imgmenu" src="img/toolbox.png" alt="toolbox" /></a></li>
        <li><a href='http://localhost/A2DF/listeCommande.php'><span>Commandes</span><img class="imgmenu" src="img/pci.png" alt="pci" /></a></li>
        <li><a href='#'><span>Ventes</span><img class="imgmenu" src="img/cart.png" alt="cart" /></a></li>
        <li class='last'><a href='#'><span>S.A.V.</span><img class="imgmenu" src="img/small_business.png" alt="SAV" /></a></li>
    </ul>
</div>
</head>