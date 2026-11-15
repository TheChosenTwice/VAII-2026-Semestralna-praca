<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \Framework\Auth\AppUser $user */
/** @var array<int, array{user: \App\Models\User, topics: array<int, array{topic: \App\Models\Topic, category: ?\App\Models\Category}>}> $users */
?>

<main class="discussions-page">
    <div class="discussion-heading">
        <h1>Discussions</h1>
        <?php if ($user->isLoggedIn()) { ?>
            <div class="discussion-actions">
                <a class="btn btn-secondary" href="<?= $link->url('topic.my_topics') ?>">My topics</a>
                <a class="btn btn-primary" href="<?= $link->url('topic.create') ?>">Create new topic</a>
            </div>
        <?php } ?>
    </div>
    <p class="page-description">Ask questions, share ideas, and join the conversation</p>

    <div class="discussions-layout">
        <aside class="discussion-sidebar">
            <p class="section-label">BROWSE</p>
            <div class="browse-buttons">
                <button>All discussions</button>
                <button>Popular</button>
                <button>Unanswered</button>
            </div>

            <p class="section-label">CATEGORIES</p>
            <nav class="categories">
                <a href="#"># General</a>
                <a href="#"># Help</a>
                <a href="#"># Announcements</a>
                <a href="#"># Feedback</a>
                <a href="#"># Off Topic</a>
            </nav>

            <h2>A space for everyone</h2>
            <p>Be curious, stay respectful, and<br>keep the conversation helpful.</p>
            <a class="guidelines" href="#">Community guidelines</a>
        </aside>

        <section class="discussion-content">
            <div class="discussion-tools">
                <label class="search-box">
                    <span>⌕</span>
                    <input type="text" placeholder="Search discussions">
                </label>
                <button class="activity-button">↕ <span>Latest activity</span></button>
            </div>

            <div class="discussion-list discussion-list-all">
                <header class="list-header">
                <div><h2>Discussion list</h2><small><?= array_sum(array_map(
                    static fn(array $userData): int => count($userData['topics']),
                    $users
                )) ?></small></div>
                <div class="list-columns"><span>Replies</span><span>Activity</span></div>
            </header>

            <?php
            $topicCount = 0;
            foreach ($users as $userData) {
                $author = $userData['user'];

                foreach ($userData['topics'] as $topicData) {
                    $topic = $topicData['topic'];
                    $category = $topicData['category'];
                    $topicCount++;
                    ?>
                <article class="discussion-row">
                    <div class="discussion-main">
                        <span class="avatar">
                            <img src="<?= $link->asset($author->getProfilePicture()) ?>"
                                 alt="<?= e($author->getName()) ?>'s profile picture">
                        </span>
                        <div>
                            <a href="#"><?= e($topic->getTitle()) ?></a>
                            <p><?= e($category?->getName() ?? 'Uncategorized') ?> · <?= e($author->getName()) ?></p>
                        </div>
                    </div>
                    <div class="discussion-stats">
                        <span>—</span>
                        <span><?= e($topic->getCreatedAt()->format('Y-m-d H:i')) ?></span>
                    </div>
                </article>
                <?php }
            } ?>

            <footer class="list-footer">
                <span>Showing <?= $topicCount ?> discussion<?= $topicCount === 1 ? '' : 's' ?></span>
                <nav><a href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">22</a></nav>
            </footer>
            </div>
        </section>
    </div>
</main>
