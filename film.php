<?php

include 'include/requete_film.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <!-- css boostrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- js boostrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <!-- mon js pagination -->
    <script src='https://code.jquery.com/jquery-3.4.1.js'></script>
    <script src="js/pagination.js"></script>

    <title>Film</title>
</head>

<body>
    <main class="container row col-12 justify-content-around">
        <section class='container row col-12 justify-content-around'>
            <?php
            foreach ($data_decode['results'] as $film) {
                $film = get_object_vars($film);
            ?>
                <div id="<?php echo $film['id']; ?>" class="card col-2 p-0 m-2" style="width: 18rem;">
                    <img src="<?php echo "https://image.tmdb.org/t/p/w500" . $film["poster_path"]; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $film['vote_average']; ?></h6>
                        <h5 class="card-title"><?php echo $film['title']; ?></h5>
                        <a href="details.php?id_film=<?php echo $film['id']; ?>" class="btn btn-primary">En voir plus</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </section>

        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $data_decode['total_pages']; $i++) { ?>
                    <li id="<?php echo $i; ?>" class="page-item"><a id="p<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
                <?php } ?>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>

    </main>

</body>

</html>