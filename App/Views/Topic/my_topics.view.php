<?php

/** @var array<int, array{topic: \App\Models\Topic, category: ?\App\Models\Category}> $topics */
/** @var \Framework\Support\LinkGenerator $link */
/** @var \Framework\Auth\AppUser $user */
?>

<main class="discussions-page">
    <div class="discussion-heading">
        <h1>My topics</h1>
        <div class="discussion-actions">
            <a class="btn btn-secondary" href="<?= $link->url('home.index') ?>">All discussions</a>
            <a class="btn btn-primary" href="<?= $link->url('topic.create') ?>">Create new topic</a>
        </div>
    </div>
    <p class="page-description">Topics you have created</p>

    <section class="discussion-content">
        <div class="discussion-list">
            <header class="list-header">
                <div>
                    <h2>Topic list</h2>
                    <small><?= count($topics) ?></small>
                </div>
                <div class="list-columns"><span>Replies</span><span>Activity</span><span></span><span></span></div>
            </header>

            <?php foreach ($topics as $topicData) {
                $topic = $topicData['topic'];
                $category = $topicData['category'];
                ?>
                <article class="discussion-row">
                    <div class="discussion-main">
                        <span class="avatar">
                            <img src="<?= $link->asset($user->getProfilePicture()) ?>"
                                 alt="<?= e($user->getName()) ?>'s profile picture">
                        </span>
                        <div>
                            <a href="#"><?= e($topic->getTitle()) ?></a>
                            <p><?= e($category?->getName() ?? 'Uncategorized') ?></p>
                        </div>
                    </div>
                    <div class="discussion-stats">
                        <span>—</span>
                        <span><?= e($topic->getCreatedAt()->format('Y-m-d H:i')) ?></span>
                        <a class="btn btn-sm btn-outline-primary"
                           href="<?= $link->url('topic.edit', ['id' => $topic->getId()]) ?>">Edit</a>
                        <form method="post" action="<?= $link->url('topic.delete') ?>"
                              onsubmit="return confirm('Delete this topic?');">
                            <input type="hidden" name="id" value="<?= e($topic->getId()) ?>">
                            <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                        </form>
                    </div>
                </article>
            <?php } ?>

            <footer class="list-footer">
                <span>Showing <?= count($topics) ?> topic<?= count($topics) === 1 ? '' : 's' ?></span>
            </footer>
        </div>
    </section>
</main>
