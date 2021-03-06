<?php

include "bdd.php";

class user
{

    private $bdd;

    private $id;
    private $login;
    private $email;
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
                } elseif (!empty($resultat_mail) || (!empty($resultat_log))) {
                    $this->lastmessage = 'Ce mail et/ou login est déjà utilisé';
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
        $requete = $this->bdd->prepare("SELECT * FROM users WHERE login = :login");
        $requete->execute(array(':login' => $login));
        $resultat = $requete->fetchAll();
        if (!empty($resultat)) {
            foreach ($resultat as $infos) {
                if (password_verify($mdp, $infos["password"])) {
                    $this->id = $infos["id"];
                    $this->login = $infos["login"];
                    $this->email = $infos["email"];
                    $_SESSION['id'] = $this->id;
                    $_SESSION['login'] = $this->login;
                    $_SESSION['email'] = $this->email;
                    header('location:index.php');
                } else {
                    $this->lastmessage = 'Erreur de mot de passe';
                }
            }
        } else {
            $this->lastmessage = 'Cet utilisateur n\' existe pas';
        }
    }

    public function profil($id, $oldmdp, $login, $mail, $mdp = '', $mdp_conf = '')
    {
        $requete = $this->bdd->prepare("SELECT password FROM users WHERE id = :id ");
        $requete->execute(array(':id' => $id));
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        if (password_verify($oldmdp, $resultat["password"])) {
            if ($login != NULL) {
                $requete_log = $this->bdd->prepare("SELECT id,login FROM users WHERE login = :login ");
                $requete_log->execute(array(':login' => $login));
                $resultat_log = $requete_log->fetch(PDO::FETCH_ASSOC);
                if (empty($resultat_log)) {
                    $this->login = $login;
                } elseif ($resultat_log['id'] == $id) {
                    $this->login = $login;
                } else {
                    $this->lastmessage = 'Ce login est déjà utilisé';
                }
            }
            if ($mail != NULL) {
                $requete_mail = $this->bdd->prepare("SELECT id,email FROM users WHERE email = :mail");
                $requete_mail->execute(array(':mail' => $mail));
                $resultat_mail = $requete_mail->fetch(PDO::FETCH_ASSOC);
                if (empty($resultat_mail)) {
                    $this->email = $mail;
                } elseif ($resultat_mail['id'] == $id) {
                    $this->email = $mail;
                } else {
                    $this->lastmessage = 'Ce mail correspond déjà à un utilisateur';
                }
            }
            if (!empty($mdp) && !empty($mdp_conf)) {
                if($mdp == $mdp_conf)
                {
                    $mdp = password_hash($mdp, PASSWORD_BCRYPT, array('cost' => 12));
                    $requete_mdp = $this->bdd->prepare("UPDATE users SET password = :mdp WHERE id = :id");
                    $requete_mdp->execute(array(':mdp' => $mdp, ':id' => $id));
                }
                else{
                    $this->lastmessage = 'Les deux mot de passe sont différents !';
                }
                
            }
            else{
                $this->lastmessage = 'Veuillez confirmer le mot de passe !';
            }
            if (!isset($this->lastmessage)) {
                $request = $this->bdd->prepare("UPDATE users SET login = :login, email = :mail WHERE id = :id");
                $request->execute(array(':login' => $this->login, ':mail' => $this->email, ':id' => $id));
                $this->lastmessage = 'Modification prise en compte';
            }
        } else {
            $this->lastmessage = 'Vieux mot de passe erroné';
        }
    }

    public function disconnect()
    {
        session_destroy();
        header('location:index.php');
    }

    public function getlastmessage()
    {
        return $this->lastmessage;
    }

    public function getlogin()
    {
        return $this->login;
    }

    public function getemail()
    {
        return $this->email;
    }

    public function getid()
    {
        return $this->id;
    }
}
