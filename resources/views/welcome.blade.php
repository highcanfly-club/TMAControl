<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>TMA Lille 3.1</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            @font-face {
                font-family: 'Rhetoric-BoldItalic';
                src: url('https://www.highcanfly.club/fonts/Rhetoric-BoldItalic.ttf') format('truetype');
                }
            @font-face {
                font-family: 'Rhetoric-Bold';
                src: url('https://www.highcanfly.club/fonts/Rhetoric-Bold.ttf') format('truetype');
                }
            @font-face {
            font-family: 'Rhetoric-Light';
            src: url('https://www.highcanfly.club/fonts/Rhetoric-Light.ttf') format('truetype');
            }
            @font-face {
            font-family: 'Rhetoric-LightItalic';
            src: url('https://www.highcanfly.club/fonts/Rhetoric-LightItalic.ttf') format('truetype');
            }
            @font-face {
            font-family: 'Rhetoric-Italic';
            src: url('https://www.highcanfly.club/fonts/Rhetoric-Italic.ttf') format('truetype');
            }
            @font-face {
            font-family: 'Rhetoric-Book';
            src: url('https://www.highcanfly.club/fonts/Rhetoric-Book.ttf') format('truetype');
            }
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
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
                        <div><img width="96px" height="96px" src="https://www.highcanfly.club/logo_high_can_fly.svg"/></div>
                        <div class="col-span-2"><div class="md:absolute mt-2 md:top-1/2 md:-mt-4  dark:text-white" style="color:#721737; font-family: Rhetoric-Bold;">High Can Fly</div></div>
                </div>
                

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href={{route('tmastatepublic')}} class="underline text-gray-900 dark:text-white">Projet TMA Lille 3.1</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    En liaison avec la subdivision de Lille de la DGAC, nous construisons et exploitons une balise reportant l'état en temps réél de la TMA Lille 3.1.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://github.com/eltorio/TMAControl" class="underline text-gray-900 dark:text-white">Installation</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">

                                    Si vous voulez créer votre balise, nous mettons à disposition notre <a href="https://github.com/eltorio/TMAControl" class="underline text-gray-900 dark:text-white">code source sous licence MIT</a>. Côté serveur vous aurez besoin d'un hébergeur un peu flexible pouvant héberger du PHP7, mais rien de bien exceptionnel. Côté <a href="https://github.com/eltorio/TMAControl" class="underline text-gray-900 dark:text-white">client</a> une VHF professionnelle programée, un Raspberry Pi et une connexion Internet suffiront… 
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://www.highcanfly.club/" class="underline text-gray-900 dark:text-white">Le club</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Marcher et Voler, voilà ce qui nous ressemble. Gravir les montagnes pour redescendre par les airs c'est un rêve que nous réalisons. Le matériel d'aujourd'hui rend ce rêve plus accessible. Venez voler avec nous. En solo, en tandem… Pour un petit plouf ou pour un long vol il y aura toujours un de nos membres pour partager un moment.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">Aidez-nous</div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Nous sommes un jeune club, rejoignez-nous et <a href="https://intranet.ffvl.fr/ffvl_licenceonline/pre_rempli/NEW/14172" class="underline text-gray-900 dark:text-white">prenez votre licence avec nous<a>. Vous pouvez aussi nous aider financièrement pour que nous puissions développeer de nouveaux projets et faire avancer la pratique du marche et vol en parapente. 
                                </div>
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
                            
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-3 text-gray-400"><path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                            <a class="ml-1 underline text-xs" href={{route('gdpr')}}>    
                                {{__("Privacy statement")}}
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
