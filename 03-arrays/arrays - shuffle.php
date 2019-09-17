<?php	
   
   // Preusporadani poli
   $pictures = array('money.jpg','car.png','fio-reklama.png');
          
   shuffle($pictures);
   

?>   
   
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Obrázky na zamíchání</title>
	</head>
	<body>
		<h1>Obrázky na zamíchání</h1>
		<div align="center">
			<table style="width: 100%; border=0">
				<tr>
				<?php
					for($i=0; $i<3;$i++){
						echo "<td style=\"width=33%; text-align: center \">      
							  <img src=\"";
						echo $pictures[$i];
						echo "\"/></td>";
					}
				?>
				</tr>
			</table>
		</div>
	</body>
</html>
	
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   

