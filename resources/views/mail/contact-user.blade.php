<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <section class="max-w-2xl px-6 py-8 mx-auto bg-white dark:bg-gray-900">
        <header>
            <a href="https://bonanzaonline.io">
                <img src="{{ asset('images/login.png') }}" alt="logo" width="200">
            </a>
        </header>
    
        <main class="mt-8">
            <h2 class="text-gray-700 dark:text-gray-200">Alguien quiere comunicarse por: {{$info['reason']}}</h2>
            <label>Nombre:</label>
            <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
                {{$info['name']}}
            </p>
            
            <label>Email:</label>
            <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
                {{$info['email']}}
            </p>

            @if ($info['subject'] == 2)
                <label>Problema con la orden: <span class="font-bold">{{$info['order']}}</span> </label>
                
            @endif

            <label>Mensaje:</label>
            <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
                {{$info['message']}}
            </p>

           
            
            
            <p class="mt-8 text-gray-600 dark:text-gray-300">
                Recuerda, <br>
                Responder tus correos
            </p>
        </main>
        
    
        <footer class="mt-8">
            <p class="text-gray-500 dark:text-gray-400">
                Este es un correo electrinico general <a href="#" class="text-blue-600 hover:underline dark:text-blue-400" target="_blank">contacto@bonanzaonline.com</a>. 
                Gracias por trabajar en bonanzaonline <a href="#" class="text-blue-600 hover:underline dark:text-blue-400">.
            </p>
    
            <p class="mt-3 text-gray-500 dark:text-gray-400">© {{ Date::now()->locale('es')->format('l j F') }} Desde palo negro con ♥ todo los derechos reservados.</p>
        </footer>
    </section>
</body>
</html>
