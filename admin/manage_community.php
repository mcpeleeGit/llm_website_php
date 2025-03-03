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
        <h2 class="text-5xl font-extrabold text-gray-800">💬 커뮤니티 게시글 관리</h2>
        <p class="text-gray-700 mt-3 text-lg">커뮤니티 게시글을 조회, 수정, 삭제할 수 있습니다.</p>
    </div>

    <section class="p-8 max-w-4xl mx-auto bg-white shadow-lg rounded-2xl p-6">
        <table class="w-full mt-6 border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">ID</th>
                    <th class="border border-gray-300 p-2">작성자</th>
                    <th class="border border-gray-300 p-2">제목</th>
                    <th class="border border-gray-300 p-2">내용</th>
                    <th class="border border-gray-300 p-2">관리</th>
                </tr>
            </thead>
            <tbody id="communityTable">
                <!-- 게시글 목록이 여기에 동적으로 추가됨 -->
            </tbody>
        </table>
    </section>

    <script>
        function fetchCommunityPosts() {
            axios.get("../v1/controller/CommunityController.php?action=getAll")
                .then(response => {
                    let rows = "";
                    response.data.posts.forEach(post => {
                        rows += `<tr>
                                    <td class='border p-2'>${post.id}</td>
                                    <td class='border p-2'>${post.author}</td>
                                    <td class='border p-2'>${post.title}</td>
                                    <td class='border p-2'>${post.content.substring(0, 50)}...</td>
                                    <td class='border p-2'>
                                        <button onclick="deletePost(${post.id})" class='bg-red-500 px-2 py-1 text-white rounded'>삭제</button>
                                    </td>
                                </tr>`;
                    });
                    document.getElementById("communityTable").innerHTML = rows;
                });
        }

        function deletePost(id) {
            if (!confirm("정말 삭제하시겠습니까?")) return;

            axios.post("../v1/controller/CommunityController.php", new URLSearchParams({
                    action: "delete",
                    id: id
                }))
                .then(response => {
                    alert(response.data.message);
                    fetchCommunityPosts();
                });
        }

        fetchCommunityPosts();
    </script>
</body>

</html>