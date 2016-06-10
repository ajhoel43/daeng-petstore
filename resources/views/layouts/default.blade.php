<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        {{ Html::style('assets/css/bootstrap.min.css') }}
        {{ Html::style('assets/jquery-ui/jquery-ui.css') }}
        {{ Html::style('assets/font-awesome/css/font-awesome.css') }}
        {{ Html::script('assets/js/jquery.js') }}
        {{ Html::script('assets/js/bootstrap.min.js') }}
        {{ Html::script('assets/jquery-ui/jquery-ui.js') }}
        <style>
            table form { margin-bottom: 0; }
            form ul { margin-left: 0; list-style: none; }
            .error { color: red; font-style: italic; }
            body { padding-top: 20px; }
            .content { padding-top: 3em; }
            #navbar-1 { padding-right: 1em; }
        </style>
        <title>Daeng PetStore&#0153;</title>
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('layouts.navbar')

                    <div class="col-lg-12 content">
                        @yield('main')
                    </div>
                </div>
            </div>
        </div>

    </body>

</html>