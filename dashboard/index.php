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
                    <? 
                        echo getTools();
                        echo getConfigMounts();
                    ?>
                </div>

                <div class="column">
                    <? 
                        echo getEnviroment(); 
                    ?>

                    <div class="card">
                        <h2>Virtual Hosts</h2>
                        <table>
                            <?
                                // Get Folders
                                $folders = array_filter(glob('/shared/www/*'), 'is_dir');

                                $folders = array_map(function($f) {
                                    return basename($f);
                                }, $folders);
                                
                                // Get Files
                                $files = array_filter(scandir('/etc/apache2/sites-enabled'), function($f) {
                                    return pathinfo($f, PATHINFO_EXTENSION) === 'conf';
                                });

                                $files = array_map(function($f) {
                                    return pathinfo($f, PATHINFO_FILENAME);
                                }, $files);
                

                                $addFiles = (array_diff($folders, $files));
                                $removefiles = (array_diff($files, $folders));

                                // Create Configuration files
                                foreach($addFiles as $f) {
                                    touch('/etc/apache2/sites-enabled/'. $f . '.conf');
                                }

                                // Remove Configuration files
                                foreach($removefiles as $f) {
                                    unlink('/etc/apache2/sites-enabled/'. $f . '.conf');
                                }

                                
                                // foreach($folders as $k => $f) {
                                //     $dir = basename($f);
                                //     $back = $k%2 == 0 ? '' : 'even';
                                //     $domain = shell_exec('echo "$DOMAIN"');

                                //     echo <<<EOF
                                //         <tr class="$back">
                                //             <td><a href="$dir.$domain" target="_blank">$dir.$domain</a></td>
                                //         </tr>
                                //     EOF;

                                //     // echo "$dir.$domain" . '<br>';
                                //     // echo shell_exec("curl -I $dir.$domain");
                                //     // echo '<br>';
                                // }
                                    
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <footer>
            <div class="container justify_between">
                <div class="flex_column">
                    <a href="#" class="developer">Octolabs</a>
                    <span class="small">The source code is released under the <a href="https://github.com/rocco-giandomenico/dockbox/blob/main/LICENSE" target="_blank">MIT license</a></span>
                </div>
                <span class="small">v0.2.0</span>
            </div>
        </footer>
    </body>
</html>
