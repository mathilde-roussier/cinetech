<?php

include 'class/user.php';

session_start();
$user = new user();

if (!isset($_SESSION['id'])) {
    header('location:index.php');
}

include 'include/traitement_co_inscri_profil.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>L'Animatek - Profil </title>
</head>

<body>

    <?php include 'include/header.php'; ?>
    <main class="p-4">
    <section class="container-xl p-3 justify-content-center justify-items-center align-center text-center">
             <h2 class="h2 text-center mb-4"> Mon profil </h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" name="login" class="form-control text-center" value="<?php echo $_SESSION['login']; ?>" id="login">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control text-center" value="<?php echo $_SESSION['email']; ?>" id="email" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="password">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control text-center" id="password">
                </div>
                <div class="form-group">
                    <label for="password_conf">Confirmation du nouveau mot de passe</label>
                    <input type="password" name="password_conf" class="form-control text-center" id="password_conf">
                </div>
                <div class="form-group">
                    <label for="password_old">Ancien mot de passe *</label>
                    <input type="password" name="password_old" class="form-control text-center" id="password_old">
                </div>
                <button type="submit" name="profil" class="btn btn-primary">Modifier</button>
                <?php if (isset($_POST['profil'])) echo $user->getlastmessage(); ?>
            </form>
        <a href="favoris.php"><button class=" m-3 btn btn-secondary">Liste des favoris</button></a>
        </section>

    </main>

    <?php include 'include/footer.php'; ?>

  <!--SCRIPTS-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>