<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include 'common/head.php'; ?>
    <script>
        function adminLogin(event) {
            event.preventDefault();

            let formData = new URLSearchParams();
            formData.append("action", "adminLogin");
            formData.append("username", document.getElementById("username").value);
            formData.append("password", document.getElementById("password").value);

            axios.post("../v1/controller/AdminAuthController.php", formData, {
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    }
                })
                .then(response => {
                    if (response.data.success) {
                        alert("관리자 로그인 성공!");
                        window.location.href = "dashboard.php";
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
    <div class="text-center p-8">
        <h2 class="text-5xl font-extrabold text-gray-800">🔑 관리자 로그인</h2>
        <p class="text-gray-700 mt-3 text-lg">관리자 계정으로 로그인하세요.</p>
    </div>

    <section class="p-8 max-w-md mx-auto bg-white shadow-lg rounded-2xl p-6">
        <p id="errorMessage" class="text-red-600 mb-4"></p>
        <form id="adminLoginForm" onsubmit="adminLogin(event)">
            <input type="text" id="username" name="username" placeholder="아이디" class="w-full p-3 border rounded-lg mb-3" required>
            <input type="password" id="password" name="password" placeholder="비밀번호" class="w-full p-3 border rounded-lg mb-3" required>
            <button type="submit" class="bg-yellow-600 text-white px-6 py-3 rounded-lg w-full">관리자 로그인</button>
        </form>
    </section>
</body>

</html>