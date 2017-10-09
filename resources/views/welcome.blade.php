<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
            <div class="top-right links">
                @auth
                <a href="{{ url('/home') }}">Home</a>
                @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
            @endif
        </div>

        <div class="container">
            <!-- Content here -->

            <h3> Inicializacion de Variables {{ $fichas }}</h3>
            
            <form class="container" id="needs-validation" novalidate>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="validationCustom03"># Filas</label>
                        <input type="text" class="form-control" id="validationCustom03" placeholder="Numero de filas"  value="6"required>
                        <div class="invalid-feedback">
                            Por favor, ingrese el n&uacute;mero de filas
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationCustom04"># Columnas</label>
                        <input type="text" class="form-control" id="validationCustom04" placeholder="Numero de Columnas" value="6" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese el n&uacute;mero de columnas
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom05">Palabra a buscar</label>
                        <input type="text" class="form-control" id="validationCustom05" placeholder="Palabra a buscar" value="OIE" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese la palabra clave a Buscar.
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Generar Matriz</button>
            </form>

            <hr>

            <script>
                // Example starter JavaScript for disabling form submissions if there are invalid fields
                (function () {
                    "use strict";
                    window.addEventListener("load", function () {
                        var form = document.getElementById("needs-validation");
                        form.addEventListener("submit", function (event) {
                            if (form.checkValidity() == false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add("was-validated");
                        }, false);
                    }, false);
                }());
            </script>
        </div>


        <script>
        </script>

        <div class="container">
            <form class="container" id="needs-validation" novalidate>

                <table class="table">
                    <thead class="thead-default">
                        <tr>
                            <th>#</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td><input type="text" class="form-control" placeholder="" required></td>
                            <td><input type="text" class="form-control" placeholder="" required></td>
                            <td><input type="text" class="form-control" placeholder="" required></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </form>

        </div>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>


    </body>
</html>
