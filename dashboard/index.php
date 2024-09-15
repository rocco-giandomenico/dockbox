<? require_once 'php/library.php'; ?>

<!DOCTYPE html>
<html lang="en" data-theme="<?php echo !empty($_COOKIE['theme']) ? $_COOKIE['theme'] : 'dark' ; ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="color-scheme" content="light dark">
        <link rel="shortcut icon" href="/public/img/favicon_azure.svg" type="image/svg+xml">
        <link rel="stylesheet" href="/public/css/main.css">
        <script src="/public/js/main.js"></script>
        <title>dockBox</title>
    </head>

    <body>

        <? echo getHeader(); ?>

        <main>
            <div class="container grid">
                <div class="column">
                    <div class="card">
                        <h2>Envitoment</h2>
                        <table>
                            <tr>
                                <td>Web Server</td>
                                <td><?= apache_get_version(); ?></td>
                            </tr>
                            <tr class="even">
                                <td>PHP</td>
                                <td><?= phpversion(); ?></td>
                            </tr>
                            <tr>
                                <td>Database</td>
                                <td>
                                    <?php
                                        $link = mysqli_connect("database", "root", $_ENV['MYSQL_ROOT_PASSWORD'], null);

                                        if (mysqli_connect_errno()) {
                                            printf("MySQL connecttion failed: %s", mysqli_connect_error());
                                        } else {
                                            printf("MySQL Server %s", mysqli_get_server_info($link));
                                        }
                                        
                                        mysqli_close($link);
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <h2>Tools</h2>
                        <table>
                            <tr>
                                <td>GIT</td>
                                <td>
                                    <?php
                                        preg_match('/\d+\.\d+\.\d+/', shell_exec('git --version 2>&1'), $matches);
                                        echo $matches[0] ?? '<span class="error">Error</span>';
                                    ?>
                                </td>
                            </tr>
                            <tr class="even">
                                <td>Node</td>
                                <td>
                                    <?php
                                        preg_match('/\d+\.\d+\.\d+/', shell_exec('node -v 2>&1'), $matches);
                                        echo $matches[0] ?? '<span class="error">Error</span>';
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>NPM</td>
                                <td>
                                    <?php
                                        preg_match('/\d+\.\d+\.\d+/', shell_exec('npm -v 2>&1'), $matches);
                                        echo $matches[0] ?? '<span class="error">Error</span>';
                                    ?>
                                </td>
                            </tr>
                            <tr class="even">
                                <td>Yarn</td>
                                <td>
                                    <?php
                                        preg_match('/\d+\.\d+\.\d+/', shell_exec('yarn -v 2>&1'), $matches);
                                        echo $matches[0] ?? '<span class="error">Error</span>';
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Gulp</td>
                                <td>
                                    <?php
                                        preg_match_all('/(\w+)\s+version:\s+(\d+\.\d+\.\d+)/', shell_exec('gulp --version 2>&1'), $matches, PREG_SET_ORDER);
                                        foreach ($matches as $m) {
                                            echo $m[1] . ': ' . ($m[2] ?? '<span class="error">Error</span>') . '<br>';
                                        }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <footer>
            <div class="container justify_between">
                <div class="flex_column">
                    <a href="#" target="_blank">Octolabs</a>
                    <span class="small">The source code is released under the <a href="https://github.com/rocco-giandomenico/dockbox/blob/main/LICENSE" target="_blank">MIT license</a></span>
                </div>
                
                <span class="small">v0.1.0</span>
            </div>
        </footer>
    </body>

</html>
