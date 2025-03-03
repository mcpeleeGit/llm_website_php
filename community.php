<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include 'common/head.php'; ?>
    <script>
        function fetchCommunityPosts() {
            axios.get("v1/controller/CommunityController.php?action=getAll")
                .then(response => {
                    let content = "";
                    response.data.posts.forEach(post => {
                        content += `<div class='bg-white p-6 rounded-2xl shadow-xl transform hover:scale-105 transition'>
                                        <h3 class="text-2xl font-bold mt-4">${post.title}</h3>
                                        <p class="text-gray-700 mt-2">${post.content.substring(0, 100)}...</p>
                                        <p class="text-gray-500 text-sm mt-2">작성자: ${post.author} | 작성일: ${post.created_at}</p>
                                    </div>`;
                    });
                    document.getElementById("communityContainer").innerHTML = content;
                });
        }

        document.addEventListener("DOMContentLoaded", fetchCommunityPosts);
    </script>
</head>

<body>
    <?php include 'common/navigation.php'; ?>

    <div class="text-center p-8">
        <h2 class="text-5xl font-extrabold text-gray-800">💬 커뮤니티</h2>
        <p class="text-gray-700 mt-3 text-lg">회원들과 소통하고 다양한 이야기를 나누어 보세요!</p>
    </div>
    <section class="p-8 max-w-5xl mx-auto">
        <!-- 게시글 작성 -->
        <div class="bg-white p-6 rounded-2xl shadow-xl mb-6">
            <h3 class="text-2xl font-bold text-gray-800">📝 글 작성</h3>
            <input
                type="text"
                placeholder="제목을 입력하세요"
                class="p-3 border w-full mt-3 rounded-lg" />
            <textarea
                placeholder="내용을 입력하세요..."
                class="p-3 border w-full mt-3 rounded-lg h-32"></textarea>
            <button class="bg-yellow-600 text-white px-6 py-3 rounded-lg mt-3">
                게시하기
            </button>
        </div>

        <?php include 'data/community_list.php'; ?>
        <?php include 'common/community_board.php'; ?>
    </section>
    <section class="p-8">
        <div id="communityContainer" class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-6">
            <!-- Axios를 통해 동적 데이터 로딩 -->
        </div>
    </section>

    <?php include 'common/footer.php'; ?>
</body>

</html>