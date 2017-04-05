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
	echo $mots." mots qui finissent la lettre q."."<br><br>";
	?>


	<?php  
	$string = file_get_contents("films.json", FILE_USE_INCLUDE_PATH);
	$brut = json_decode($string, true);
	$top = $brut["feed"]["entry"]; 

	for ($i = 1; $i <=10 ; $i++){
		$title = $top[$i]['im:name']["label"];
		echo $i .' '. $title . "<br />";
	}

	for ($i = 0; $i <100; $i++){
		$title = $top[$i]['title']["label"];
		if ($title === 'Gravity - Alfonso Cuarón') {
			echo "Le film Gravity est est classé: ".$i."ème."."<br />";
		}
	}

	for ($i = 0; $i<count($top); $i++) {
		$title = $top[$i]['im:name']["label"];
		if($title == "The LEGO Movie")	{
			echo "Les réalisateurs de LEGO sont ".$top[$i] ["im:artist"]["label"]."<br>";
		}
	}

	$nbrsFilms = 0;
	for ($i = 0; $i<count($top); $i++){
		$date = $top[$i]['im:releaseDate']["label"];
		if (date_parse($date)['year']<2000) {
			$nbrsFilms++;
		}
	}
	echo "Le nombres de films sortie avant 2000 est de: ".$nbrsFilms."<br>";
	
	$toptri = $top;
	function cmp($a, $b){
		if ($a['im:releaseDate']["label"] == $b['im:releaseDate']["label"]) {
			return 0;
		}
		return ($a['im:releaseDate']["label"] < $b['im:releaseDate']["label"]) ? -1 : 1;
	}
	usort($toptri, "cmp");

	echo"Le film le plus ancient est ".$toptri[0]['im:name']["label"]. " et le plus récent est ".$toptri[count($toptri)-1]['im:name']["label"]."."."<br>";

	$stack = array();
	foreach ($top as $film) {
		$category = $film['category']['attributes'] ["label"];
		array_push($stack, $category);
		}
		$stack_count = array_count_values($stack);
		sort($stack_count);
		echo "La category de film la plus représenter est : ".$stack[$stack_count[count($stack_count) -1]].".";
		// print_r(array_count_values($stack));
		// print_r($stack);
	// print_r($stack);
	// echo $stack;
	?>
</body>
</html>