<?php 
  require("page.php");
  
  $homepage = new Page();
  
  $homepage->content = "<!-- obsah stránky -->
  <section>
	  <h2>Vítejte na stránách splečnosti TL Consulting.</h2>
	  <p>Prosíme věnujte chvilku času, abyste nás poznali.</p>
	  <p>Rádi Vám pomůžeme s Vaším podnikáním. Kontaktujte nás.</p>
  </section>";
  
  $homepage->display();

?>

