<?php
session_start();
require_once __DIR__ . '/../../config/database.php';
header('Content-Type: application/json');

class AuthController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function login($data)
    {
        if (!isset($data["username"]) || !isset($data["password"])) {
            return ["success" => false, "message" => "아이디와 비밀번호를 입력하세요."];
        }

        $username = trim($data["username"]);
        $password = $data["password"];

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            return ["success" => true, "message" => "로그인 성공!"];
        }

        return ["success" => false, "message" => "아이디 또는 비밀번호가 올바르지 않습니다."];
    }

    public function register($data)
    {
        if (!isset($data["username"]) || !isset($data["password"]) || !isset($data["password_confirm"]) || !isset($data["email"]) || !isset($data["name"])) {
            return ["success" => false, "message" => "모든 필드를 입력하세요."];
        }

        if ($data["password"] !== $data["password_confirm"]) {
            return ["success" => false, "message" => "비밀번호가 일치하지 않습니다."];
        }

        $username = trim($data["username"]);
        $email = trim($data["email"]);
        $password = password_hash($data["password"], PASSWORD_BCRYPT);
        $name = trim($data["name"]);

        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);

        if ($stmt->fetchColumn() > 0) {
            return ["success" => false, "message" => "이미 사용 중인 아이디 또는 이메일입니다."];
        }

        $stmt = $this->pdo->prepare("INSERT INTO users (username, password, email, name) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$username, $password, $email, $name])) {

            // 회원가입 성공 후 자동 로그인
            $user_id = $this->pdo->lastInsertId();
            $_SESSION["user_id"] = $user_id;
            $_SESSION["username"] = $username;

            return ["success" => true, "message" => "회원가입 성공!", "autoLogin" => true];
        }

        return ["success" => false, "message" => "회원가입 중 오류가 발생했습니다."];
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        return ["success" => true, "message" => "로그아웃 되었습니다."];
    }
}

// 요청 처리 분기
$authController = new AuthController($pdo);
$action = $_POST['action'] ?? '';
$response = ["success" => false, "message" => "잘못된 요청입니다." . $action];

if ($action === "login") {
    $response = $authController->login($_POST);
} elseif ($action === "register") {
    $response = $authController->register($_POST);
} elseif ($action === "logout") {
    $response = $authController->logout();
}

echo json_encode($response);
