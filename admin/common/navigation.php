<?php session_start(); ?>


<nav class="bg-gray-800 p-4 shadow-lg flex justify-between items-center rounded-b-2xl">
    <h1 class="text-3xl font-extrabold text-white">🛠️ 관리자 페이지</h1>
    <ul class="hidden md:flex gap-8 text-white text-lg">
        <li><a href="dashboard.php" class="hover:underline">대시보드</a></li>
        <li><a href="manage_noodles.php" class="hover:underline">국수 도감 관리</a></li>
        <li><a href="manage_recipes.php" class="hover:underline">레시피 관리</a></li>
        <li><a href="manage_restaurants.php" class="hover:underline">맛집 추천 관리</a></li>
        <li><a href="manage_community.php" class="hover:underline">커뮤니티 관리</a></li>
        <li><a href="manage_users.php" class="hover:underline">회원 관리</a></li>
        <li><button onclick="logoutAdmin()" class="hover:underline">로그아웃</button></li>
    </ul>
</nav>