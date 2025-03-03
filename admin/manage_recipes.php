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
        <h2 class="text-5xl font-extrabold text-gray-800">🍳 레시피 관리</h2>
        <p class="text-gray-700 mt-3 text-lg">레시피 데이터를 등록, 수정, 삭제할 수 있습니다.</p>
    </div>

    <section class="p-8 max-w-4xl mx-auto bg-white shadow-lg rounded-2xl p-6">
        <button onclick="openForm()" class="bg-blue-500 text-white px-6 py-3 rounded-lg">새 레시피 추가</button>
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
            <tbody id="recipeTable">
                <!-- 레시피 목록이 여기에 동적으로 추가됨 -->
            </tbody>
        </table>
    </section>

    <!-- 레시피 추가 및 수정 폼 -->
    <div id="recipeForm" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
            <h3 class="text-2xl font-bold" id="formTitle">새 레시피 추가</h3>
            <input type="hidden" id="type" value="recipe">
            <input type="hidden" id="recipeId">
            <input type="text" id="recipeName" placeholder="이름" class="w-full p-3 border rounded-lg mb-3" required>
            <input type="text" id="recipeImage" placeholder="이미지 URL" class="w-full p-3 border rounded-lg mb-3" required>
            <textarea id="recipeDescription" placeholder="설명" class="w-full p-3 border rounded-lg mb-3" required></textarea>
            <textarea id="recipeContext" placeholder="상세 정보 (JSON 형식)" class="w-full p-3 border rounded-lg mb-3" required></textarea>
            <button onclick="saveRecipe()" class="bg-green-500 text-white px-6 py-3 rounded-lg w-full">저장</button>
            <button onclick="closeForm()" class="bg-red-500 text-white px-6 py-3 rounded-lg w-full mt-2">취소</button>
        </div>
    </div>

    <script>
        function openForm(id = '', name = '', description = '', image = '', context = '') {
            document.getElementById("recipeId").value = id;
            document.getElementById("recipeName").value = name;
            document.getElementById("recipeImage").value = image;
            document.getElementById("recipeDescription").value = description;
            document.getElementById("recipeContext").value = context;
            document.getElementById("formTitle").innerText = id ? "레시피 수정" : "새 레시피 추가";
            document.getElementById("recipeForm").classList.remove("hidden");
        }


        function closeForm() {
            document.getElementById("recipeForm").classList.add("hidden");
        }

        function saveRecipe() {
            let formData = new URLSearchParams();
            formData.append("action", "save");
            formData.append("id", document.getElementById("recipeId").value);
            formData.append("name", document.getElementById("recipeName").value);
            formData.append("image", document.getElementById("recipeImage").value);
            formData.append("description", document.getElementById("recipeDescription").value);
            formData.append("context", document.getElementById("recipeContext").value);

            axios.post("../v1/controller/RecipeController.php", formData)
                .then(response => {
                    alert(response.data.message);
                    closeForm();
                    fetchRecipes();
                });
        }

        function editRecipe(id, name, description, image, context) {
            document.getElementById("recipeId").value = id;
            document.getElementById("recipeName").value = name;
            document.getElementById("recipeImage").value = image;
            document.getElementById("recipeDescription").value = description;
            document.getElementById("recipeContext").value = JSON.parse(decodeURIComponent(context));
            document.getElementById("formTitle").innerText = "레시피 수정";
            document.getElementById("recipeForm").classList.remove("hidden");
        }

        function deleteRecipe(id) {
            if (!confirm("정말 삭제하시겠습니까?")) return;

            axios.post("../v1/controller/RecipeController.php", new URLSearchParams({
                    action: "delete",
                    id: id
                }))
                .then(response => {
                    alert(response.data.message);
                    fetchRecipes();
                });
        }

        function fetchRecipes() {
            axios.get("../v1/controller/RecipeController.php?action=getAll")
                .then(response => {
                    let rows = "";
                    response.data.recipes.forEach(recipe => {
                        rows += `<tr>
                                    <td class='border p-2'>${recipe.id}</td>
                                    <td class='border p-2'><img src="../${recipe.image}" class="w-16 h-16 rounded-lg"></td>
                                    <td class='border p-2'>${recipe.name}</td>
                                    <td class='border p-2'>${recipe.description}</td>
                                    <td class='border p-2'>
                                        <button onclick="editRecipe(${recipe.id}, '${recipe.name}', '${recipe.description}', '${recipe.image}', '${encodeURIComponent(JSON.stringify(recipe.context))}')" class='bg-yellow-500 px-2 py-1 text-white rounded'>수정</button>
                                        <button onclick="deleteRecipe(${recipe.id})" class='bg-red-500 px-2 py-1 text-white rounded'>삭제</button>
                                    </td>
                                </tr>`;
                    });
                    document.getElementById("recipeTable").innerHTML = rows;
                });
        }

        fetchRecipes();
    </script>
</body>

</html>