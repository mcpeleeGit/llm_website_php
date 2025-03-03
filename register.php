<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include 'common/head.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function registerUser(event) {
            event.preventDefault();

            let formData = new FormData(document.getElementById("registerForm"));
            formData.append("action", "register"); // register action 추가

            axios.post("v1/controller/AuthController.php", formData)
                .then(response => {
                    if (response.data.success) {
                        alert("회원가입이 완료되었습니다!");
                        window.location.href = "/";
                    } else {
                        document.getElementById("errorMessage").innerText = response.data.message;
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    document.getElementById("errorMessage").innerText = "회원가입 중 오류가 발생했습니다.";
                });
        }
    </script>
</head>

<body>
    <?php include 'common/navigation.php'; ?>
    <div class="text-center p-8">
        <h2 class="text-5xl font-extrabold text-gray-800">📝 회원가입</h2>
        <p class="text-gray-700 mt-3 text-lg">새 계정을 만들어보세요!</p>
    </div>

    <section class="p-8 max-w-md mx-auto bg-white shadow-lg rounded-2xl p-6">
        <p id="errorMessage" class="text-red-600 mb-4"></p>
        <form id="registerForm" onsubmit="registerUser(event)">
            <input type="text" name="username" placeholder="아이디" class="w-full p-3 border rounded-lg mb-3" required>
            <input type="email" name="email" placeholder="이메일" class="w-full p-3 border rounded-lg mb-3" required>
            <input type="password" name="password" placeholder="비밀번호" class="w-full p-3 border rounded-lg mb-3" required>
            <input type="password" name="password_confirm" placeholder="비밀번호 확인" class="w-full p-3 border rounded-lg mb-3" required>
            <input type="text" name="name" placeholder="이름" class="w-full p-3 border rounded-lg mb-3" required>
            <button type="submit" class="bg-yellow-600 text-white px-6 py-3 rounded-lg w-full">회원가입</button>
        </form>
        <p class="text-gray-700 mt-4">이미 계정이 있으신가요? <a href="login.php" class="text-blue-600">로그인</a></p>
    </section>
    <?php include 'common/footer.php'; ?>
</body>

</html>