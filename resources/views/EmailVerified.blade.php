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

    body {
        background: #104547;
        /* fallback for old browsers */
        font-family: "Roboto", sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
</style>

<div class="verified-page">
    <div class="square">
        <div>
            {{ $return }}
            <br>
            <br>
            <br>
            <button onclick="window.location.href = 'https://web-reserva-o6jvz.ondigitalocean.app/login'">Voltar para a plataforma</button>
        </div>
    </div>
</div>