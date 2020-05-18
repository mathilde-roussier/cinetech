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
    <meta charset="UTF-8">

    <!-- css boostrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/style.css">

    <title> Profil </title>
</head>

<body>

    <?php include 'include/header.php'; ?>

    <main class="container row col-12">

        <section class="container row col-6 justify-content-center">
            <h2 class="d-flex col-12 justify-content-center"> Profil </h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" name="login" class="form-control" value="<?php echo $_SESSION['login']; ?>" id="login">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $_SESSION['email']; ?>" id="email" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="password">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="form-group">
                    <label for="password_conf">Confirmation du nouveau mot de passe</label>
                    <input type="password" name="password_conf" class="form-control" id="password_conf">
                </div>
                <div class="form-group">
                    <label for="password_old">Ancien mot de passe *</label>
                    <input type="password" name="password_old" class="form-control" id="password_old">
                </div>
                <button type="submit" name="profil" class="btn btn-primary">Modifier</button>
                <?php if (isset($_POST['profil'])) echo $user->getlastmessage(); ?>
            </form>
        </section>
        <section class="container d-flex col-6 justify-content-center">
            <a href="favoris.php">Liste des favoris</a>
        </section>
    </main>

    <?php include 'include/footer.php'; ?>

</body>

</html>