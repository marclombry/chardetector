<?php
function enleverCaracteresSpeciaux($text) {
	$utf8 = array(
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
	);
	//je remplace les clé du tableau par les valeur du tableau dans le texte
	return preg_replace(array_keys($utf8), array_values($utf8), $text);
}
// je récupere le contenue du fichier sous la forme d'une chaine de caractere
$file = file_get_contents('commande.txt');
// si le fichier existe je stock les valeurs modifiers dans une variable
if(file_exists('commande.txt')){
	$fileModified = enleverCaracteresSpeciaux($file);
	
}
// j'ouvre le fichier commande-core.txt en écriture ou je le crée si il n'existe pas //
$newTxt = fopen("commande-core.txt", "w");
// j'écrit dans le fichier le contenu de ma variable qui conteient elle meme toute les modification
fwrite($newTxt, $fileModified);
// je ferme le fichier
fclose($newTxt);
//mail("email","My subject","fichier modifier");