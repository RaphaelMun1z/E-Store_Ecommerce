@extends('layouts.main')
@section('title', 'E-Store - Acesso')
@section('content')

<style>
    .navbar-expand-md .navbar-nav:nth-child(2) {
        display: none;
    }

    .forms-section {
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin-top: 20px;
        align-items: center;
    }

    .section-title {
        font-size: 32px;
        letter-spacing: 1px;
        color: #fff;
    }

    .forms {
        display: flex;
        align-items: flex-start;
        margin-top: 30px;
    }

    .form-wrapper {
        animation: hideLayer .3s ease-out forwards;
    }

    .form-wrapper form {
        box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px !important;
    }

    .form-wrapper.is-active {
        animation: showLayer .3s ease-in forwards;
    }

    @keyframes showLayer {
        50% {
            z-index: 1;
        }

        100% {
            z-index: 1;
        }
    }

    @keyframes hideLayer {
        0% {
            z-index: 1;
        }

        49.999% {
            z-index: 1;
        }
    }

    .switcher {
        position: relative;
        cursor: pointer;
        display: block;
        margin-right: auto;
        margin-left: auto;
        padding: 0;
        text-transform: uppercase;
        font-family: inherit;
        font-size: 16px;
        letter-spacing: .5px;
        color: #999;
        background-color: transparent;
        border: none;
        outline: none;
        transform: translateX(0);
        transition: all .3s ease-out;
    }

    .form-wrapper.is-active .switcher-login {
        color: #fff;
        transform: translateX(90px);
    }

    .form-wrapper.is-active .switcher-signup {
        color: #fff;
        transform: translateX(-90px);
    }

    .underline {
        position: absolute;
        bottom: -5px;
        left: 0;
        overflow: hidden;
        pointer-events: none;
        width: 100%;
        height: 2px;
    }

    .underline::before {
        content: '';
        position: absolute;
        top: 0;
        left: inherit;
        display: block;
        width: inherit;
        height: inherit;
        background-color: currentColor;
        transition: transform .2s ease-out;
    }

    .switcher-login .underline::before {
        transform: translateX(101%);
    }

    .switcher-signup .underline::before {
        transform: translateX(-101%);
    }

    .form-wrapper.is-active .underline::before {
        transform: translateX(0);
    }

    .form {
        overflow: hidden;
        min-width: 260px;
        margin-top: 50px;
        padding: 30px 25px;
        border-radius: 5px;
        transform-origin: top;
        width: fit-content;
        height: fit-content;
        padding: 50px 60px;
    }

    .form-login {
        animation: hideLogin .3s ease-out forwards;
    }

    .form-wrapper.is-active .form-login {
        animation: showLogin .3s ease-in forwards;
    }

    @keyframes showLogin {
        0% {
            background: #d7e7f1;
            transform: translate(40%, 10px);
        }

        50% {
            transform: translate(0, 0);
        }

        100% {
            background-color: #fff;
            transform: translate(35%, -20px);
        }
    }

    @keyframes hideLogin {
        0% {
            background-color: #fff;
            transform: translate(35%, -20px);
        }

        50% {
            transform: translate(0, 0);
        }

        100% {
            background: #d7e7f1;
            transform: translate(40%, 10px);
        }
    }

    .form-signup {
        animation: hideSignup .3s ease-out forwards;
    }

    .form-wrapper.is-active .form-signup {
        animation: showSignup .3s ease-in forwards;
    }

    @keyframes showSignup {
        0% {
            background: #d7e7f1;
            transform: translate(-40%, 10px) scaleY(.8);
        }

        50% {
            transform: translate(0, 0) scaleY(.8);
        }

        100% {
            background-color: #fff;
            transform: translate(-35%, -20px) scaleY(1);
        }
    }

    @keyframes hideSignup {
        0% {
            background-color: #fff;
            transform: translate(-35%, -20px) scaleY(1);
        }

        50% {
            transform: translate(0, 0) scaleY(.8);
        }

        100% {
            background: #d7e7f1;
            transform: translate(-40%, 10px) scaleY(.8);
        }
    }

    .form fieldset {
        position: relative;
        opacity: 0;
        margin: 0;
        padding: 0;
        border: 0;
        transition: all .3s ease-out;
    }

    .form-login fieldset {
        transform: translateX(-50%);
    }

    .form-signup fieldset {
        transform: translateX(50%);
    }

    .form-wrapper.is-active fieldset {
        opacity: 1;
        transform: translateX(0);
        transition: opacity .4s ease-in, transform .35s ease-in;
    }

    .form legend {
        position: absolute;
        overflow: hidden;
        width: 1px;
        height: 1px;
        clip: rect(0 0 0 0);
    }

    .input-block {
        margin-bottom: 20px;
    }

    .input-block label {
        font-size: 14px;
        color: #3b4465;
    }

    .input-block label i {
        margin-right: 5px;
    }

    .input-block input {
        display: block;
        width: 100%;
        margin-top: 8px;
        padding-right: 15px;
        padding-left: 15px;
        font-size: 16px;
        line-height: 40px;
        color: #3b4465;
        background: transparent;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        border-radius: 5px;
        border: none;
    }

    .form [type='submit'] {
        opacity: 0;
        display: block;
        min-width: 120px;
        margin: 30px auto 10px;
        font-size: 18px;
        line-height: 40px;
        border-radius: 25px;
        border: none;
        transition: all .3s ease-out;
        padding: 7px 40px;
    }

    .form-wrapper.is-active .form [type='submit'] {
        opacity: 1;
        transform: translateX(0);
        transition: all .4s ease-in;
    }

    .btn-login {
        color: #fbfdff;
        background: #a7e245;
        transform: translateX(-30%);
    }

    .btn-login i,
    .btn-signup i {
        margin-left: 5px;
    }

    .btn-signup {
        color: #a7e245;
        background: #fbfdff;
        box-shadow: inset 0 0 0 2px #a7e245;
        transform: translateX(30%);
    }

    a {
        position: relative !important;
        pointer-events: all !important;
        cursor: pointer !important;
        border: none !important;
        color: #999 !important;
    }

    a::before {
        display: none !important;
    }
