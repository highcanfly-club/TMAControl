<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{config('app.name')}}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            @font-face {
                font-family: 'Rhetoric-BoldItalic';
                src: url('/fonts/Rhetoric-BoldItalic.ttf') format('truetype');
                }
            @font-face {
                font-family: 'Rhetoric-Bold';
                src: url('/fonts/Rhetoric-Bold.ttf') format('truetype');
                }
            @font-face {
            font-family: 'Rhetoric-Light';
            src: url('/fonts/Rhetoric-Light.ttf') format('truetype');
            }
            @font-face {
            font-family: 'Rhetoric-LightItalic';
            src: url('/fonts/Rhetoric-LightItalic.ttf') format('truetype');
            }
            @font-face {
            font-family: 'Rhetoric-Italic';
            src: url('/fonts/Rhetoric-Italic.ttf') format('truetype');
            }
            @font-face {
            font-family: 'Rhetoric-Book';
            src: url('/fonts/Rhetoric-Book.ttf') format('truetype');
            }
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0 ">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">{{__('Dashboard')}}</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">{{__('Login')}}</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">{{__('Register')}}</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 text-6xl text-gray-600 dark:text-white relative">
                        <div><a href={{route('welcome')}}><img width="96px" height="96px" src="/logo_high_can_fly.svg"/></a></div>
                        <div class="col-span-2"><div class="md:absolute mt-2 md:top-1/2 md:-mt-4  dark:text-white" style="color:#721737; font-family: Rhetoric-Bold;">High Can Fly</div></div>
                </div>
                

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href={{route('welcome')}} class="underline text-gray-900 dark:text-white">Déclaration de confidentialité</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm h-96">
                                    <ul class="list-disc">
                                    <li>En préambule : jamais nous ne divulguerons vos données à qui que ce soit.</li>
                                    <br>
                                    <li>Ce que nous stockons
                                        <ul> 
                                            <li>votre nom</li>
                                            <li>l'email que vous avez fourni</li>
                                            <li> changement d'état que vous opérez sur la plateforme</li>
                                        </ul>
                                    </li><br>
                                    <li>Nous stockons aussi dans nos fichiers d'historique tous les accès à la plateforme. C'est à dire :
                                        <ul>
                                            <li>votre adresse IP</li>
                                            <li>l'heure</li>
                                            <li>l'URL interrogée</li>
                                        </ul>
                                    </li><br>
                                    <li>Ce que vous stockez
                                        <ul>
                                            <li>2 cookies de session chiffrés (durée de vie quelques heures) permettant au site de fonctionner</li>
                                            <li>1 cookie de session non chiffré (durée de vie 30 jours) enregistrant votre consentement <a href="https://eur-lex.europa.eu/legal-content/FR/TXT/?uri=CELEX:32016R0679" class="ml-1 underline">conforme au R.G.P.D.</a>.</li>
                                        </ul>
                                    </li>
                                    Sans ces éléments ce site ne peut pas fonctionner.
                                    </ul>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>

                            <a href="https://intranet.ffvl.fr/structure/14172" class="ml-1 underline">
                                Prenez votre licence chez High Can Fly
                            </a>

                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>

                            <a href="mailto:adhesion@highcanfly.club" class="ml-1 underline">
                                Sponsor
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-xs text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} / PHP v{{ PHP_VERSION }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
