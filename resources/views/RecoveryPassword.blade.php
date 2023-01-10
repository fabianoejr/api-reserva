<style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

    .verified-page {
        width: 360px;
        padding: 8% 0 0;
        margin: auto;
    }

    .square {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }

    .square button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #104547;
        width: 100%;
        border: 0;
        padding: 15px;
        color: white;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
    }

    .square input {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
    }

    body {
        background: #104547;
        /* fallback for old browsers */
        font-family: "Roboto", sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
</style>
<script type="application/javascript">
    function validaForm() {
        var password = document.getElementById("password").value;
        var repeatPassword = document.getElementById("repeatPassword").value;
        console.log(password + repeatPassword);

        if (password != repeatPassword) {
            alert('Atenção! As senhas não condizem.');
            return false;
        }

        if (password.length < 6) {
            alert('Atenção! A senha deve ter mais que 6 caracteres.');
            return false;
        }
    }
</script>
<div class="verified-page">
    <div class="square">
        <div>
            <form class="register-form" action="https://octopus-app-mpimd.ondigitalocean.app/login/api/auth/recoveryPassword" method="POST" onSubmit='return validaForm()'>
                <input id="password" name="password" type="password" placeholder="Digite sua Senha" />
                <input id="repeatPassword" name="repeatPassword" type="password" placeholder="Repita a senha" />
                <input id="hash" name="hash" type="hidden" value="{{ explode('/', Request::url())[4] }}" placeholder="Hash" />
                <button>Alterar</button>
            </form>
        </div>
    </div>
</div>