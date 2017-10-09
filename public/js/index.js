$(document).ready(function () {
    $("div#resultados").hide();
    $("div#matrix_resultado.row").hide();
});


// Funcion para crear el formulario con la matriz.
function create_matriz() {
    $("div#matrix_resultado.row").show();
    $("div#resultados").hide();

    var filas = $("select#filas").val();
    var columnas = $("select#columnas").val();
    var grilla = "<form class='sopa' id='sopa' name='sopa'>";
    var i = 0;
    var j = 0;
    var salto_linea = "<br>";
    var grilla_fin = "<br><button class='btn btn-primary' type='button' onclick='buscar_palabra_sopa();' >Calcular Coincidencias</button></form>";
    j = 0;
    while (j < filas) {
        i = 0;
        while (i < columnas) {
            grilla += "<input type='text' class='form-control col-md-1' name='" + j + i + "' placeholder=" + j + i + " required onkeyup='javascript:this.value=this.value.toUpperCase();' maxlength='1' style='display: INLINE; text-transform:uppercase;'>";
            i++;
        }
        grilla += salto_linea;
        j++;
    }
    grilla += grilla_fin;
    $("div#matrix").html(grilla);
}

/* Funcion que se comunica con el servidor para realizar las busquedas en la 
sopa de letras. La misma se realizó con Ajax para optimizar el uso de los recursos. */
function buscar_palabra_sopa() {
    $.ajax({
        type: "POST",
        url: "/calcular_sopa",
        // Parámetros del formulario Enviado.
        data: {
            form: $("form#sopa.sopa").serialize(),
            filas: $("select#filas").val(),
            columnas: $("select#columnas").val(),
            palabra_buscada: $("input#palabra_clave").val()
        },
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
            // Sumatoria de los totales.
            var total = data.totales_parcial.diagonales_positivas +
                    data.totales_parcial.diagonales_positivas_reverso +
                    data.totales_parcial.diagonales_negativas +
                    data.totales_parcial.diagonales_negativas_reverso +
                    data.totales_parcial.horizontales +
                    data.totales_parcial.horizontales_reverso +
                    data.totales_parcial.verticales +
                    data.totales_parcial.verticales_reverso;
            $("div#total").html("Coincidencias encontradas: " + total);
            $("div#resultados").show();
        },
        error: function () {
            alert("Disculpe, lamentamos los inconvenientes, intente de nuevo mas tarde (cod 10001)");
        }
    });
}