<?php
//liste des caractere a supprimer
function listChars() {
    return [
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
}

//fonction pour remplacer chaque clé (regex) par la valeur attribuer
//je remplace les clé du tableau par les valeur du tableau dans le texte
function enleverCaracteresSpeciaux($text) {
    $listChar = listChars();
	//je remplace les clé du tableau par les valeur du tableau dans le texte
	return preg_replace(array_keys($listChar), array_values($listChar), $text);
}