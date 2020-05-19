<div id="comment-<?= $comment->id;?>">
    <div class="border border-secondary shadow p-3 mb-5 rounded">
        <p><?= $comment->login . ' =>'; ?></p>
        <p><?= $comment->commentaire; ?></p>
        <p class="text-right">
            <buttton class="btn btn-secondary reply" data-id="<?= $comment->id; ?>">Répondre</buttton>
        </p>

    </div>
</div>
<div class='ml-5 mr-5'>
    <?php if (isset($comment->children)) {
        foreach ($comment->children as $comment) {
            include('include/comment.php');
        }
    } ?>
</div>