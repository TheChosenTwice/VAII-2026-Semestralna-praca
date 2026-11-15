<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Topic;
use App\Models\User;
use DateTimeImmutable;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class TopicController extends BaseController
{
    public function authorize(Request $request, string $action): bool
    {
        return $action === 'my_topics' || $this->user->isLoggedIn();
    }

    /**
     * @inheritDoc
     */
    public function index(Request $request): Response
    {
        return $this->html();
    }

    public function create(Request $request): Response
    {
        $categories = Category::getAll(orderBy: '`name` ASC');
        $message = null;
        $title = trim((string)$request->value('title'));
        $categoryId = trim((string)$request->value('category_id'));

        if ($request->hasValue('submit')) {
            if ($title === '' || strlen($title) > 255) {
                $message = 'Topic title must be between 1 and 255 characters.';
            } elseif ($categoryId !== '' && !ctype_digit($categoryId)) {
                $message = 'Please select a valid category.';
            } elseif ($categoryId !== '' && Category::getOne((int)$categoryId) === null) {
                $message = 'Please select a valid category.';
            } else {
                $identity = $this->user->getIdentity();
                if (!$identity instanceof User || $identity->getId() === null) {
                    return $this->redirect(\App\Configuration::LOGIN_URL);
                }

                $topic = new Topic();
                $topic->setTitle($title);
                $topic->setUserId($identity->getId());
                $topic->setCategoryId($categoryId === '' ? null : (int)$categoryId);
                $topic->setCreatedAt(new DateTimeImmutable());
                $topic->save();

                return $this->redirect($this->url('home.index'));
            }
        }

        return $this->html(compact('categories', 'message', 'title', 'categoryId'));
    }

    public function delete(Request $request): Response
    {
        $identity = $this->user->getIdentity();
        if (!$request->isPost() || !$identity instanceof User || $identity->getId() === null) {
            return $this->redirect($this->url('topic.my_topics'));
        }

        $topicId = trim((string)$request->value('id'));
        if (!ctype_digit($topicId)) {
            return $this->redirect($this->url('topic.my_topics'));
        }

        $topic = Topic::getOne((int)$topicId);
        if ($topic !== null && $topic->getUserId() === $identity->getId()) {
            $topic->delete();
        }

        return $this->redirect($this->url('topic.my_topics'));
    }

    public function my_topics(Request $request): Response
    {
        $identity = $this->user->getIdentity();
        if (!$identity instanceof User || $identity->getId() === null) {
            return $this->redirect($this->url('home.index'));
        }

        $topics = array_map(
            static fn(Topic $topic): array => [
                'topic' => $topic,
                'category' => $topic->getCategoryId() === null
                    ? null
                    : $topic->getOneRelated(Category::class, 'category_id'),
            ],
            Topic::getAll('`user_id` = ?', [$identity->getId()], '`created_at` DESC')
        );

        return $this->html(compact('topics'));
    }

    public function edit(Request $request): Response
    {
        $identity = $this->user->getIdentity();
        $topicId = trim((string)$request->value('id'));
        if (!$identity instanceof User || $identity->getId() === null || !ctype_digit($topicId)) {
            return $this->redirect($this->url('home.index'));
        }

        $topic = Topic::getOne((int)$topicId);
        if ($topic === null || $topic->getUserId() !== $identity->getId()) {
            return $this->redirect($this->url('topic.my_topics'));
        }

        $categories = Category::getAll(orderBy: '`name` ASC');
        $message = null;
        $title = trim((string)($request->hasValue('submit') ? $request->value('title') : $topic->getTitle()));
        $categoryId = trim((string)($request->hasValue('submit')
            ? $request->value('category_id')
            : $topic->getCategoryId()));

        if ($request->hasValue('submit')) {
            if ($title === '' || strlen($title) > 255) {
                $message = 'Topic title must be between 1 and 255 characters.';
            } elseif ($categoryId !== '' && !ctype_digit($categoryId)) {
                $message = 'Please select a valid category.';
            } elseif ($categoryId !== '' && Category::getOne((int)$categoryId) === null) {
                $message = 'Please select a valid category.';
            } else {
                $topic->setTitle($title);
                $topic->setCategoryId($categoryId === '' ? null : (int)$categoryId);
                $topic->save();

                return $this->redirect($this->url('topic.my_topics'));
            }
        }

        return $this->html(compact('categories', 'message', 'title', 'categoryId', 'topic'));
    }
}
