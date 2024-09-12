<!DOCTYPE html>
<html lang="en" data-theme="<?php echo !empty($_COOKIE['theme']) ? $_COOKIE['theme'] : 'dark' ; ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="color-scheme" content="light dark">
        <link rel="shortcut icon" href="/assets/images/favicon_azure.svg" type="image/svg+xml">
        <link rel="stylesheet" href="/assets/css/main.css">
        <script src="/assets/js/dashboard.js"></script>
        <title>dockBox</title>
    </head>

    <body>

        <header>
            <div class="container">
                <img src="../assets/images/favicon_azure.svg" alt="Esempio di Immagine" class="responsive">
                <nav>
                    <ul>
                        <li><a href="/phpinfo.php" class="contrast">PhpInfo</a></li>
                        <li><a href="/test_db.php" class="contrast">mysqli</a></li>
                        <li><a href="/test_db_pdo.php" class="contrast">PDO</a></li>
                    </ul>
                    <ul class="icons">
                        <li><a href="https://github.com/rocco-giandomenico/dockbox" target="_blank" class="contrast"><div class="icon git"></div></a></li>
                        <li><a id="theme_toggle" href="#" class="contrast"><div class="icon <?php echo !empty($_COOKIE['theme']) ? 'toggle_' . $_COOKIE['theme'] : 'toggle_dark'; ?>"></div></a></li>
                    </ul>
                </nav>
            </div>
        </header>

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
