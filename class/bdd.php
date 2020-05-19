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

	// Fonctions favoris =>

	public function addfav($id_media, $nom_media, $type_media, $img_media)
	{
		$requete = $this->connexion->prepare("INSERT INTO favoris (id_users,id_media,nom_media,type_media,img_media) VALUES (:id_users,:id_media,:nom_media,:type_media,:img_media)");
		$requete->execute(array(':id_users' => $_SESSION['id'], ':id_media' => $id_media, ':nom_media' => $nom_media, ':type_media' => $type_media, ':img_media' => $img_media));
		$resultat = $requete->fetchAll(PDO::FETCH_ASSOC); // Supprimer ? 
	}

	public function getfav()
	{
		$requete = $this->connexion->prepare("SELECT * FROM favoris WHERE id_users = :id_session");
		$requete->execute(array(':id_session' => $_SESSION['id']));
		$resultat_fav = $requete->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($resultat_fav);
	}

	public function checkfav($id_media)
	{
		$favori = false;
		$requete = $this->connexion->prepare("SELECT * FROM favoris WHERE id_users = :id_session");
		$requete->execute(array(':id_session' => $_SESSION['id']));
		$resultat_fav = $requete->fetchAll(PDO::FETCH_ASSOC);
		// var_dump($resultat_fav);
		if (!empty($resultat_fav)) {
			foreach ($resultat_fav as $fav) {
				if ($fav['id_media'] == $id_media) {
					$favori = true;
				} else {
					$favori = false;
				}
			}
		}
		if ($favori == true) {
?>
			<button type="button" class="btn col-3 btn-primary disabled d-flex align-items-baseline justify-content-between"> Favori <svg class="bi bi-star-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
				</svg></button>
		<?php
		} else {
		?>
			<button id="favoris" type="button" class="btn btn-primary">Ajouter aux favoris</button>
<?php
		}
	}

	public function supprfav($id_media)
	{
		$requete = $this->connexion->prepare("DELETE FROM favoris WHERE id_media = :id_media");
		$requete->execute(array(':id_media' => $id_media));
	}

	// Fonctions commentaire =>

	public function addcomment($comment, $id_media, $id_parent = '')
	{
		if (!empty($id_parent)) {
			$requete = $this->connexion->prepare("INSERT INTO commentaires (id_users, commentaire, parent_id, id_media) VALUES (:id_users, :commentaire, :parent_id, :id_media)");
			$requete->execute(array(':id_users' => $_SESSION['id'], ':id_media' => $id_media, ':commentaire' => $comment, ':id_parent' => $id_parent));
		} else {
			$requete = $this->connexion->prepare("INSERT INTO commentaires (id_users, commentaire, id_media) VALUES (:id_users, :commentaire, :id_media)");
			$requete->execute(array(':id_users' => $_SESSION['id'], ':id_media' => $id_media, ':commentaire' => $comment));
		}
		$resultat = $requete->fetchAll(PDO::FETCH_ASSOC); // Supprimer ? 
	}

	public function getcomment($id_media)
	{
		$requete = $this->connexion->prepare("SELECT commentaires.id, users.login, commentaires.commentaire, commentaires.parent_id FROM commentaires INNER JOIN users ON commentaires.id_users = users.id WHERE id_media = :id_media");
		$requete->execute(array(':id_media' => $id_media));
		$resultat_comment = $requete->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($resultat_comment);
	}

	public function close()
	{
		$this->connexion = null;
	}
}
