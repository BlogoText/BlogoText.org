<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title></title>
        <meta name="viewport" content="width=device-width, user-scalable=yes" />
        <meta name="keywords" content="{{keywords}}" />
        <meta name="description" content="{{description}}" />
        <!-- restrict robots, at least in this dev/test time -->
        <meta name="robots" content="none" />
        <link rel="stylesheet" href="/blog/themes/default/style.css" />
        <link rel="stylesheet" href="/site.css" />
        <link rel="alternate" type="application/rss+xml" title="BlogoText, l'actu en RSS" href="/blog/rss.php" />
        <link rel="alternate" type="application/atom+xml" title="BlogoText, l'actu en ATOM" href="/blog/atom.php" />
    </head>
    <body>
        <div id="top-bar">
            <button onclick="displayMenu(event);">Menu</button>
            <h1>
                <a href="/" title="{{name}}">{{name}}</a> <a href="/blog/" title="Le blog de BlogoText" style="box-shadow:none;">L'actualité</a>
            </h1>
            <form action="/blog/?" method="get" id="search">
                <input id="q" name="q" type="search" size="20" value="" placeholder="Rechercher" accesskey="f" />
                <button id="input-rechercher" type="submit">Rechercher</button>
            </form>
        </div>

        <div id="body-layout">
            <div id="content">
                <div id="show" class="parts">
                    <hgroup>
                        <h1>{{name}}</h1>
                        <h2>Un peu plus qu'un blog &hellip;</h2>
                        <p>Télécharger {{name}} <small>{{version}}</small> {{release-zip}} {{release-tar}}</p>
                    </hgroup>
                    <div>
                        <img src="https://raw.githubusercontent.com/BlogoText/blogotext/dev/preview.png" />
                    </div>
                </div>
                <div id="features" class="parts">
                    <h2>Fonctionnalités</h2>
                    <ul>
                        <li>Blog</li>
                        <li>Partage de liens</li>
                        <li>Agrégateur RSS</li>
                        <li>Espaces de commentaires</li>
                        <li>Extensible via des addons</li>
                        <li>Base de données SQLite ou MySQL</li>
                        <li>&hellip;</li>
                    </ul>
                </div>
                <div id="requirements" class="parts">
                    <h2>Le minimum requis</h2>
                    <ul>
                        <li>PHP 5.5</li>
                        <li>SQLite ou MySQL via PDO</li>
                        <li>2 Mo d'espace disque (minimum)</li>
                        <li>Un navigateur moderne supportant CSS3 &amp; HTML5</li>
                    </ul>
                </div>
                <div id="extension" class="parts">
                    <div id="addons">
                        <h2>Les addons</h2>
                        <p>Calendar, support du Latex, lazyload, suggestion de contenu relatif &hellip;</p>
                        <p>Les addons sont diponibles sur <a href="https://github.com/BlogoText/blogotext-addons">Github</a>.</p>
                    </div>
                    <div id="themes">
                        <h2>Les thèmes</h2>
                        <p>Actuellement, {{name}} permet de créer votre propre template, mais une version avancée est prévue, bientôt ;)</p>
                    </div>
                </div>
                <div id="link" class="parts">
                    <h2>Quelques liens utiles</h2>
                    <ul>
                        <li><a href="/blog/" title="">L'actualité du projet {{name}}</a></li>
                        <li><a href="https://github.com/BlogoText/blogotext" title="">{{name}} <small>Github</small></a></li>
                        <li><a href="https://github.com/BlogoText/blogotext-addons" title="">Les addons de {{name}} <small>Github</small></a></li>
                        <li><a href="https://github.com/BlogoText/blogotext/wiki" title="">La documentation <small>Github</small></a></li>
                        <li><a href="https://github.com/BlogoText/blogotext/issues" title="">Signaler un bug, demander une amélioration &hellip; <small>Github</small></a></li>
                    </ul>
                </div>
                <div id="status" class="parts">
                    <h2>Actuellement</h2>
                    <ul>
                        {{main-issues-ct}}
                        {{addon-issues-ct}}
                        {{addon-ct}}
                        {{theme-ct}}
                    </ul>
                </div>
                <div id="install" class="parts">
                    <h2>Comment installer BlogoText ?</h2>
                    <ol>
                        <li>Télécharger {{name}}</li>
                        <li>Transférez le contenu de l'archive sur votre hébergement, via ftp par exemple</li>
                        <li>Saisissez l'URL de votre blog dans votre navigateur favoris</li>
                        <li>Suivez les quelques étapes</li>
                        <li>Profitez de votre BlogoText ;)</li>
                    </ol>
                </div>
            </div>
            <div id="sidenav">
                <nav id="links">
                    <p class="nav-title">Liens</p>
                    <ul>
                        <li><a onclick="displayMenu(event);" href="#show">Présentation</a></li>
                        <li><a onclick="displayMenu(event);" href="#features">Fonctionnalités</a></li>
                        <li><a onclick="displayMenu(event);" href="#requirements">Le minimum requis</a></li>
                        <li><a onclick="displayMenu(event);" href="#extension">Addons et Thèmes</a></li>
                        <li><a onclick="displayMenu(event);" href="#link">Quelques liens utiles</a></li>
                        <li><a onclick="displayMenu(event);" href="#install">Comment installer BlogoText ?</a></li>
                        <li><a href="/blog/?liste">Le blog</a></li>
                        <li><a href="/blog/?liste">Blog / Tous les articles</a></li>
                        <li><a href="/blog/?random">Blog / Article au hasard</a></li>
                        <li><a href="/blog/?mode=links">Blog / Liens partagés</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <footer>
            <div>
                <a href="https://github.com/BlogoText/blogotext/">{{name}} on Github</a> - 
                <a href="https://github.com/BlogoText/blogotext-addons/">{{name}} addons on Github</a> - 
                <a href="/">{{name}}</a> - 
                <span lang="en">Theme inspired by <a href="http://lehollandaisvolant.net/">Timo van Neerden</a></span>
            </div>
        </footer>

        <div id="scroll-bar"><div id="scroll-bar-inner"></div></div>

        <script>
            function displayMenu(e) {
                var button = e.target;
                var menu = document.getElementById('sidenav');
                button.classList.toggle('active');
                menu.classList.toggle('shown');
            }
            /* from http://www.tiger-222.fr/?d=2016/10/18/14/00/25-scrollbar-horizontale */
            function scroll_bar() {
                'use strict';
                var t = document.querySelector('#scroll-bar'),
                    a = document.body.clientHeight,
                    n = window.innerHeight,
                    g = window.pageYOffset,
                    o = g / (a - n) * 100;

                t.style.width = o + '%';
            }
            window.addEventListener('load', scroll_bar);
            window.addEventListener('scroll', scroll_bar);
        </script>
    </body>
</html>