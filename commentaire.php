<?php

include 'class/bdd.php';

session_start();
$bdd = new bdd();

$comments = $bdd->getcomment($_GET['id']);

?>
<?php foreach ($comments as $comment) { ?>

    <div id="<?php echo $comment['id']; ?>" class="border border-secondary shadow p-3 mb-5 rounded">
        <p><?php echo $comment['login'] . ' =>'; ?></p>
        <p><?php echo $comment['commentaire']; ?></p>
    </div>
<?php }
