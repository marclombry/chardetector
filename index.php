<?php
require "functions.php";

// Old and new filename
$currentFile = "commande.txt";
$newFile = "commande-core.txt";

$fileByLigne = [];
$fileModified='';
// récupere tout le contenu du fichier pour le remplacer
$fileContent = utf8_encode(file_get_contents($currentFile));
$content='';
// je récupere le contenue du fichier sous la forme d'une ressources
$file = fopen($currentFile,'r');
// si le fichier existe je stock les valeurs dans un tableaux
if(file_exists($currentFile)){
	//tant que le parcours du fichier n'est pas fini je stock chaque ligne dans un tableau
	while (!feof($file)) {
		array_push($fileByLigne, fgets($file));
	}
	//parcours du tableau pour récupéré la ligne
	foreach ($fileByLigne as $numberLine => $line) {
		// j'incrémente la variable pour pas commencé ma ligne a 0
		$numberLine+=1;
		// pour chaque expression regulieres je vérifie si une occurence est trouvé par ligne
		foreach (listChars() as $k => $v) {
			//var_dump(preg_match($k,$line));
			if(preg_match($k,$line))
			{
				//je stock tout ce qui es trouvé
				$content.= "<p> a la ligne $numberLine: $k as été remplacer par $v</p>";
			}
			
		}
		$content.="<hr />";
	}
	// lancement de ma fonction pour enlever tout les caractere spéciaux
	$fileModified = enleverCaracteresSpeciaux($fileContent);
}
echo $content;
// j'ouvre le fichier commande-core.txt en écriture ou je le crée si il n'existe pas //
$newTxt = fopen($newFile, "w");
// j'écrit dans le fichier le contenu de ma variable qui conteient elle meme toute les modification
fwrite($newTxt, $fileModified);
// je ferme le fichier
fclose($newTxt);
//mail("email","modification detecter",$content);