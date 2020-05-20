<?php
foreach ($_GET as $champ => $info) {

    if (isset($_POST['content']) && !empty($_POST['content'])) {
        $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : 0;

        if ($parent_id != 0) {
            $bdd->getcom_parent($parent_id);
        }

        $bdd->addcomment($_POST['content'], $_GET[$champ], $parent_id);
    }


    $comments = $bdd->getcomment($_GET[$champ]);
}


$comments_by_id = [];

?>
<?php foreach ($comments as $comment) {
    $comments_by_id[$comment->id] = $comment;
}

foreach ($comments as $k => $comment) {
    if ($comment->parent_id != 0) {
        $comments_by_id[$comment->parent_id]->children[] = $comment;
        unset($comments[$k]);
    }
}
?>

<?php foreach ($comments as $comment) {
    include('include/comment.php');
} ?>

<form action="" id="form-comment" method="post">

    <input type="hidden" name="parent_id" value="0" id="parent_id">
    <h4> Poster un commentaire</h4>
    <div class="form-groupe">
        <textarea name="content" class="form-control" id="content" placeholde="Votre commentaire" required></textarea>
    </div>
    <div class="form-groupe">
        <?php if (isset($_SESSION['id'])) { ?>
            <button type="submit" class="btn btn-primary m-1"> Commenter </button>
        <?php } else { ?>
            <a href="connexion.php" class="btn btn-primary m-1"> Commenter </a>
        <?php } ?>
    </div>
</form>