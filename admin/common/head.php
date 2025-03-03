<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Noodle World</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<style>
    body {
        background: f4f4f9;
        font-family: 'Poppins', sans-serif;
    }
</style>
<script>
    function logoutAdmin() {
        let formData = new URLSearchParams();
        formData.append("action", "adminLogout");

        axios.post("../v1/controller/AdminAuthController.php", formData, {
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            })
            .then(response => {
                if (response.data.success) {
                    alert("관리자 로그아웃 되었습니다.");
                    window.location.href = "admin_login.php";
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
    }
</script>