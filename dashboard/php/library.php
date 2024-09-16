<?php

// Get Header
function getHeader() {

    $icon = !empty($_COOKIE['theme']) ? $_COOKIE['theme'] : 'toggle_dark';

    return <<<EOF
        <header>
            <div class="container">
                <nav>
                    <a href="#"><div class="logo"></div></a>
                    
                    <ul class="mobile">
                        <li>
                            <ul>
                                <li><a href="#">Home</a></li>
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
                        <li class="no_mobile"><div class="separator"></div></li>
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

// Get Enviroment
function getEnviroment() {

    $web_server = apache_get_version();
    $php = phpversion();

    $link = mysqli_connect("database", "root", $_ENV['MYSQL_ROOT_PASSWORD'], null);
    $database = mysqli_get_server_info($link);
    mysqli_close($link);

    return <<<EOF
        <div class="card">
            <h2>Envitoment</h2>
            <table>
                <tr>
                    <td>Web Server</td>
                    <td>$web_server</td>
                </tr>
                <tr class="even">
                    <td>PHP</td>
                    <td>$php</td>
                </tr>
                <tr>
                    <td>Database</td>
                    <td>$database</td>
                </tr>
            </table>
        </div>
    EOF;
}

// Get Tools
function getTools() {

    preg_match('/\d+\.\d+\.\d+/', shell_exec('git --version 2>&1'), $git);
    preg_match('/Composer version (\d+\.\d+\.\d+)/', shell_exec('composer --version 2>&1'), $composer);
    preg_match('/\d+\.\d+\.\d+/', shell_exec('node -v 2>&1'), $node);
    preg_match('/\d+\.\d+\.\d+/', shell_exec('npm -v 2>&1'), $npm);
    preg_match('/\d+\.\d+\.\d+/', shell_exec('yarn -v 2>&1'), $yarn);

    $gulp = '';
    preg_match_all('/(\w+)\s+version:\s+(\d+\.\d+\.\d+)/', shell_exec('gulp --version 2>&1'), $matches, PREG_SET_ORDER);
    foreach ($matches as $m) {
        $gulp .= $m[1] . ': ' . $m[2] . '<br>';
    }

    return <<<EOF
        <div class="card">
            <h2>Tools</h2>
            <table>
                <tr>
                    <td>GIT</td>
                    <td>$git[0]</td>
                </tr>
                <tr class="even">
                    <td>Composer</td>
                    <td>$composer[1]</td>
                </tr>
                <tr>
                    <td>Node</td>
                    <td>$node[0]</td>
                </tr>
                <tr class="even">
                    <td>NPM</td>
                    <td>$npm[0]</td>
                </tr>
                <tr>
                    <td>Yarn</td>
                    <td>$yarn[0]</td>
                </tr>
                <tr class="even">
                    <td>Gulp</td>
                    <td>$gulp</td>
                </tr>
            </table>
        </div>
    EOF;
}