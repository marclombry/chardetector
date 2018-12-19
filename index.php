<?php
//liste des caractere a supprimer
$listChar = [
	'/[áàâãªä]/u' => 'a',
	'/[ÁÀÂÃÄ]/u' => 'A',
	'/[ÍÌÎÏ]/u' => 'I',
	'/[íìîï]/u' => 'i',
	'/[éèêë]/u' => 'e',
	'/[ÉÈÊË]/u' => 'E',
	'/[óòôõºö]/u' => 'o',
	'/[ÓÒÔÕÖ]/u' => 'O',
	'/[úùûü]/u' => 'u',
	'/[ÚÙÛÜ]/u' => 'U',
	'/ç/' => 'c',
	'/Ç/' => 'C',
	'/ñ/' => 'n',
	'/Ñ/' => 'N',
	"/['`]/u" => ' ',
];
//fonction pour remplacer chaque clé (regex) par la valeur attribuer
function enleverCaracteresSpeciaux($text) {
	global $listChar;
	//je remplace les clé du tableau par les valeur du tableau dans le texte
	return preg_replace(array_keys($listChar), array_values($listChar), $text);
}
$fileByLigne = [];
$fileModified='';
// récupere tout le contenu du fichier pour le remplacer
$fileContent = file_get_contents('commande.txt');
$content='';
// je récupere le contenue du fichier sous la forme d'une ressources
$file = fopen('commande.txt','r');
// si le fichier existe je stock les valeurs dans un tableaux
if(file_exists('commande.txt')){
	//tant que le parcours du fichier n'est pas fini je stock chaque ligne dans un tableau
	while (!feof($file)) {
		array_push($fileByLigne, fgets($file));
	}
	//parcours du tableau pour récupéré la ligne
	foreach ($fileByLigne as $numberLine => $line) {
		// j'incrémente la variable pour pas commencé ma ligne a 0
		$numberLine+=1;
		// pour chaque expression regulieres je vérifie si une occurence est trouvé par ligne
		foreach ($listChar as $k => $v) {
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
$newTxt = fopen("commande-core.txt", "w");
// j'écrit dans le fichier le contenu de ma variable qui conteient elle meme toute les modification
fwrite($newTxt, $fileModified);
// je ferme le fichier
fclose($newTxt);
//mail("email","modification detecter",$content);