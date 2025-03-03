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
    <?php include '../admin/common/head.php'; ?>
</head>

<body>
    <?php include '../admin/common/navigation.php'; ?>

    <div class="text-center p-8">
        <h2 class="text-5xl font-extrabold text-gray-800">🏠 맛집 추천 관리</h2>
        <p class="text-gray-700 mt-3 text-lg">맛집 추천 데이터를 등록, 수정, 삭제할 수 있습니다.</p>
    </div>

    <section class="p-8 max-w-4xl mx-auto bg-white shadow-lg rounded-2xl p-6">
        <button onclick="openForm()" class="bg-blue-500 text-white px-6 py-3 rounded-lg">새 맛집 추가</button>
        <table class="w-full mt-6 border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">ID</th>
                    <th class="border border-gray-300 p-2">이미지</th>
                    <th class="border border-gray-300 p-2">이름</th>
                    <th class="border border-gray-300 p-2">설명</th>
                    <th class="border border-gray-300 p-2">관리</th>
                </tr>
            </thead>
            <tbody id="restaurantTable">
                <!-- 맛집 목록이 여기에 동적으로 추가됨 -->
            </tbody>
        </table>
    </section>

    <!-- 맛집 추가 및 수정 폼 -->
    <div id="restaurantForm" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
            <h3 class="text-2xl font-bold" id="formTitle">새 맛집 추가</h3>
            <input type="hidden" id="type" value="restaurant">
            <input type="hidden" id="restaurantId">
            <input type="text" id="restaurantName" placeholder="이름" class="w-full p-3 border rounded-lg mb-3" required>
            <input type="text" id="restaurantImage" placeholder="이미지 URL" class="w-full p-3 border rounded-lg mb-3" required>
            <textarea id="restaurantDescription" placeholder="설명" class="w-full p-3 border rounded-lg mb-3" required></textarea>
            <textarea id="restaurantContext" placeholder="상세 정보 (JSON 형식)" class="w-full p-3 border rounded-lg mb-3" required></textarea>
            <button onclick="saveRestaurant()" class="bg-green-500 text-white px-6 py-3 rounded-lg w-full">저장</button>
            <button onclick="closeForm()" class="bg-red-500 text-white px-6 py-3 rounded-lg w-full mt-2">취소</button>
        </div>
    </div>

    <script>
        function editRestaurant(id, name, description, image, context) {
            document.getElementById("restaurantId").value = id;
            document.getElementById("restaurantName").value = name;
            document.getElementById("restaurantImage").value = image;
            document.getElementById("restaurantDescription").value = description;
            document.getElementById("restaurantContext").value = JSON.parse(decodeURIComponent(context));
            document.getElementById("formTitle").innerText = "맛집 수정";
            document.getElementById("restaurantForm").classList.remove("hidden");
        }

        function fetchRestaurants() {
            axios.get("../v1/controller/RestaurantController.php?action=getAll")
                .then(response => {
                    let rows = "";
                    response.data.restaurants.forEach(restaurant => {
                        rows += `<tr>
                                    <td class='border p-2'>${restaurant.id}</td>
                                    <td class='border p-2'><img src="../${restaurant.image}" class="w-16 h-16 rounded-lg"></td>
                                    <td class='border p-2'>${restaurant.name}</td>
                                    <td class='border p-2'>${restaurant.description}</td>
                                    <td class='border p-2'>
                                        <button onclick="editRestaurant(${restaurant.id}, '${restaurant.name}', '${restaurant.description}', '${restaurant.image}', '${encodeURIComponent(JSON.stringify(restaurant.context))}')" class='bg-yellow-500 px-2 py-1 text-white rounded'>수정</button>
                                        <button onclick="deleteRestaurant(${restaurant.id})" class='bg-red-500 px-2 py-1 text-white rounded'>삭제</button>
                                    </td>
                                </tr>`;
                    });
                    document.getElementById("restaurantTable").innerHTML = rows;
                });
        }

        function openForm() {
            document.getElementById("restaurantId").value = "";
            document.getElementById("restaurantName").value = "";
            document.getElementById("restaurantImage").value = "";
            document.getElementById("restaurantDescription").value = "";
            document.getElementById("restaurantContext").value = "{}";
            document.getElementById("formTitle").innerText = "새 맛집 추가";
            document.getElementById("restaurantForm").classList.remove("hidden");
        }

        function closeForm() {
            document.getElementById("restaurantForm").classList.add("hidden");
        }

        function saveRestaurant() {
            let formData = new URLSearchParams();
            formData.append("action", "save");
            formData.append("id", document.getElementById("restaurantId").value);
            formData.append("name", document.getElementById("restaurantName").value);
            formData.append("image", document.getElementById("restaurantImage").value);
            formData.append("description", document.getElementById("restaurantDescription").value);
            formData.append("context", document.getElementById("restaurantContext").value);

            axios.post("../v1/controller/RestaurantController.php", formData)
                .then(response => {
                    alert(response.data.message);
                    closeForm();
                    fetchRestaurants();
                });
        }

        function deleteRestaurant(id) {
            if (!confirm("정말 삭제하시겠습니까?")) return;

            axios.post("../v1/controller/RestaurantController.php", new URLSearchParams({
                    action: "delete",
                    id: id
                }))
                .then(response => {
                    alert(response.data.message);
                    fetchRestaurants();
                });
        }

        fetchRestaurants();
    </script>
</body>

</html>