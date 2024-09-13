<?php

function getHeader() {

    $icon = !empty($_COOKIE['theme']) ? $_COOKIE['theme'] : 'toggle_dark';

    return <<<EOF
        <header>
            <div class="container">
                <nav>
                    <a href="#"><div class="logo"></div></a>
                    
                    <ul>
                        <li>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Info</a></li>
                                <li><a href="/php/phpinfo.php">PHP Info</a></li>
                                <li><a href="/php/test_db.php">msqli</a></li>
                                <li><a href="/php/test_db_pdo.php">PDO</a></li>
                            </ul>
                        </li>
                        <li><div class="separator"></div></li>
                        <li>
                            <ul class="compact">
                                <li><a href="https://github.com/rocco-giandomenico/dockbox" target="_blank"><div class="icon git"></div></a></li>
                                <li><a id="theme_toggle" href="#"><div class="icon $icon"></div></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
    EOF;
}