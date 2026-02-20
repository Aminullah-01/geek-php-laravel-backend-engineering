<?php




class PasswordResetService {
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function request(string $email): array {
        // Always return a generic message for security
        $generic = "If this email exists, a reset link has been generated.";

        // validate email format quickly
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['ok' => false, 'message' => $generic];
        }

        // try find user
        $user = $this->userRepo->getUserByEmail($email);
        if (!$user) {
            return ['ok' => true, 'message' => $generic];
        }

        $token = bin2hex(random_bytes(32));
        $expires = date("Y-m-d H:i:s", time() + 1800); // 30 mins

        $this->userRepo->updateResetToken($email, $token, $expires);

        // during development, return token so you can test link
        return ['ok' => true, 'message' => $generic, 'token' => $token];
    }

    public function validate(string $token): array {
        $row = $this->userRepo->findByResetToken($token);
        if (!$row) return ['ok' => false];

        // expiry check
        $now = date("Y-m-d H:i:s");
        if (empty($row['reset_expires']) || $row['reset_expires'] <= $now) {
            return ['ok' => false];
        }

        return ['ok' => true, 'user' => $row];
    }

    public function reset(string $token, string $newPassword): array {
        $check = $this->validate($token);
        if (!$check['ok']) return ['ok' => false, 'error' => 'Invalid or expired token'];

        if (strlen($newPassword) < 8) {
            return ['ok' => false, 'error' => 'Password must be at least 8 characters'];
        }

        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $userId = (int)$check['user']['id'];

        $this->userRepo->updatePasswordAndClearReset($userId, $hashed);

        return ['ok' => true];
    }
}



