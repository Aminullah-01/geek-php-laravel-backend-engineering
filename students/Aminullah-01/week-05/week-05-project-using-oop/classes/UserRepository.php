<?php

class UserRepository {
    private PDO $conn;

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function existsByEmail(string $email): bool {
        $sql = "SELECT 1 FROM oop WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return (bool) $stmt->fetchColumn();
    }

    public function createUser(User $user): bool {
        $sql = "INSERT INTO oop (fullName, username, email, password)
                VALUES (:fullName, :username, :email, :password)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':fullName' => $user->getFullName(),
            ':username' => $user->getUsername(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPasswordHash() // hashed value stored in `password`
        ]);
    }

    public function getUserByUsername(string $username): ?User {
        $sql = "SELECT * FROM oop WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':username' => $username]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;

        
        return new User($row['fullName'], $row['username'], $row['email'], $row['password']);
    }

    public function getUserByEmail(string $email): ?User {
        $sql = "SELECT * FROM oop WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;

        return new User($row['fullName'], $row['username'], $row['email'], $row['password']);
    }


    public function updateResetToken(string $email, string $token, string $expires): bool {
    $sql = "UPDATE oop 
            SET reset_token = :token, reset_expires = :expires 
            WHERE email = :email";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        ':token' => $token,
        ':expires' => $expires,
        ':email' => $email
    ]);
}

public function findByResetToken(string $token): ?array {
    $sql = "SELECT * FROM oop 
            WHERE reset_token = :token 
            LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':token' => $token]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}

public function updatePasswordAndClearReset(int $id, string $hashedPassword): bool {
    $sql = "UPDATE oop 
            SET password = :password, reset_token = NULL, reset_expires = NULL 
            WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        ':password' => $hashedPassword,
        ':id' => $id
    ]);
}

}
