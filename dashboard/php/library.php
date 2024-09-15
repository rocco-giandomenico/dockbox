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
                                <li><a href="#">Virtual Hosts</a></li>
                                <li><a href="#">Emails</a></li>
                                <li class="dropdown">
                                    <a data-type="dropdown" href="#">Info</a>
                                    <div class="dropdown-content hidden">
                                        <a href="/php/phpinfo.php">PHP Info</a>
                                        <a href="/php/xdebug_info.php">Xdebug Info</a>
                                        <a href="/php/test_db.php">mysqli</a>
                                        <a href="/php/test_db_pdo.php">PDO</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li><div class="separator"></div></li>
                        <li>
                            <ul class="compact">
                                <li><a href="https://github.com/rocco-giandomenico/dockbox" target="_blank"><div class="icon git"></div></a></li>
                                <li><a href="#"><div data-type="theme_toggle" class="icon $icon"></div></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
    EOF;
}