<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="icon" href="<?= base_url() ?>/images/logo.png">
</head>
<style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Mukta');

    body {
        font-family: 'Mukta', sans-serif;
        height: 100vh;
        min-height: 550px;
        background-image: url(<?= base_url('assets/images/image.png') ?>);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        position: relative;
        overflow-y: hidden;
    }

    a {
        text-decoration: none;
        color: #444444;
    }

    .login-reg-panel {
        position: relative;
        top: 50%;
        transform: translateY(-50%);
        text-align: center;
        width: 70%;
        right: 0;
        left: 0;
        margin: auto;
        height: 400px;
        background-color: rgba(190, 72, 251, 0.9);
    }

    .white-panel {
        background-color: #252525;
        height: 500px;
        position: absolute;
        top: -50px;
        width: 50%;
        right: calc(50% - 50px);
        transition: .3s ease-in-out;
        z-index: 0;
        box-shadow: 0 0 15px 9px #00000096;
    }

    .login-reg-panel input[type="radio"] {
        position: relative;
        display: none;
    }

    .login-reg-panel {
        color: #000;
    }

    .login-reg-panel #label-login,
    .login-reg-panel #label-register {
        border: 1px solid #ffffff;
        padding: 5px 5px;
        width: 150px;
        display: block;
        text-align: center;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        font-size: 18px;
    }

    .login-info-box {
        width: 30%;
        padding: 0 50px;
        top: 20%;
        left: 0;
        position: absolute;
        text-align: left;
        color: #ffffff;
    }

    .register-info-box {
        width: 30%;
        padding: 0 50px;
        top: 20%;
        right: 0;
        position: absolute;
        text-align: left;
        color: #ffffff;

    }

    .right-log {
        right: 50px !important;
    }

    .login-show,
    .register-show {
        z-index: 1;
        display: none;
        opacity: 0;
        transition: 0.3s ease-in-out;
        color: #fff;
        text-align: left;
        padding: 50px;
    }

    .show-log-panel {
        display: block;
        opacity: 0.9;
    }

    .login-show input[type="text"],
    .login-show input[type="password"] {
        width: 100%;
        display: block;
        margin: 20px 0;
        padding: 15px;
        border: 1px solid #b5b5b5;
        outline: none;
        background-color: #E8F0FE;
    }

    .login-show input[type="submit"] {
        max-width: 150px;
        width: 100%;
        background: #bd48f9;
        color: #ffffff;
        border: none;
        padding: 10px;
        text-transform: uppercase;
        border-radius: 2px;
        float: right;
        cursor: pointer;
    }

    .login-show a {
        display: inline-block;
        padding: 10px 0;
    }

    .register-show input[type="text"],
    .register-show input[type="password"] {
        width: 100%;
        display: block;
        margin: 20px 0;
        padding: 15px;
        border: 1px solid #b5b5b5;
        outline: none;
        background-color: #E8F0FE;
    }

    .register-show input[type="submit"] {
        max-width: 150px;
        width: 100%;
        background: #bd48f9;
        color: #ffffff;
        font-weight: 400;
        border: none;
        padding: 10px;
        text-transform: uppercase;
        border-radius: 2px;
        float: right;
        cursor: pointer;
    }

    .credit {
        position: absolute;
        bottom: 10px;
        left: 10px;
        color: #3B3B25;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        text-transform: uppercase;
        font-size: 12px;
        font-weight: bold;
        letter-spacing: 1px;
        z-index: 99;
    }

    a {
        text-decoration: none;
        color: #2c7715;
    }
</style>

<body>
    <div class="login-reg-panel">
        <div class="login-info-box">
            <h2>Anda sudah memiliki akun?</h2>
            <p>Silahkan login disini</p>
            <label id="label-register" for="log-reg-show">Login</label>
            <input type="radio" name="active-log-panel" id="log-reg-show" checked="checked">
        </div>

        <div class="register-info-box">
            <h2>Anda belum memiliki akun?</h2>
            <p>Lakukan pendaftaran sekarang</p>
            <label id="label-login" for="log-login-show">Register</label>
            <input type="radio" name="active-log-panel" id="log-login-show">
        </div>

        <div class="white-panel">
            <div class="login-show">
                <p><?= $this->session->flashdata('msg'); ?></p>
                <form action="<?= site_url('Auth/login') ?>" method="post">
                    <input type="text" name="email" placeholder="Email" required="">
                    <input type="password" name="password" placeholder="Password" required="">
                    <input type="submit" name="login" value="Login">
                </form>
            </div>
            <div class="register-show">
                <form action="<?= site_url('Auth/daftar') ?>" method="post">
                    <input type="text" name="nama" placeholder="Nama Lengkap" required="">
                    <input type="text" name="mail" placeholder="Email" required="">
                    <input type="password" name="password" placeholder="Password" required="">
                    <input type="password" name="telp" placeholder="No Telp" required="">
                    <input type="hidden" name="akses" value="User">
                    <input type="submit" name="daftar" value="Register">
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.login-info-box').fadeOut();
            $('.login-show').addClass('show-log-panel');
        });


        $('.login-reg-panel input[type="radio"]').on('change', function() {
            if ($('#log-login-show').is(':checked')) {
                $('.register-info-box').fadeOut();
                $('.login-info-box').fadeIn();

                $('.white-panel').addClass('right-log');
                $('.register-show').addClass('show-log-panel');
                $('.login-show').removeClass('show-log-panel');

            } else if ($('#log-reg-show').is(':checked')) {
                $('.register-info-box').fadeIn();
                $('.login-info-box').fadeOut();

                $('.white-panel').removeClass('right-log');

                $('.login-show').addClass('show-log-panel');
                $('.register-show').removeClass('show-log-panel');
            }
        });
    </script>
</body>

</html>