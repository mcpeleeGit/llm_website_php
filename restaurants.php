<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include 'common/head.php'; ?>
    <script>
        function fetchRestaurants() {
            axios.get("v1/controller/RestaurantController.php?action=getAll")
                .then(response => {
                    let content = "";
                    response.data.restaurants.forEach(restaurant => {
                        content += `<div class='bg-white p-6 rounded-2xl shadow-xl transform hover:scale-105 transition'>
                                        <a href="detail.php?title=${encodeURIComponent(restaurant.name)}&type=restaurant">
                                            <img src="${restaurant.image}" alt="${restaurant.name}" class="rounded-2xl w-full" />
                                            <h3 class="text-2xl font-bold mt-4">${restaurant.name}</h3>
                                            <p class="text-gray-700">${restaurant.description}</p>
                                        </a>
                                    </div>`;
                    });
                    document.getElementById("restaurantContainer").innerHTML = content;
                });
        }

        document.addEventListener("DOMContentLoaded", fetchRestaurants);
    </script>
</head>

<body>
    <?php include 'common/navigation.php'; ?>

    <div class="text-center p-8">
        <h2 class="text-5xl font-extrabold text-gray-800">🏠 맛집 추천</h2>
        <p class="text-gray-700 mt-3 text-lg">추천하는 맛집을 확인하고 방문해보세요!</p>
    </div>

    <section class="p-8 max-w-5xl mx-auto">
        <!-- 검색창 -->
        <div class="flex justify-center mb-6">
            <input
                type="text"
                placeholder="맛집 검색..."
                class="p-3 rounded-l-lg border w-2/3 md:w-1/2" />
            <button class="bg-yellow-600 text-white px-4 py-3 rounded-r-lg">
                검색
            </button>
        </div>

    </section>
    <section class="p-8">
        <div id="restaurantContainer" class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-6">
            <!-- Axios를 통해 동적 데이터 로딩 -->
        </div>
    </section>

    <?php include 'common/footer.php'; ?>
</body>

</html>