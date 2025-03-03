<?php
session_start();
require_once __DIR__ . '/../../config/database.php';
header('Content-Type: application/json');

class UserController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getUserProfile()
    {
        if (!isset($_SESSION["user_id"])) {
            return ["success" => false, "message" => "로그인이 필요합니다."];
        }

        $stmt = $this->pdo->prepare("SELECT username, name, email, profile_image FROM users WHERE id = ?");
        $stmt->execute([$_SESSION["user_id"]]);
        $user = $stmt->fetch();

        if ($user) {
            return ["success" => true, "user" => $user];
        }

        return ["success" => false, "message" => "사용자 정보를 가져올 수 없습니다."];
    }

    public function getAllUsers()
    {
        $stmt = $this->pdo->prepare("SELECT id, username, email, created_at FROM users ORDER BY created_at DESC");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ["success" => true, "users" => $users];
    }

    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $result = $stmt->execute([$id]);
        return $result ? ["success" => true, "message" => "회원이 삭제되었습니다."] : ["success" => false, "message" => "삭제 중 오류 발생."];
    }
}

// 요청 처리 분기 (GET 또는 POST 지원)
$action = $_GET['action'] ?? $_POST['action'] ?? '';
$requestData = $_POST + $_GET;

$userController = new UserController($pdo);
$response = ["success" => false, "message" => "잘못된 요청입니다."];

if ($action === "getProfile") {
    $response = $userController->getUserProfile();
} elseif ($action === "getAll") {
    $response = $userController->getAllUsers();
} elseif ($action === "delete") {
    $response = $userController->deleteUser($requestData['id'] ?? null);
}

echo json_encode($response);
