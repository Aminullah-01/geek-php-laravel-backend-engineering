<?php

class User {
    private ?int $id = null;
    private string $fullName;
    private string $username;
    private string $email;
    private string $passwordHash;
    

    public function __construct(string $fullName, string $username, string $email, string $passwordHash) {
        $this->fullName = $fullName;
        $this->username = $username;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPasswordHash(): string {
        return $this->passwordHash;
    }

        public function getFullName(): string {
            return $this->fullName;
        }
}
