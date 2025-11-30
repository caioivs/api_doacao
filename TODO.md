# TODO: Fix 404 Error for Login URL

## Steps to Complete
- [x] Update Controller.php: Change redirect path from "/mvc_votacao/login/form" to "/api_doacao/login/form"
- [x] Update Auth.php: Change "/mvc_votacao/ideia/listar" to "/api_doacao/ideia/listar" in autenticarWeb method
- [x] Update Auth.php: Change "/mvc_votacao/login/form" to "/api_doacao/login/form" in autenticarWeb method (JavaScript alert)
- [x] Update Auth.php: Change "/mvc_votacao/home" to "/api_doacao/home" in logout method
- [x] Test the URL http://localhost/api_doacao/index.php?param=login/form to ensure it works
