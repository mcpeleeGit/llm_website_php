<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include 'common/head.php'; ?>
    <script>
        function fetchUserInfo() {
            axios.get("v1/controller/UserController.php?action=getProfile")
                .then(response => {
                    if (response.data.success) {
                        document.getElementById("username").innerText = response.data.user.username;
                        document.getElementById("name").innerText = response.data.user.name;
                        document.getElementById("email").innerText = response.data.user.email;
                        document.getElementById("profileImage").src = response.data.user.profile_image ?? "/images/default_profile.jpg";
                    } else {
                        alert(response.data.message);
                        window.location.href = "login.php";
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });
        }

        window.onload = fetchUserInfo;
    </script>
</head>

<body>
    <?php include 'common/navigation.php'; ?>

    <div class="text-center p-8">
        <h2 class="text-5xl font-extrabold text-gray-800">👤 마이페이지</h2>
        <p class="text-gray-700 mt-3 text-lg">내 정보 관리</p>
    </div>

    <section class="p-8 max-w-4xl mx-auto bg-white shadow-lg rounded-2xl p-6">
        <img id="profileImage" src="/images/default_profile.jpg" class="w-32 h-32 mx-auto rounded-full">
        <h3 class="text-2xl font-bold mt-4" id="name"></h3>
        <p class="text-gray-700 mt-2"><b>아이디:</b> <span id="username"></span></p>
        <p class="text-gray-700"><b>이메일:</b> <span id="email"></span></p>
        <button onclick="logoutUser()" class="mt-4 inline-block bg-red-500 text-white px-6 py-2 rounded-lg">로그아웃</button>
    </section>

    <?php include 'common/footer.php'; ?>
</body>

</html>