<?php session_start(); ?>

<nav class="bg-yellow-600 p-4 shadow-lg flex justify-between items-center rounded-b-2xl">
    <h1 class="text-3xl font-extrabold text-white">🍜 Noodle World</h1>
    <button id="menuToggle" class="md:hidden text-white text-2xl">☰</button>
    <ul id="menu" class="hidden md:flex gap-8 text-white text-lg flex-col md:flex-row absolute md:static bg-yellow-600 w-full left-0 top-16 p-4 md:p-0 md:w-auto md:flex">
        <li><a href="/" class="hover:underline">홈</a></li>
        <li><a href="noodle-guide.php" class="hover:underline">국수 도감</a></li>
        <li><a href="recipes.php" class="hover:underline">레시피</a></li>
        <li><a href="restaurants.php" class="hover:underline">맛집 추천</a></li>
        <li><a href="community.php" class="hover:underline">커뮤니티</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="mypage.php" class="hover:underline">마이페이지</a></li>
            <li><a href="javascript:logoutUser()" class="hover:underline">로그아웃</a></li>
        <?php else: ?>
            <li><a href="login.php" class="hover:underline">로그인</a></li>
            <li><a href="register.php" class="hover:underline">회원가입</a></li>
        <?php endif; ?>
    </ul>
</nav>

<script>
    document.getElementById("menuToggle").addEventListener("click", function() {
        const menu = document.getElementById("menu");
        menu.classList.toggle("hidden");
    });
</script>