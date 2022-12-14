<!DOCTYPE html>
{register_security}
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex,nofollow" />
        <title>Archiv für Filmfreunde</title>

        {block "javascripts"}
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="./fontawesome/js/all.min.js"></script>
        {/block}

        {block "stylesheets"}
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <link href="./fontawesome/css/all.min.css" rel="stylesheet">
        {/block}

    </head>
    <body>
        {block "navigation"}{include "_navigation.html.tpl"}{/block}
        {block "messages"}{include "_messages.html.tpl"}{/block}
        <div class="container-fluid">
            {block "body"}{/block}
        </div>
    </body>
</html>
