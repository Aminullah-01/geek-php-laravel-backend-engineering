<?php

class AuthService {
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function attempt(string $username, string $password): array {
         $user = $this->userRepo->getUserByUsername($username);

        if (!$user) {
            return ['ok' => false, 'error' => 'Invalid credentials'];
        }

        if (!password_verify($password, $user->getPasswordHash())) {
            return ['ok' => false, 'error' => 'Invalid credentials'];
        }
        
        return ['ok' => true, 'user' => $user];
    }

    public function login(User $user): void {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        session_regenerate_id(true);
        $_SESSION['user_id'] = $user->getUsername(); // later switch to ID

        $_SESSION['fullName'] = $user->getFullName();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['email'] = $user->getEmail();
    }

    public function check(): bool {
        return isset($_SESSION['user_id']);
    }

    public function logout(): void {
        session_unset();
        session_destroy();
    }
}

