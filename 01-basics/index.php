<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
</head>

<body>

<form action ="processorder.php" method="post">
	<table style="border=0px;">
		<tr style="background: #cccccc;">
			<td style="width=150px; text-align: center;">Položka</td>
			<td style="width=15px; text-align: center;">Množství</td>
		</tr>
		<tr>
			<td>Penumatiky</td>
			<td><input type="text" name="tireqty" size="3" maxlength="3" /></td>
		</tr>
		<tr>
			<td>Olej</td>
			<td><input type="text" name="oilqty" size="3" maxlength="3" /></td>
		</tr>
		<tr>
			<td>Zapalovací svíčky</td>
			<td><input type="text" name="sparkqty" size="3" maxlength="3" /></td>
		</tr>		
		<tr>
			<td>Jak jste se dozvěděli o těchto stránkách?</td>
			<td><select name="find">
				<option value="a">Jsem stálý zákazník</option>
				<option value="b">Z televizní reklamy</option>
				<option value="c">Z telefonního seznamu</option>
				<option value="d">Od známého</option>
				</select>
				</td>
		</tr>
		<tr>
		<td colspa="2" style="text-align: center">
			<input type="submit" value="Odeslat objednavku" />
		</td>
		</tr>
	</table>
	
</form>

</body>

</html>