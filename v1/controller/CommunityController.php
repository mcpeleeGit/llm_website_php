<?php
session_start();
require_once __DIR__ . '/../../config/database.php';
header('Content-Type: application/json');

class CommunityController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllPosts()
    {
        $stmt = $this->pdo->prepare("SELECT cp.id, cp.title, cp.content, u.username AS author FROM community_posts cp JOIN users u ON cp.user_id = u.id ORDER BY cp.created_at DESC");
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ["success" => true, "posts" => $posts];
    }

    public function deletePost($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM community_posts WHERE id = ?");
        $result = $stmt->execute([$id]);
        return $result ? ["success" => true, "message" => "게시글이 삭제되었습니다."] : ["success" => false, "message" => "삭제 중 오류 발생."];
    }
}

// 요청 처리 분기 (GET 또는 POST 지원)
$action = $_GET['action'] ?? $_POST['action'] ?? '';
$requestData = $_POST + $_GET;

$controller = new CommunityController($pdo);
$response = ["success" => false, "message" => "잘못된 요청입니다."];

if ($action === "getAll") {
    $response = $controller->getAllPosts();
} elseif ($action === "delete") {
    $response = $controller->deletePost($requestData['id'] ?? null);
}

echo json_encode($response);
