<main>
    <?php
    $post = $this->get('post');
    if (!empty($post)) {
    ?>
        <!-- Page Header-->
        <header class="masthead">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1><?= $post['title'] ?></h1>
                            <span class="meta">
                                Posted by
                                <strong><?= $post['author'] ?></strong>
                                on <?= date('F j, Y', strtotime($post['register'])) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4 mt-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <?= $post['content'] ?>
                    </div>
                </div>
            </div>
        </article>
    <?php } else { ?>
        <div style="margin-top:10%;margin-bottom:10%" class="alert alert-warning" role="alert">
            No post found
        </div>
    <?php } ?>
</main>