<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include 'common/head.php'; ?>
    <script>
        function fetchNoodles() {
            axios.get("v1/controller/NoodleController.php?action=getAll")
                .then(response => {
                    let content = "";
                    response.data.noodles.forEach(noodle => {
                        content += `<div class='bg-white p-6 rounded-2xl shadow-xl transform hover:scale-105 transition'>
                                        <a href="detail.php?type=noodle&title=${encodeURIComponent(noodle.name)}">
                                            <img src="${noodle.image}" alt="${noodle.name}" class="rounded-2xl w-full" />
                                            <h3 class="text-2xl font-bold mt-4">${noodle.name}</h3>
                                            <p class="text-gray-700">${noodle.description}</p>
                                        </a>
                                    </div>`;
                    });
                    document.getElementById("noodleContainer").innerHTML = content;
                });
        }

        document.addEventListener("DOMContentLoaded", fetchNoodles);
    </script>
</head>

<body>
    <?php include 'common/navigation.php'; ?>

    <div class="text-center p-8">
        <h2 class="text-5xl font-extrabold text-gray-800">🌏 국수 도감</h2>
        <p class="text-gray-700 mt-3 text-lg">세계 각국의 다양한 국수를 살펴보세요!</p>
    </div>

    <section class="p-8">
        <div id="noodleContainer" class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-6">
            <!-- Axios를 통해 동적 데이터 로딩 -->
        </div>
    </section>

    <?php include 'common/footer.php'; ?>
</body>

</html>