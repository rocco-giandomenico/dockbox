<?php

// Get Header
function getHeader() {

    $icon = !empty($_COOKIE['theme']) ? $_COOKIE['theme'] : 'toggle_dark';

    return <<<EOF
        <header>
            <div class="container">
                <nav>
                    <a href=""><div class="logo"></div></a>
                    
                    <ul class="mobile">
                        <li>
                            <ul>
                                <li><a href="">Home</a></li>
                                <li><a href="">Emails</a></li>
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
                                <li><a href=""><div data-type="theme_toggle" class="icon $icon"></div></a></li>
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
            <h2><div class="icon server normal"></div>Envitoment</h2>
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
    preg_match_all('/(\w+)\s+version:\s+(\d+\.\d+\.\d+)/', shell_exec('gulp --version 2>&1'), $gulp, PREG_SET_ORDER);

    return <<<EOF
        <div class="card">
            <h2><div class="icon tool normal"></div>Tools</h2>
            <table>
                <tr>
                    <td>GIT</td>
                    <td>{$git[0]}</td>
                </tr>
                <tr class="even">
                    <td>Composer</td>
                    <td>{$composer[1]}</td>
                </tr>
                <tr>
                    <td>Node</td>
                    <td>{$node[0]}</td>
                </tr>
                <tr class="even">
                    <td>NPM</td>
                    <td>{$npm[0]}</td>
                </tr>
                <tr>
                    <td>Yarn</td>
                    <td>{$yarn[0]}</td>
                </tr>
                <tr class="even">
                    <td>Gulp</td>
                    <td>{$gulp[0][2]}</td>
                </tr>
            </table>
        </div>
    EOF;
}

// Get Config Mounts
function getConfigMounts() {

    return <<<EOF
        <div class="card">
            <h2><div class="icon settings normal"></div>Config Mounts</h2>
            <table>
                <tr>
                    <td>PHP (ini)</td>
                    <td>config/php/php.ini</td>
                </tr>
                <tr class="even">
                    <td>Virtual Host</td>
                    <td>config/vhosts/</td>
                </tr>
                <tr>
                    <td>SSL</td>
                    <td>config/ssl/</td>
                </tr>
                <tr class="even">
                    <td>APACHE_LOG_DIR</td>
                    <td>/var/log/apache2</td>
                </tr>
                <tr>
                    <td>XDEBUG_LOG_DIR</td>
                    <td>/var/log/xdebug</td>
                </tr>
            </table>
        </div>
    EOF;
}

// Get Virtual Hosts
function getVirtualHosts() {

    $output = "<div class=\"card\"><h2>Virtual Hosts</h2><table>";

    // Get Folders
    $folders = array_filter(glob('/shared/www/*'), 'is_dir');
    foreach($folders as $k => $f) {
        $dir = basename($f);
        $back = $k%2 == 0 ? '' : 'even';

        $res = shell_exec("curl -I $dir." . $_ENV['DOMAIN']);

        if($res) {
            $output .= "
                <tr class=\"$back\">
                    <td class=\"vhost\"><div class=\"icon check normal green\"></div><a href=\"http://{$dir}.{$_ENV['DOMAIN']}\" target=\"_blank\">{$dir}.{$_ENV['DOMAIN']}</a></td>
                </tr>
            ";
        } else {
            $output .= "
                <tr class=\"$back\">
                    <td class=\"vhost\"><div class=\"icon alert normal error\"></div><span class=\"error\">Add to host file - 127.0.0.1 {$dir}.{$_ENV['DOMAIN']}</span></td>
                </tr>
            ";
        }
    }   

    return $output . '</table></div>';
}

// Get Footer
function getFooter() {

    $version = 'v0.4.1';

    return <<<EOF
        <footer>
            <div class="container justify_between">
                <div class="flex_column">
                    <a href="#" class="developer">Octolabs</a>
                    <span class="small">The source code is released under the <a href="https://github.com/rocco-giandomenico/dockbox/blob/main/LICENSE" target="_blank">MIT license</a></span>
                </div>
                <span class="small">{$version}</span>
            </div>
        </footer>
    EOF;

}