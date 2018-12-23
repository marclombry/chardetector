<?php
require "functions.php";

$content = "";
$currentFile = "commande.txt";
$newFile = "commande-core.txt";
$fileByLigne = [];
$fileModified = '';

// récupere tout le contenu du fichier pour le remplacer
$fileContent = utf8_encode(file_get_contents($currentFile));

// je récupere le contenue du fichier sous la forme d'une ressources
// si le fichier existe je stock les valeurs dans un tableaux
$file = fopen($currentFile,'r');

if (!file_exists($currentFile)) {
	die("File does not exist");
}

//tant que le parcours du fichier n'est pas fini je stock chaque ligne dans un tableau
while (!feof($file)) {
	array_push($fileByLigne, fgets($file));
}

//parcours du tableau pour récupéré la ligne
foreach ($fileByLigne as $numberLine => $line) {
	$numberLine++;
	// pour chaque expression regulieres je vérifie si une occurence est trouvé par ligne
	foreach (listChars() as $regex => $translate) {
		if (preg_match($regex,$line)) {
			//je stock tout ce qui es trouvé
			$content .= "<p> a la ligne $numberLine: $regex as été remplacer par $translate</p>";
		}
	}
	$content .= "<hr />";
}
// lancement de ma fonction pour enlever tout les caractere spéciaux
$fileModified = enleverCaracteresSpeciaux($fileContent);

echo $content;

file_put_contents($newFile, $fileModified, FILE_APPEND);