<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dictionnaire</title>
</head>
<body>
	<?php 
		$string = file_get_contents("dictionnaire.txt", FILE_USE_INCLUDE_PATH);
		$dico = explode("\n", $string);
		echo "Voilà le nombre de mots dans le dico ".count($dico)."."."<br>"."Il y a ";
		$count = 0;
		foreach ($dico as $string => $words) {
			if (strlen($words) === 15) {
				$count++;
			}	
		}
		echo $count." qui ont 15 caractères"."<br>"."Il y a ";
		$words = 0;
		foreach ($dico as $string => $word) {
			if (strpos($word, "w") !== false) {
				$words ++;
			}	
		}
		echo $words." mots qui contiennent la lettre w."."<br>"."Il y a ";

		$mots = 0;
		foreach ($dico as $string => $word) {
			if (substr($word, -1) === "q") {
				$mots ++;
			}	
		}
		echo $mots." mots qui finissent la lettre q."."<br>";

	 ?>
</body>
</html>