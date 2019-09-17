<?php

class FileOpenException extends Exception {
	function __toString(){
		return "FileOpenException ".$this->getCode().": ".$this->getMessage()."<br />"." v ".
		       $this->getFile()." na řádku ".$this->getLine()."<br />";
	}
}

class FileWriteException extends Exception {
	function __toString(){
		return "FileWriteException ".$this->getCode().": ".$this->getMessage()."<br />"." v ".
		       $this->getFile()." na řádku ".$this->getLine()."<br />";
	}
}

class FileLockException extends Exception {
	function __toString(){
		return "FileLockException ".$this->getCode().": ".$this->getMessage()."<br />"." v ".
		       $this->getFile()." na řádku ".$this->getLine()."<br />";
	}
}

?>