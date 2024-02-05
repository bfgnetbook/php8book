<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="login-form mb-4 bg-light mt-4 p-4">
                <?php
                if (!is_null($this->get('error'))) {
                    echo '<div class="alert alert-danger" role="alert">' . $this->get('error') . '</div>';
                }
                ?>
                <form action="admin" method="POST" class="row g-3">
                    <h4>Welcome Admin</h4>
                    <div class="col-12">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="col-12">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-dark float-end">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>