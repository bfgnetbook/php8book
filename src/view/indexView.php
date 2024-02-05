<main>
    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <!-- Post preview-->
                <?php
                $posts = $this->get('posts');
                if (!empty($posts)) {
                    foreach ($posts as $post) { ?>
                        <div class="post-preview">
                            <a href="post/detail/<?= $post['id'] ?>">
                                <h2 class="post-title"><?= $post['title'] ?></h2>
                            </a>
                            <p class="post-meta">
                                Posted by
                                <strong><?= $post['author'] ?></strong>
                                on <?= date('F j, Y', strtotime($post['register'])) ?>
                            </p>
                            <?php
                            if ($this->get('auth')) { ?>
                                <p>
                                    <button type="button" class="btn btn-primary btn-sm" onClick="location.href='post/edit/<?= $post['id'] ?>'">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete('post/delete/<?= $post['id'] ?>')">Delete</button>
                                </p>
                            <?php } ?>
                        </div>
                        <!-- Divider-->
                        <hr class="my-4" />
                    <?php }
                } else { ?>
                    <div style="margin-top:10%;margin-bottom:10%" class="alert alert-warning" role="alert">
                        No post found
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>