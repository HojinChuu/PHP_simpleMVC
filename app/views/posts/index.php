<?php require APPROOT . '/views/default/header.php'; ?>
    <?php flash('post_message') ?>
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Community</h1>
        </div>
        <div class="col-md-6">
            <a href="<?= URLROOT; ?>/posts/add" class="btn btn-secondary pull-right">
                <i class="fa fa-pencil"></i> Add Post
            </a>
        </div>
    </div>
    <?php foreach($data['posts'] as $post) : ?>
        <a href="<?= URLROOT; ?>/posts/show/<?= $post->postId; ?>">
            <div class="card card-body mb-3 post_card_container">
                <h4 class="card-title"><?= $post->title; ?></h4>
                <small>written by <?= $post->name; ?> on <?= $post->postCreated; ?></small>   
                <p class="card-text mt-4"><?= $post->body ?></p>
            </div>
        </a>
    <?php endforeach; ?>
<?php require APPROOT . '/views/default/footer.php'; ?>

