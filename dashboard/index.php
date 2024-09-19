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
                        echo getVirtualHosts();
                    ?>
                </div>
            </div>
        </main>

        <? echo getFooter(); ?>
    </body>
</html>
