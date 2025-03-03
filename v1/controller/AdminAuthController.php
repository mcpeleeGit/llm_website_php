<?php
session_start();
require_once __DIR__ . '/../../config/database.php';
header('Content-Type: application/json');

class AdminAuthController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function adminLogin($data)
    {
        if (!isset($data["username"]) || !isset($data["password"])) {
            return ["success" => false, "message" => "아이디와 비밀번호를 입력하세요."];
        }

        $username = trim($data["username"]);
        $password = $data["password"];

        $stmt = $this->pdo->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin["password"])) {
            $_SESSION["admin_id"] = $admin["id"];
            $_SESSION["admin_username"] = $admin["username"];
            return ["success" => true, "message" => "관리자 로그인 성공!"];
        }

        return ["success" => false, "message" => "아이디 또는 비밀번호가 올바르지 않습니다."];
    }

    public function adminLogout()
    {
        session_unset();
        session_destroy();
        return ["success" => true, "message" => "관리자 로그아웃 되었습니다."];
    }
}

// JSON 데이터 처리
$requestData = $_POST;
$action = $requestData['action'] ?? '';

$adminAuthController = new AdminAuthController($pdo);
$response = ["success" => false, "message" => "잘못된 요청입니다."];

if ($action === "adminLogin") {
    $response = $adminAuthController->adminLogin($requestData);
} elseif ($action === "adminLogout") {
    $response = $adminAuthController->adminLogout();
}

echo json_encode($response);
