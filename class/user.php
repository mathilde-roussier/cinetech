<?php

// id	login email	password

include "bdd.php";

class user
{

    private $bdd;

    private $id;
    private $login;
    private $lastmessage;

    public function __construct()
    {
        // Recup connexion bdd
        $this->bdd = new bdd();
        $this->bdd = $this->bdd->getco();
    }

    public function inscription($login, $mail, $mdp, $confmdp)
    {
        if ($login != NULL && $mail != NULL && $mdp != NULL && $confmdp != NULL) {
            if ($mdp == $confmdp) {
                $recup_mail = $this->bdd->prepare("SELECT email FROM users WHERE email = :email");
                $recup_mail->execute(array(':email' => $mail));
                $resultat_mail = $recup_mail->fetchAll(PDO::FETCH_ASSOC);
                $recup_log = $this->bdd->prepare("SELECT login FROM users WHERE login = :login");
                $recup_log->execute(array(':login' => $login));
                $resultat_log = $recup_log->fetchAll(PDO::FETCH_ASSOC);
                if (empty($resultat_mail) && empty($resultat_log)) {
                    $mdp = password_hash($mdp, PASSWORD_BCRYPT, array('cost' => 12));
                    $requete = $this->bdd->prepare("INSERT INTO users (login, email, password) VALUES (:login, :mail, :mdp)");
                    $requete->execute(array(':login' => $login, ':mdp' => $mdp, ':mail' => $mail));
                    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC); // Supprimer ? 
                    $this->lastmessage = 'Inscription prise en compte !';
                } elseif (!empty($resultat_mail)) {
                    $this->lastmessage = 'Ce mail est déjà utilisé';
                } elseif (!empty($resultat_log)) {
                    $this->lastmessage = 'Ce login n\'est pas disponible';
                }
            } else {
                $this->lastmessage = 'Les deux mots de passe sont différents';
            }
        } else {
            $this->lastmessage = 'Veuillez remplir tous les champs';
        }
    }

    public function connexion($login, $mdp)
    {
        $requete = $this->bdd->prepare("SELECT * FROM users WHERE email = :mail");
        $requete->execute(array(':mail' => $mail));
        $resultat = $requete->fetchAll();
        if (!empty($resultat)) {
            foreach ($resultat as $infos) {
                if (password_verify($mdp, $infos["password"])) {
                    $this->id = $infos["id"];
                    $_SESSION['id'] = $this->id;
                    $_SESSION['nom'] = $infos["lastname"];
                    $_SESSION['prenom'] = $infos["firstname"];
                    $_SESSION['birthday'] = $infos["birthday"];
                    $_SESSION['points'] = $infos["points"];
                    header('location:index.php');
                } else {
                    $this->lastmessage = 'Erreur de mot de passe';
                }
            }
        } else {
            $this->lastmessage = 'Ce mail n\' existe pas';
        }
    }

    public function disconnect()
    {
        session_destroy();
        header('location:../index.php');
    }

    public function getlastmessage()
    {
        return $this->lastmessage;
    }

    public function getlogin()
    {
        return $this->login;
    }

    public function getid()
    {
        return $this->id;
    }
}
