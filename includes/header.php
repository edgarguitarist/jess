<?php
$logo="http://".$_SERVER['SERVER_NAME']."/images/footer-logo.png";
$salir="http://".$_SERVER['SERVER_NAME']."/images/salir.png";
?>

<header>
  <div class="header">
    <div class="mitad1">
      <h1 style="align-self:center;">Resultados de Evaluaciónes</h1>
      <img style="margin-left:25%; padding-bottom:0.2em;" src="<?php echo $logo; ?>" alt="LOGO">
    </div>
    <div class="mitad2">
      <div class="optionsBar">
        <p style="color: #013C80;">Ecuador, <?php echo fechaC(); ?></p>
        <span>|</span>
        <p class="user"> <?php echo $_SESSION['user']/*.' - '.$_SESSION['id']*/; ?></p>
        <span>|</span>
        <a href="salir.php"><img class="close" src="<?php echo $salir; ?>" alt="Salir del sistema"  title="Salir"></a>
      </div>
    </div>
  </div>
  <?php include "nav.php"; ?>
</header>
