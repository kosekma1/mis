<?php

  echo "<h1>Výjimky</h1>";

  try {
	  //provedení nějakého úkolu
  } catch (Exception $e) {
	  //zpracování výjimky
  } finally {
	  echo 'Provede se vždy';
  }

  echo "<h1>Základní výjimka</h1>";
  try {
	  throw new Exception("Nastala strašná chyba.",42);
  } catch (Exception $e){
	  echo "Výjimka ".$e->getCode().": ".$e->getMessage()."<br />"." v ".$e->getFile(). " na řádku ".$e->getLine(). "<br />";
  } 

  /* Třída Exception 
     - konstruktor má tři volitelné parametry: chybovou zprávu, kód chyby a dřívejší výjimku
     - třída má dále následující vestavěné metody
			getCode()
			getMessage()
			getFile()
			getLine()
			getTrace()
			getTraceAsString()
			getPrevious()
			__toString()
  */
  
  /* Co lze dědit?
  
  class Exception extends Throwable
	{
		protected $message = 'Unknown exception';   // exception message
		private   $string;                          // __toString cache
		protected $code = 0;                        // user defined exception code
		protected $file;                            // source filename of exception
		protected $line;                            // source line of exception
		private   $trace;                           // backtrace
		private   $previous;                        // previous exception if nested exception

		public function __construct($message = null, $code = 0, Exception $previous = null);

		final private function __clone();           // Inhibits cloning of exceptions.

		final public  function getMessage();        // message of exception
		final public  function getCode();           // code of exception
		final public  function getFile();           // source filename
		final public  function getLine();           // source line
		final public  function getTrace();          // an array of the backtrace()
		final public  function getPrevious();       // previous exception
		final public  function getTraceAsString();  // formatted string of trace

		// Overrideable
		public function __toString();               // formatted string for display
	}
*/

/* Uživatelsky definovaná výjimka */
class MyException extends Exception {
	function __toString(){
		return "<strong>Výjimka ".$this->getCode()."</strong>: ".$this->getMessage()."<br />"."v ".$this->getFile()." na řádku ".$this->getLine()."<br />";		
	}
}

echo "<h1>Uživatelsky definovaná výjimka</h1>";
try {
	throw new MyException("Nastala strašná chyba.", 42);
} catch (MyException $m){
	echo $m;
}

?>
