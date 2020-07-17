<?php require APPROOT . '/views/default/header.php'; ?>
    <a href="<?= URLROOT; ?>/posts/index" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
    
    <br>
    
    <h1 class="mt-5"><?= $data['post']->title; ?></h1>
    <div class="bg-light p-2">
        <small>Written by <?= $data['user']->name; ?> on <?= $data['post']->created_at; ?></small>
    </div>
    
    <hr class="mt-4 mb-4">
    <p><?= $data['post']->body; ?></p>
    <hr class="mt-4 mb-4">

    <?php if($data['post']->user_id == $_SESSION['user_id']) : ?>
        <div class="row">
            <a href="<?= URLROOT; ?>/posts/edit/<?= $data['post']->id; ?>" class="btn btn-secondary ml-3">Edit</a>
            <form action="<?= URLROOT; ?>/posts/delete/<?= $data['post']->id; ?>" method="post">
                <input type="submit" value="Delete" class="btn btn-danger ml-2">
            </form>
        </div>
    <?php endif; ?>
<?php require APPROOT . '/views/default/footer.php'; ?>

