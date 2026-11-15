<?php

/** @var \Framework\Auth\AppUser $user */
/** @var \Framework\Support\LinkGenerator $link */
?>

<main class="user-profile-page">
    <div class="user-profile-picture-bubble">
        <img src="<?= $link->asset($user->getProfilePicture()) ?>"
             alt="<?= e($user->getName()) ?>'s profile picture">
    </div>
</main>
