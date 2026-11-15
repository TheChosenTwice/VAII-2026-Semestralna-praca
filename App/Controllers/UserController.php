<?php

namespace App\Controllers;

use App\Configuration;
use App\Models\User;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;
use Framework\Http\UploadedFile;

class UserController extends BaseController
{
    /**
     * @inheritDoc
     */
    public function index(Request $request): Response
    {
        return $this->html();
    }
    //:TODO AI generated method, review code later
    public function authorize(Request $request, string $action): bool
    {
        if ($action === 'edit' || $action === 'delete') {
            return $this->user->isLoggedIn();
        }

        return parent::authorize($request, $action);
    }

    //:TODO AI generated method, review code later
    public function delete(Request $request): Response
    {
        if (!$request->isPost()) {
            return $this->redirect($this->url('user.edit'));
        }

        $identity = $this->user->getIdentity();
        if (!$identity instanceof User) {
            return $this->redirect($this->url('home.index'));
        }

        $profilePicture = $identity->getProfilePictureFilename();
        $identity->delete();
        if ($profilePicture !== null && $profilePicture !== 'default_pfp.png') {
            $this->deleteProfilePicture($profilePicture);
        }

        $this->app->getAuthenticator()->logout();
        return $this->redirect($this->url('home.index'));
    }

    //:TODO AI generated method, review code later
    public function edit(Request $request): Response
    {
        $identity = $this->user->getIdentity();
        if (!$identity instanceof User) {
            return $this->redirect($this->url('home.index'));
        }

        $message = null;
        $username = $identity->getLogin() ?? '';

        if ($request->hasValue('submit')) {
            $username = trim((string)$request->value('username'));
            $currentPassword = (string)$request->value('current_password');
            $newPassword = (string)$request->value('new_password');
            $confirmPassword = (string)$request->value('confirm_password');

            if ($username === '' || strlen($username) > 100) {
                $message = 'Name must be between 1 and 100 characters.';
            } elseif (User::getCount('`login` = ? AND `id` <> ?', [$username, $identity->getId()]) > 0) {
                $message = 'This name is already taken.';
            } elseif (
                ($newPassword !== '' || $confirmPassword !== '' || $currentPassword !== '')
                && ($currentPassword === '' || $newPassword === '' || $confirmPassword === '')
            ) {
                $message = 'Enter your current password, a new password, and its confirmation.';
            } elseif ($newPassword !== '' && !password_verify($currentPassword, (string)$identity->getPasswordHash())) {
                $message = 'Current password is incorrect.';
            } elseif ($newPassword !== '' && strlen($newPassword) < 6) {
                $message = 'New password must be at least 6 characters long.';
            } elseif ($newPassword !== '' && $newPassword !== $confirmPassword) {
                $message = 'New passwords do not match.';
            } else {
                $identity->setLogin($username);
                if ($newPassword !== '') {
                    $identity->setPassword($newPassword);
                }

                $profilePicture = $request->file('profile_picture');
                $oldProfilePicture = $identity->getProfilePictureFilename();
                $newProfilePicture = null;
                if ($profilePicture instanceof UploadedFile && $profilePicture->getError() !== UPLOAD_ERR_NO_FILE) {
                    $filename = $this->storeProfilePicture($profilePicture);
                    if ($filename === null) {
                        $message = 'Profile picture must be a valid PNG, JPEG, GIF, or WEBP image up to 5 MB.';
                    } else {
                        $newProfilePicture = $filename;
                        $identity->setProfilePicture($filename);
                    }
                }

                if ($message === null) {
                    $identity->save();
                    if (
                        $newProfilePicture !== null
                        && $oldProfilePicture !== null
                        && $oldProfilePicture !== 'default_pfp.png'
                    ) {
                        $this->deleteProfilePicture($oldProfilePicture);
                    }
                    return $this->redirect($this->url('home.index'));
                }
            }
        }

        return $this->html(compact('message', 'username', 'identity'));
    }

    //TODO: AI generated method, review code later
    private function storeProfilePicture(UploadedFile $file): ?string
    {
        if (!$file->isOk() || $file->getSize() > 5 * 1024 * 1024) {
            return null;
        }

        $imageInfo = @getimagesize($file->getFileTempPath());
        if (!is_array($imageInfo)) {
            return null;
        }

        $extension = match ($imageInfo[2] ?? null) {
            IMAGETYPE_JPEG => 'jpg',
            IMAGETYPE_PNG => 'png',
            IMAGETYPE_GIF => 'gif',
            IMAGETYPE_WEBP => 'webp',
            default => null,
        };
        if ($extension === null) {
            return null;
        }

        $uploadDirectory = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR .
            Configuration::UPLOAD_DIR;
        if (!is_dir($uploadDirectory) && !mkdir($uploadDirectory, 0755, true) && !is_dir($uploadDirectory)) {
            return null;
        }

        $filename = bin2hex(random_bytes(16)) . '.' . $extension;
        return $file->store($uploadDirectory . $filename) ? $filename : null;
    }

    //:TODO AI generated method, review code later
    private function deleteProfilePicture(string $filename): void
    {
        $path = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR .
            Configuration::UPLOAD_DIR . basename($filename);
        if (is_file($path) && !unlink($path)) {
            throw new \RuntimeException('Failed to delete the previous profile picture.');
        }
    }
}
