<?php

/** @var string|null $message */
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\User $identity */
/** @var string $username */
?>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Edit profile</h5>
                    <div class="text-center text-danger mb-3">
                        <?= e($message ?? null) ?>
                    </div>

                    <form method="post" enctype="multipart/form-data" action="<?= $link->url('user.edit') ?>">
                        <div class="text-center mb-3">
                            <img src="<?= $link->asset($identity->getProfilePicture()) ?>"
                                 alt="Current profile picture" class="rounded-circle"
                                 style="height: 96px; width: 96px; object-fit: cover;">
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Name</label>
                            <input name="username" type="text" id="username" class="form-control"
                                   value="<?= e($username) ?>" maxlength="100" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile picture</label>
                            <input name="profile_picture" type="file" id="profile_picture" class="form-control"
                                   accept="image/png,image/jpeg,image/gif,image/webp">
                        </div>

                        <hr>
                        <p class="text-muted">Leave the password fields empty to keep your current password.</p>

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current password</label>
                            <input name="current_password" type="password" id="current_password"
                                   class="form-control" autocomplete="current-password">
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New password</label>
                            <input name="new_password" type="password" id="new_password"
                                   class="form-control" minlength="6" autocomplete="new-password">
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm new password</label>
                            <input name="confirm_password" type="password" id="confirm_password"
                                   class="form-control" minlength="6" autocomplete="new-password">
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary" type="submit" name="submit">Save changes</button>
                        </div>
                    </form>

                    <form method="post" action="<?= $link->url('user.delete') ?>" class="text-center mt-3"
                          onsubmit="return confirm('Do you want to delete your profile? This action cannot be undone.');">
                        <button class="btn btn-outline-danger" type="submit">Delete profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
