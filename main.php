<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include 'common/head.php'; ?>
</head>

<body class="bg-gradient-to-b from-[#fdf6e3] to-[#fae1af]">
    <?php include 'common/navigation.php'; ?>

    <!-- 메인 페이지 -->
    <div class="text-center p-8">
        <h2 class="text-5xl font-extrabold text-gray-800">
            🍜 Welcome to Noodle World!
        </h2>
        <p class="text-gray-700 mt-3 text-lg">
            다양한 국수 레시피와 맛집을 만나보세요.
        </p>
        <img
            src="/images/noodles.jpg"
            alt="Noodles"
            class="mx-auto mt-6 rounded-2xl shadow-xl w-full max-w-3xl" />
    </div>

    <!-- 국수 도감 섹션 -->
    <section class="p-8">
        <h2 class="text-4xl font-extrabold text-gray-800 text-center">
            🌏 국수 도감
        </h2>
        <p class="text-gray-700 text-center text-lg">
            세계의 다양한 국수를 알아보세요!
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-6">
            <div
                class="bg-white p-6 rounded-2xl shadow-xl transform hover:scale-105 transition">
                <img src="/images/ramen.jpg" alt="Ramen" class="rounded-2xl w-full" />
                <h3 class="text-2xl font-bold mt-4">라멘</h3>
                <p class="text-gray-700">일본의 대표적인 국수 요리</p>
            </div>
            <div
                class="bg-white p-6 rounded-2xl shadow-xl transform hover:scale-105 transition">
                <img src="/images/pasta.jpg" alt="Pasta" class="rounded-2xl w-full" />
                <h3 class="text-2xl font-bold mt-4">파스타</h3>
                <p class="text-gray-700">이탈리아의 대표 면 요리</p>
            </div>
            <div
                class="bg-white p-6 rounded-2xl shadow-xl transform hover:scale-105 transition">
                <img src="/images/pho.jpg" alt="Pho" class="rounded-2xl w-full" />
                <h3 class="text-2xl font-bold mt-4">쌀국수</h3>
                <p class="text-gray-700">베트남의 향이 살아있는 국수</p>
            </div>
        </div>
    </section>

    <?php include 'common/footer.php'; ?>
</body>

</html>