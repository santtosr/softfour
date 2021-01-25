<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

</head>
<body class="bg" background="{{asset('storage/imagens/background.jpeg')}}">   
    <center>
        <div class="card">
            <slot name="logo">
                <a href="{{route('inicial')}}">
                   <img class="fill-current text-gray-500" src="http://localhost/softfour/laravel/storage/app/public/imagens/logo.png"/>
                </a>
            </slot>
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="ml-4 mr-4 mt-4">
                    <x-input id="email" class="block mt-1 w-full" placeholder="Email" type="email" name="email" required autofocus />
                </div>

                <!-- Password -->
                <div class="mt-4 ml-4 mr-4">
                    <x-input id="password" class="block mt-1 w-full" placeholder="Semha"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                </div>

                <table>
                    <tr>
                        <td>
                            <!-- Remember Me -->
                            <div class="block mt-4 ml-4 mr-4">
                                <label for="remember_me" class="flex items-center">
                                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                                    <span class="ml-2 text-sm text-gray-600 text-login">{{ __('Lebrar-se de mim') }}</span>
                                </label>
                            </div>
                        </td>
                        
                        <td>
                            <div class="block mt-3 ml-4 mr-4">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 text-login" href="{{ route('password.request') }}">
                                        {{ __('Esqueceu sua senha?') }}
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                </table>
                
                <div class="flex items-center justify-center mt-8 mr-4">
                    <button class="ml-3 button button1"> 
                        {{ __('Entrar') }}
                    <button>                
                </div>
                
                 <a class="link-15" href="{{route('register')}}">Cadastre-se</a> 
                
            </form>
        </div>
    </center>
    <div class="card-rp">
        <div class="tx">
            © 2020 MiCs Minha Criticas. Todos os direitos reservados.
        </div>
    </div>
</body>
</html>


