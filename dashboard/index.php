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
            <div class="container">
                <h1>
                    node - <?php echo shell_exec('node -v 2>&1'); ?>
                </h1>

                <h1>
                    npm - <?php echo shell_exec('npm -v 2>&1'); ?>
                </h1>

                <h1>
                    yarn - <?php echo shell_exec('yarn -v 2>&1'); ?>
                </h1>

                <h1>
                    git - <?php echo shell_exec('git --version 2>&1'); ?>
                </h1>

                <h1>
                    gulp - <?php echo shell_exec('gulp --version 2>&1'); ?>
                </h1>

                <section class="section">
                    <div class="container">
                        <div class="columns">
                            <div class="column">
                                <h3 class="title is-3 has-text-centered">Environment</h3>
                                <hr>
                                <div class="content">
                                    <ul>
                                        <li><?= apache_get_version(); ?></li>
                                        <li>PHP <?= phpversion(); ?></li>
                                        <li>
                                            <?php
                                            $link = mysqli_connect("database", "root", $_ENV['MYSQL_ROOT_PASSWORD'], null);

                                            if (mysqli_connect_errno()) {
                                                printf("MySQL connecttion failed: %s", mysqli_connect_error());
                                            } else {
                                                printf("MySQL Server %s", mysqli_get_server_info($link));
                                            }
                                            
                                            mysqli_close($link);
                                            ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="column">
                                <h3 class="title is-3 has-text-centered">Quick Links</h3>
                                <hr>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="container">
                    <div class="content has-text-centered">
                        <p>
                            <strong><a href="" target="_blank">OctoLab</a></strong><br>
                            The source code is released under the <a href="https://github.com/rocco-giandomenico/dockbox/blob/main/LICENSE" target="_blank">MIT license</a>.
                        </p>
                    </div>
                </footer>
            </div>
        </main>
    </body>

</html>
