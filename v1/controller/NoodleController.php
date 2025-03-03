<?php
session_start();
require_once __DIR__ . '/../../config/database.php';
header('Content-Type: application/json');

class NoodleController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllNoodles()
    {
        $stmt = $this->pdo->prepare("SELECT id, title AS name, description, image, context FROM contents WHERE type = 'noodle'");
        $stmt->execute();
        $noodles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ["success" => true, "noodles" => $noodles];
    }

    public function saveNoodle($data)
    {
        if (empty($data['name']) || empty($data['description']) || empty($data['image']) || empty($data['context'])) {
            return ["success" => false, "message" => "이름, 설명, 이미지, 상세 정보를 입력하세요."];
        }

        if (!empty($data['id'])) {
            // 수정
            $stmt = $this->pdo->prepare("UPDATE contents SET title = ?, description = ?, image = ?, context = ?, updated_at = NOW() WHERE id = ? AND type = 'noodle'");
            $result = $stmt->execute([$data['name'], $data['description'], $data['image'], $data['context'], $data['id']]);
            $message = "국수 정보가 수정되었습니다.";
        } else {
            // 새로 추가
            $stmt = $this->pdo->prepare("INSERT INTO contents (type, title, description, image, context, created_at) VALUES ('noodle', ?, ?, ?, ?, NOW())");
            $result = $stmt->execute([$data['name'], $data['description'], $data['image'], $data['context']]);
            $message = "새 국수가 추가되었습니다.";
        }

        return $result ? ["success" => true, "message" => $message] : ["success" => false, "message" => "오류가 발생했습니다."];
    }

    public function deleteNoodle($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM contents WHERE id = ? AND type = 'noodle'");
        $result = $stmt->execute([$id]);
        return $result ? ["success" => true, "message" => "국수가 삭제되었습니다."] : ["success" => false, "message" => "삭제 중 오류 발생."];
    }
}

// 요청 처리 분기 (GET 또는 POST 지원)
$action = $_GET['action'] ?? $_POST['action'] ?? '';
$requestData = $_POST + $_GET;

$controller = new NoodleController($pdo);
$response = ["success" => false, "message" => "잘못된 요청입니다."];

if ($action === "getAll") {
    $response = $controller->getAllNoodles();
} elseif ($action === "save") {
    $response = $controller->saveNoodle($requestData);
} elseif ($action === "delete") {
    $response = $controller->deleteNoodle($requestData['id'] ?? null);
}

echo json_encode($response);
