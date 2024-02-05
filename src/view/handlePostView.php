<div class="container">
    <div class="row">
        <div class="col-md-12 p-5">
            <?php $errors = $this->get('errors');
            if (!empty($errors)) {
            ?>
                <div class="alert alert-danger" role="alert">
                    <ul>
                        <?php foreach ($errors as $error) { ?>
                            <li><?= $error ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <form action="" method="POST">
                <?php $post = $this->get('dataPost'); ?>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" value="<?=$post['title'] ?? ''?>" class="form-control" id="title">
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" name="author" value="<?=$post['author'] ?? ''?>" class="form-control" id="author">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" rows="7" name="content" id="content"><?=$post['content'] ?? ''?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Publish</button>
            </form>
        </div>
    </div>
</div>