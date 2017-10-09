<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Sopa de Letras</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}" >
    </head>
    <body style="margin-top: 50px;">
        <div class="container">
            <!-- Formulario Inicializacion Juego -->
            <div class="row">
                <center><h3> Inicia el juego!</h3></center>
                <!--<form class="container" id="needs-validation" novalidate>-->
                <div class="row col-md-12 mb-12">
                    <div class="col-md-3 mb-3">
                        <label># Filas</label>
                        <select class="form-control" id="filas">
                            <option value="3" >3</option>
                            <option value="4" >4</option>
                            <option value="5" >5</option>
                            <option value="6" >6</option>
                            <option value="7" >7</option>
                            <option value="8" >8</option>
                            <option value="9" >9</option>

                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label># Columnas</label>
                        <select class="form-control" id="columnas">
                            <option value="3" >3</option>
                            <option value="4" >4</option>
                            <option value="5" >5</option>
                            <option value="6" >6</option>
                            <option value="7" >7</option>
                            <option value="8" >8</option>
                            <option value="9" >9</option>

                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Palabra a buscar</label>
                        <input type="text" class="form-control" id="palabra_clave" placeholder="Palabra a buscar" value="OIE" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label><h8 style="color: graytext;">Mostrar Sopa</h8></label>
                        <button class="btn btn-primary form-control" type="button" onclick="create_matriz();">Generar Matriz</button>
                    </div>
                </div>
                <div class="row col-md-12 mb-12">
                    <div class="alert alert-secondary" role="alert" style='width: 100%;'>
                        Seleccione la cantidad de columnas y filas de la Matriz
                    </div>
                </div>
            </div>
            <!-- FIN Formulario Inicializacion Juego -->

            <hr>
            <!-- Matriz y Resultados -->
            <div class="row" id='matrix_resultado'>
                <!-- Matriz -->
                <div class="col-md-8 mb-3">
                    <div class="row">
                        <h3> Sopa de letras</h3>
                    </div>
                    <div class="row">
                        <center>
                            <div id="matrix" >
                            </div>
                        </center>
                    </div>
                </div>
                <!-- FIN Matriz -->

                <!-- Resultados -->
                <div class="col-md-4 mb-3" id="resultados">
                    <div class="row">
                        <h3> Resultados</h3>
                    </div>
                    <div class="row">
                        <div class="alert alert-success" id="total" role="alert">
                        </div>
                    </div>
                </div>
                <!-- FIN Resultados -->
            </div>
            <!-- FIN Matriz y Resultados -->
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!--<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="  crossorigin="anonymous"></script>-->
        <script src="{{ asset('js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{ asset('js/popper.min.js')}}"></script>
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('js/index.js')}}"></script>

    </body>
</html>
