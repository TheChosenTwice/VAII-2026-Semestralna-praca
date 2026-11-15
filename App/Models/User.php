<?php

namespace App\Models;

use App\Configuration;
use Framework\Core\IIdentity;
use Framework\Core\Model;

class User extends Model implements IIdentity
{
    protected ?int $id = null;
    protected ?string $login = null;
    protected ?string $password = null; // hash
    protected ?string $role = 'user';
    protected ?string $profile_picture = 'default_pfp.png';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getPasswordHash(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getName(): string
    {
        return $this->login;
    }

    public function getProfilePicture(): ?string
    {
        if ($this->profile_picture === null || $this->profile_picture === 'default_pfp.png') {
            return '/images/default_pfp.png';
        }

        $uploadPath = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR .
            Configuration::UPLOAD_DIR . basename($this->profile_picture);
        if (!is_file($uploadPath)) {
            return '/images/default_pfp.png';
        }

        return Configuration::UPLOAD_URL . $this->profile_picture;
    }

    public function getProfilePictureFilename(): ?string
    {
        return $this->profile_picture;
    }

    public function setProfilePicture(?string $profile_picture): void
    {
        $this->profile_picture = $profile_picture;
    }
}