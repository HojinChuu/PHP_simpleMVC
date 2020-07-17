<?php require APPROOT . '/views/default/header.php'; ?>
    <a href="<?= URLROOT; ?>/posts/index" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
    <div class="card card-body mt-3">
        <h2>Edit Post</h2>
        <p>Create a post with this form</p>
        <form action="<?= URLROOT; ?>/posts/edit/<?= $data['id']; ?>" method="post">
            <div class="form-group">
                <label for="title">Title</label> 
                <input type="text" name="title" class="form-control form-control-lg <?= (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['title']; ?>">
                <span class="invalid-feedback"><?= $data['title_err'] ?></span>
            </div>
            <div class="form-group">
                <label for="body">Body</label> 
                <textarea name="body" class="form-control form-control-lg <?= (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?= $data['body']; ?></textarea>
                <span class="invalid-feedback"><?= $data['body_err'] ?></span>
            </div>
            <input type="submit" value="Submit" class="btn btn-block btn-secondary">
        </form>
    </div>
<?php require APPROOT . '/views/default/footer.php'; ?>

