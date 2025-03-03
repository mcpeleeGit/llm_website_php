<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include 'common/head.php'; ?>
    <script>
        function loginUser(event) {
            event.preventDefault();

            let formData = new FormData(document.getElementById("loginForm"));
            formData.append("action", "login"); // login action 추가

            axios.post("v1/controller/AuthController.php", formData)
                .then(response => {
                    if (response.data.success) {
                        alert("로그인 성공!");
                        window.location.href = "mypage.php";
                    } else {
                        document.getElementById("errorMessage").innerText = response.data.message;
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    document.getElementById("errorMessage").innerText = "로그인 중 오류가 발생했습니다.";
                });
        }
    </script>
</head>

<body>
    <?php include 'common/navigation.php'; ?>
    <div class="text-center p-8">
        <h2 class="text-5xl font-extrabold text-gray-800">🔑 로그인</h2>
        <p class="text-gray-700 mt-3 text-lg">계정에 로그인하세요.</p>
    </div>

    <section class="p-8 max-w-md mx-auto bg-white shadow-lg rounded-2xl p-6">
        <p id="errorMessage" class="text-red-600 mb-4"></p>
        <form id="loginForm" onsubmit="loginUser(event)">
            <input type="text" name="username" placeholder="아이디" class="w-full p-3 border rounded-lg mb-3" required>
            <input type="password" name="password" placeholder="비밀번호" class="w-full p-3 border rounded-lg mb-3" required>
            <button type="submit" class="bg-yellow-600 text-white px-6 py-3 rounded-lg w-full">로그인</button>
        </form>
        <p class="text-gray-700 mt-4">아직 계정이 없으신가요? <a href="register.php" class="text-blue-600">회원가입</a></p>
    </section>
    <?php include 'common/footer.php'; ?>
</body>

</html>