</style>
<section class="forms-section">
    <div class="forms">
        <div class="form-wrapper is-active">
            <button type="button" class="switcher switcher-login">
                Entrar
                <span class="underline"></span>
            </button>

            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="form form-login">
                @csrf

                <fieldset>
                    <legend>Por favor, digite seu usuário para realizar o login.</legend>
                    <div class="input-block">
                        <label for="login-email"><i class="fa-solid fa-envelope"></i>E-mail</label>
                        <input name="email" id="login-email" type="email" :value="old('email')" required autofocus>
                    </div>
                    <div class="input-block">
                        <label for="login-password"><i class="fa-solid fa-key"></i>Senha</label>
                        <input name="password" id="login-password" type="password" required autocomplete="current-password">
                    </div>
                </fieldset>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif
                </div>

                <button type="submit" class="btn-login">Entrar<i class="fa-solid fa-arrow-right-to-bracket"></i></button>
            </form>

        </div>
        <div class="form-wrapper">
            <button type="button" class="switcher switcher-signup">
                Registrar
                <span class="underline"></span>
            </button>

            <form method="POST" action="{{ route('register') }}" class="form form-signup">
                @csrf

                <fieldset>
                    <legend>Por favor, digite seu usuário, senha e sena de confirmação para realizar o registro.</legend>
                    <div class="input-block">
                        <label for="signup-user"><i class="fa-regular fa-user"></i>Nome</label>
                        <input id="signup-user" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                    </div>
                    <div class="input-block">
                        <label for="signup-user"><i class="fa-regular fa-user"></i>E-mail</label>
                        <input id="signup-user" type="email" name="email" :value="old('email')" required>
                    </div>
                    <div class="input-block">
                        <label for="signup-password"><i class="fa-solid fa-key"></i>Senha</label>
                        <input id="signup-password" type="password" name="password" required autocomplete="new-password">
                    </div>
                    <div class="input-block">
                        <label for="signup-password-confirm"><i class="fa-solid fa-key"></i>Confirme a Senha</label>
                        <input id="signup-password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </fieldset>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>

                <button type="submit" class="btn-signup">Pronto<i class="fa-regular fa-address-card"></i></button>
            </form>

        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(window).bind('scroll', function () {       
        if ($(window).scrollTop() > 0) {
            $('.sub-menu').css({
                display: 'none'
            });
        } else {
            $('.sub-menu').css({
                display: 'flex'
            });
        }       
    });
</script>

@endsection()