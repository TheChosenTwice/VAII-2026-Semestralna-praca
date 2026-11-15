<?php

/** @var \Framework\Support\LinkGenerator $link */
?>

<main class="discussions-page">
    <h1>Discussions</h1>
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

            <div class="discussion-list">
                <header class="list-header">
                    <div><h2>Discussion list</h2><small>128</small></div>
                    <div class="list-columns"><span>Replies</span><span>Views</span><span>Activity</span></div>
                </header>

                <?php
                $discussions = [
                    ['DF', 'Welcome to the community', 'Announcements · Forum team', '12', '1.2k', '15 min ago'],
                    ['AM', 'Introduce yourself to the community', 'General · Alex Morgan', '28', '864', '32 min ago'],
                    ['JL', 'What are you working on this week?', 'General · Jamie Lee', '16', '342', '1 hour ago'],
                    ['TR', 'Share a resource you found useful', 'Resources · Taylor Reed', '9', '218', '2 hours ago'],
                    ['SW', 'How do I update my profile?', 'Questions · Sam Wilson', '4', '96', '3 hours ago'],
                    ['JK', 'Ideas for our next community discussion', 'Feedback · Jordan Kim', '7', '153', '5 hours ago'],
                ];
                foreach ($discussions as $discussion) { ?>
                    <article class="discussion-row">
                        <div class="discussion-main">
                            <span class="avatar"><?= $discussion[0] ?></span>
                            <div><a href="#"><?= $discussion[1] ?></a><p><?= $discussion[2] ?></p></div>
                        </div>
                        <div class="discussion-stats"><span><?= $discussion[3] ?></span><span><?= $discussion[4] ?></span><span><?= $discussion[5] ?></span></div>
                    </article>
                <?php } ?>

                <footer class="list-footer">
                    <span>Showing 1-6 of 128 discussions</span>
                    <nav><a href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">22</a></nav>
                </footer>
            </div>
        </section>
    </div>
</main>
