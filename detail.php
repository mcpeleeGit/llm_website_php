<?php
session_start();
require_once 'config/database.php';

$title = $_GET['title'] ?? '';
$type = $_GET['type'] ?? '';

if (!$title || !$type) {
    die("잘못된 요청입니다.");
}

$stmt = $pdo->prepare("SELECT title, image, description, context FROM contents WHERE title = ? AND type = ?");
$stmt->execute([$title, $type]);
$entry = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$entry) {
    die("존재하지 않는 항목입니다.");
}

$context = json_decode($entry['context'], true);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include 'common/head.php'; ?>
</head>

<body>
    <?php include 'common/navigation.php'; ?>

    <div class="max-w-4xl mx-auto p-8">
        <h2 class="text-5xl font-extrabold text-gray-800">
            <?php echo $type === 'recipe' ? '🍽️' : ($type === 'restaurant' ? '🏠' : '🍜'); ?>
            <?php echo htmlspecialchars($entry['title']); ?>
        </h2>
        <img src="<?php echo htmlspecialchars($entry['image']); ?>" alt="<?php echo htmlspecialchars($entry['title']); ?>" class="w-full rounded-lg shadow-md mt-4" />
        <p class="text-lg text-gray-700 mt-4"> <?php echo nl2br(htmlspecialchars($entry['description'])); ?></p>

        <?php if ($type === 'recipe'): ?>
            <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-bold text-gray-800">📝 재료</h3>
                <ul class="list-disc pl-5 text-gray-700 mt-3">
                    <?php
                    if (isset($context['ingredients'])) {
                        foreach ($context['ingredients'] as $ingredient) {
                            echo "<li>" . htmlspecialchars($ingredient) . "</li>";
                        }
                    } else {
                        echo "<li>정보 없음</li>";
                    }
                    ?>
                </ul>
            </div>

            <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-bold text-gray-800">👨‍🍳 조리 방법</h3>
                <ol class="list-decimal pl-5 text-gray-700 mt-3">
                    <?php
                    if (isset($context['instructions'])) {
                        foreach ($context['instructions'] as $step) {
                            echo "<li>" . htmlspecialchars($step) . "</li>";
                        }
                    } else {
                        echo "<li>정보 없음</li>";
                    }
                    ?>
                </ol>
            </div>
        <?php elseif ($type === 'restaurant'): ?>
            <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-bold text-gray-800">🍽️ 대표 메뉴</h3>
                <ul class="list-disc pl-5 text-gray-700 mt-3">
                    <?php
                    if (isset($context['menu'])) {
                        foreach ($context['menu'] as $menu) {
                            echo "<li>" . htmlspecialchars($menu) . "</li>";
                        }
                    } else {
                        echo "<li>정보 없음</li>";
                    }
                    ?>
                </ul>
            </div>
            <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-bold text-gray-800">⭐ 평점</h3>
                <p class="text-gray-700 mt-3"> <?php echo htmlspecialchars($context['rating'] ?? '정보 없음'); ?> / 5</p>
            </div>
            <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-bold text-gray-800">📝 리뷰</h3>
                <p class="text-gray-700 mt-3"> <?php echo nl2br(htmlspecialchars($context['review'] ?? '정보 없음')); ?></p>
            </div>
            <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-bold text-gray-800">📍 위치</h3>
                <p class="text-gray-700 mt-3"> <?php echo htmlspecialchars($context['location'] ?? '정보 없음'); ?></p>
            </div>
        <?php else: ?>
            <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-bold text-gray-800">📖 상세 정보</h3>
                <ul class="list-disc pl-5 text-gray-700 mt-3">
                    <li><strong>기원:</strong> <?php echo htmlspecialchars($context['origin'] ?? '정보 없음'); ?></li>
                    <li><strong>주요 스타일:</strong> <?php echo isset($context['styles']) ? implode(', ', array_map('htmlspecialchars', $context['styles'])) : '정보 없음'; ?></li>
                    <li><strong>어떻게 먹을까?</strong> <?php echo htmlspecialchars($context['how_to_eat'] ?? '정보 없음'); ?></li>
                </ul>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'common/footer.php'; ?>
</body>

</html>