<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body >
        <div class="scrollable-tabs-container">
            <div class="left-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                  </svg>  
            </div>
        
            <ul>
                <li>
                    <a href="#" class="active" >All</a>
                </li>
                <li>
                    <a href="#" >111111111</a>
                </li>
                <li>    
                    <a href="#" >111111111</a>
                </li>
                <li>
                    <a href="#" >111111111</a>
                </li>
                <li>
                    <a href="#" >111111111</a>
                </li>
                <li>
                    <a href="#" >111111111</a>
                </li>
                <li>
                    <a href="#" >111111111111111111111111111111</a>
                </li>
            </ul>
            <div class="right-arrow active">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
              </svg>
            </div>
              
        </div>
    </body>
</html>