<?php

/** @var array<int, \App\Models\Category> $categories */
/** @var string|null $message */
/** @var string $title */
/** @var string $categoryId */
/** @var \Framework\Support\LinkGenerator $link */
?>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card my-5">
                <div class="card-body">
                    <h1 class="card-title text-center h4 mb-4">Create new topic</h1>

                    <?php if ($message !== null) { ?>
                        <div class="text-center text-danger mb-3"><?= e($message) ?></div>
                    <?php } ?>

                    <form method="post" action="<?= $link->url('topic.create') ?>">
                        <div class="mb-3">
                            <label for="title" class="form-label">Topic title</label>
                            <input name="title" type="text" id="title" class="form-control"
                                   value="<?= e($title) ?>" maxlength="255" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">
                                Category <span class="text-muted">(optional)</span>
                            </label>
                            <select name="category_id" id="category_id" class="form-select">
                                <option value="">No category</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?= e($category->getId()) ?>"
                                        <?= $categoryId === (string)$category->getId() ? 'selected' : '' ?>>
                                        <?= e($category->getName()) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a class="btn btn-secondary" href="<?= $link->url('home.index') ?>">Cancel</a>
                            <button class="btn btn-primary" type="submit" name="submit">Create topic</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
