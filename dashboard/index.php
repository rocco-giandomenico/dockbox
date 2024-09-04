<!DOCTYPE html>
<html lang="en" data-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="color-scheme" content="light dark">
        <link rel="shortcut icon" href="/assets/images/favicon.svg" type="image/svg+xml">
        <link rel="stylesheet" href="/assets/css/main.css">
        <title>dockBox</title>
    </head>

    <body>

        <header class="container">
            <img src="../assets/images/logo_dark.svg" alt="Esempio di Immagine" class="responsive">
        </header>

        <main class="container">


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

        </main>
    </body>

    <body>
        <section class="hero is-medium is-info is-bold">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">
                        dockBox
                    </h1>
                    <h2 class="subtitle">
                        Your local development environment
                    </h2>
                </div>
            </div>
        </section>
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
                        <div class="content">
                            <ul>
                                <li><a href="/phpinfo.php">phpinfo()</a></li>
                                <li><a href="/test_db.php">Test DB Connection with mysqli</a></li>
                                <li><a href="/test_db_pdo.php">Test DB Connection with PDO</a></li>
                            </ul>
                        </div>
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
    </body>

</html>
