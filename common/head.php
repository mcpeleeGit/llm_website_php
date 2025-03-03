<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Noodle World</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<style>
    body {
        background: linear-gradient(to bottom, #fdf6e3, #fae1af);
        font-family: 'Poppins', sans-serif;
    }
</style>
<?php if (isset($_SESSION['user_id'])): ?>

<?php else: ?>
    <script>
        function logoutUser() {
            let formData = new URLSearchParams();
            formData.append("action", "logout"); // 로그아웃 액션 추가

            axios.post("v1/controller/AuthController.php", formData, {
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    }
                })
                .then(response => {
                    if (response.data.success) {
                        alert("로그아웃 되었습니다.");
                        window.location.href = "/";
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });
        }
    </script>
<?php endif; ?>