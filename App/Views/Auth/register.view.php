<?php

/** @var string|null $message */
/** @var \Framework\Support\LinkGenerator $link */
/** @var \Framework\Support\View $view */

$view->setLayout('auth');
?>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Register</h5>
                    <div class="text-center text-danger mb-3">
                        <?= e($message ?? null) ?>
                    </div>
                    <form class="form-signin" method="post" action="<?= $link->url("register") ?>">
                        <div class="form-label-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input name="username" type="text" id="username" class="form-control" placeholder="Username"
                                   value="<?= e($username ?? '') ?>" maxlength="100" required autofocus>
                        </div>

                        <div class="form-label-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="password" id="password" class="form-control"
                                   placeholder="Password" required>
                        </div>

                        <div class="form-label-group mb-3">
                            <label for="confirm_password" class="form-label">Confirm password</label>
                            <input name="confirm_password" type="password" id="confirm_password" class="form-control"
                                   placeholder="Confirm password" required>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary" type="submit" name="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
