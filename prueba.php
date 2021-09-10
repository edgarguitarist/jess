<script>
(function($) { // Begin jQuery
  $(function() { // DOM ready
    // If a link has a dropdown, add sub menu toggle.
    $('nav ul li a:not(:only-child)').click(function(e) {
      $(this).siblings('.nav-dropdown').toggle();
      // Close one dropdown when selecting another
      $('.nav-dropdown').not($(this).siblings()).hide();
      e.stopPropagation();
    });
    // Clicking away from dropdown will remove the dropdown class
    $('html').click(function() {
      $('.nav-dropdown').hide();
    });
    // Toggle open and close nav styles on click
    $('#nav-toggle').click(function() {
      $('nav ul').slideToggle();
    });
    // Hamburger to X toggle
    $('#nav-toggle').on('click', function() {
      this.classList.toggle('active');
    });
  }); // end DOM ready
})(jQuery); // end jQuery
</script>

<link rel="stylesheet" type="text/css" href="css/nav.scss">

<section class="navigation">
  <div class="nav-container">
    
    <nav>
      <div class="nav-mobile"><a id="nav-toggle" href="#!"><span></span></a></div>
      <ul class="nav-list">
        <li>
          <a href="#!">Home</a>
        </li>
        <li>
          <a href="#!">About</a>
        </li>
        <li>
          <a href="#!">Services</a>
          <ul class="nav-dropdown">
            <li>
              <a href="#!">Web Design</a>
            </li>
            <li>
              <a href="#!">Web Development</a>
            </li>
            <li>
              <a href="#!">Graphic Design</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#!">Pricing</a>
        </li>
        <li>
          <a href="#!">Portfolio</a>
          <ul class="nav-dropdown">
            <li>
              <a href="#!">Web Design</a>
            </li>
            <li>
              <a href="#!">Web Development</a>
            </li>
            <li>
              <a href="#!">Graphic Design</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#!">Contact</a>
        </li>
      </ul>
    </nav>
  </div>
</section>

<!--
<nav>
  <ul>
    <li><a href="inicio.php"><em class="fas fa-home"></em> Inicio</a></li>
    <li class="principal"><a href="ev_estudiantes.php">Estudiantes</a>
      
    </li>
    <li class="principal"><a href="ev_padres.php">Padres</a>
      
    </li>
    <li class="principal"><a href="ev_directivos.php">Directivos</a>
      
    </li>
    <li class="principal"><a href="ev_auto.php">Auto-Evaluacion</a>
      
    </li>
    <li class="principal"><a href="ev_co.php">Co-Evaluación</a>
      
    </li>
    <li class="principal"><a href="ev_observacion.php">Observación en Clase</a>
      
    </li>
  </ul>
</nav> --->