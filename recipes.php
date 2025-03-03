<?php
session_start();
require_once 'config/database.php';
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include 'common/head.php'; ?>
    <script>
        function fetchRecipes() {
            axios.get("v1/controller/RecipeController.php?action=getAll")
                .then(response => {
                    let content = "";
                    response.data.recipes.forEach(recipe => {
                        content += `<div class='bg-white p-6 rounded-2xl shadow-xl transform hover:scale-105 transition'>
                                        <a href="detail.php?type=recipe&title=${encodeURIComponent(recipe.name)}">
                                            <img src="${recipe.image}" alt="${recipe.name}" class="rounded-2xl w-full" />
                                            <h3 class="text-2xl font-bold mt-4">${recipe.name}</h3>
                                            <p class="text-gray-700">${recipe.description}</p>
                                        </a>
                                    </div>`;
                    });
                    document.getElementById("recipeContainer").innerHTML = content;
                });
        }

        document.addEventListener("DOMContentLoaded", fetchRecipes);
    </script>
</head>

<body>
    <?php include 'common/navigation.php'; ?>

    <div class="text-center p-8">
        <h2 class="text-5xl font-extrabold text-gray-800">🍽️ 레시피</h2>
        <p class="text-gray-700 mt-3 text-lg">다양한 레시피를 확인하고 직접 만들어보세요!</p>
    </div>

    <section class="p-8">
        <div id="recipeContainer" class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-6">
            <!-- Axios를 통해 동적 데이터 로딩 -->
        </div>
    </section>

    <?php include 'common/footer.php'; ?>
</body>

</html>