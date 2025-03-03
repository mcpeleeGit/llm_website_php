<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include 'common/head.php'; ?>
</head>

<body>
    <?php include 'common/navigation.php'; ?>

    <div class="text-center p-8">
        <h2 class="text-5xl font-extrabold text-gray-800">📊 관리자 대시보드</h2>
        <p class="text-gray-700 mt-3 text-lg">관리자 페이지에서 사이트를 관리하세요.</p>
    </div>

    <section class="p-8 max-w-4xl mx-auto bg-white shadow-lg rounded-2xl p-6">
        <nav class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="manage_noodles.php" class="bg-blue-500 text-white p-4 rounded-lg text-center text-xl font-bold">국수 도감 관리</a>
            <a href="manage_recipes.php" class="bg-green-500 text-white p-4 rounded-lg text-center text-xl font-bold">레시피 관리</a>
            <a href="manage_restaurants.php" class="bg-yellow-500 text-white p-4 rounded-lg text-center text-xl font-bold">맛집 추천 관리</a>
            <a href="manage_community.php" class="bg-purple-500 text-white p-4 rounded-lg text-center text-xl font-bold">커뮤니티 관리</a>
            <a href="manage_users.php" class="bg-red-500 text-white p-4 rounded-lg text-center text-xl font-bold">회원 관리</a>
        </nav>
        <div class="text-center mt-6">
            <button onclick="logoutAdmin()" class="bg-gray-600 text-white px-6 py-3 rounded-lg">로그아웃</button>
        </div>
    </section>

</body>

</html>