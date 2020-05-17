<?php

class bdd
{
	private $connexion;

	public function __construct()
	{
		try {
			$this->connexion = new PDO("mysql:host=localhost;dbname=cinetech", "root", "");
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getco()
	{
		return $this->connexion;
	}

	public function addfav($id_media, $nom_media, $type_media, $img_media)
	{
		$requete = $this->connexion->prepare("INSERT INTO favoris (id_users,id_media,nom_media,type_media,img_media) VALUES (:id_users,:id_media,:nom_media,:type_media,:img_media)");
		$requete->execute(array(':id_users' => $_SESSION['id'], ':id_media' => $id_media, ':nom_media' => $nom_media,':type_media' => $type_media, ':img_media' => $img_media));
		$resultat = $requete->fetchAll(PDO::FETCH_ASSOC); // Supprimer ? 
	}

	public function getfav()
	{	
		$requete = $this->connexion->prepare("SELECT * FROM favoris WHERE id_users = :id_session");
		$requete->execute(array(':id_session' => $_SESSION['id']));
		$resultat_fav = $requete->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($resultat_fav);
	}

	public function close()
	{
		$this->connexion = null;
	}
}
