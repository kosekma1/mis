<?php 

  require("page.php");
  
  /* Rozšíření stávající třídy - přidáme další pole buttonů, které budeme ve stránce generovat a upravíme metodu display */
  class ServicesPage extends Page {
	  
	  private $row2Butttons = array(
									"Reinženýring" => "reengineering.php",
									"Standardizace" => "standards.php",
									"Buzzwordy" => "buzzword.php",
									"Mise" => "mission.php",
	  
	  );
	  
	 /*   Zobrazí stránku a  její jednotlivé komponenty - do metody jsme přidali pouze řádek pro generování druhého menu - ostatní jsme převzali */
	public function display(){
		echo "<!DOCTYPE html>\n<html>\n<head>\n";
		$this->displayTitle();
		$this->displayKeywords();
		$this->displayStyles();
		echo "</head>\n<body>\n";
		$this->displayHeader();
		$this->displayMenu($this->buttons);
		$this->displayMenu($this->row2Butttons);
		echo $this->content;
		$this->displayFooter();
		echo "</body>\n</html>\n";
	}
			 
  }
  
  $services = new ServicesPage();
  $services->content = "<p>V naší společnosti TLA Consulting nabízíme celou řadu služeb. Produktivita vašich změstnanců by pravděpodobně vzrostla, kdybychom provedli reinženýring vašeho
  byznysu. Možná vaše podníkání potřebuje novou misi nebo rovnou dávku buzzwordů.</p>";
	
  $services->display();

?>
