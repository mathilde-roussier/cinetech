<header>

  <nav class="navbar navbar-expand-lg navbar-light">
  <img width="30" height="30" class="d-inline-block align-top m-2" src="assets/logo.png" alt="logo"/>
    <a class="navbar-brand" href="index.php">L'Animatek</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
    <?php require 'include/nav.php'?>
    <form class="form-inline my-2 my-lg-0" autocomplete="off" method="GET" action="recherche.php">
          <input class="form-control mr-sm-2" type="search" name="search" id="search" list="liste" placeholder="Votre recherche" required>
          <datalist id="liste">
          </datalist>
          <input class="btn btn-warning my-2 my-sm-0" type="submit" id="submit"/>
    </form>
    </div>
  </nav>

</header>