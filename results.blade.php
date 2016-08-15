<!DOCTYPE html>
<html>
    <head>
        <title>Тестовое задание</title>
        <meta charset="utf-8" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,400,700&subset=cyrillic" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Roboto', serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
            .menu {
                font-size: 36px;
                margin-bottom: 30px;
                padding: 20px;
                border:2px solid #000;
            }
            .menu a {
                font-size: 36px;
            }
            .text, .form {
                font-size: 26px;
                font-weight: normal;
            }
            
        </style>
        <script type='text/javascript' src='https://code.jquery.com/jquery-2.2.2.min.js'></script>
        <script>
            $(function() {
                /* Отлавливаем сабмит формы*/
                $('form').submit(function() {
                    /* Обращаемся к серверу с доменом "localhost:8000" для вычисления операции */
                    $.getJSON( "http://localhost:8000/count/"+$('[name=operation]').val())
                        //В случае успеха:
                        .done(function( data ) {
                            if(data['success']=='ok')
                            {
                                $('#results').text(data['value']);
                            }else $('#results').text('Error input data');                        
                        })
                        //В случае ошибки:
                        .fail(function( jqxhr, textStatus, error ) {
                            var err = textStatus + ", " + error;
                            console.log( "Request Failed: " + err );
                    })
                    return false;
                });
            });
        </script>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Результаты по тестовому заданию</div>
                <h2>Задача №1</h2>
                <div class="form">
                    <form action="" method="get">
                        <input type="text" name="operation" value="4+3" /> <input type="submit" value="Расчет" />
                    </form>
                    <div id="results"></div>
                </div>
                <div class="text"><?=$content ?></div>
            </div>
        </div>
    </body>
</html>
