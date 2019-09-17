<?php

class Page {
	
	public $content; //obsah strnky
	public $title = "TLA Consulting, a.s."; //titulek stranky
	public $keywords = "TLA Consulting, Three Letter Abbreviation, vyhledávače patří mezi mé nejlepší přátele";
	public $buttons = array("Domů" => "home.php",
							"Kontakty" => "contact.php",
							"Služby" => "services.php",
							"Mapa stránek" => "map.php"
							);
	public function __set($name, $value){
		$this->name = $value;
	}
	/*
	  Zobrazí stránku a  její jednotlivé komponenty
	*/
	public function display(){
		echo "<!DOCTYPE html>\n<html>\n<head>\n";
		$this->displayTitle();
		$this->displayKeywords();
		$this->displayStyles();
		echo "</head>\n<body>\n";
		$this->displayHeader();
		$this->displayMenu($this->buttons);
		echo $this->content;
		$this->displayFooter();
		echo "</body>\n</html>\n";
	}
	
	public function displayTitle(){
		echo "<title>".$this->title."</title>";
	}
	
	public function displayKeywords(){
		echo "<meta name='keywords' contet='".$this->keywords."'/>";
	}
	
	public function displayStyles(){
		?>
		<link href="styles.css" type="text/css" rel="stylesheet">
		<?php
	}
	
	public function displayHeader(){
		?>
		<!-- záhlavní stránky -->
		<header>
		  <img src="logo.gif" alt="TLA logo" height="70" width="70" />
		</header>
		<?php 
	}
	
	public function displayMenu($buttons){
		echo "<!-- nabídka -->
		  <nav>";
		while (list($name,$url) = each($buttons)){
			$this->displayButton($name, $url, !$this->isURLCurrentPage($url));
		}
		echo "</nav>\n";
	}
	
	public function isURLCurrentPage($url){
		if(strpos($_SERVER['PHP_SELF'], $url) == false) {
			return false;
		} else {
			return true;
		}
	}
	
	public function displayButton($name, $url, $active=true){
		if($active) { ?>
		  <div class="menuitem">
		    <a href="<?=$url?>">
			  <img src="s-logo.gif" alt="" height="20" width="20" />
			  <span class="menutext"><?=$name?></span>
			</a>
		  </div>
		  <?php
		 } else { ?>
		  <div class="menuitem">
		    <img src="side-logo.gif" />
			<span class="menutext"><?=$name?></span>
		  </div>
		  <?php		 		 
		}
	}
	
	public function displayFooter(){
		?>
		<!-- zápatí stránky -->
		<footer>
			 <p>&copy; TLA Consulting, a.s.<br />
			 Prohlédni si naši
			 <a href="legal.php">stránku s právními informacemi</a>.</p>
		</footer>
		<?php
	}
}

?>