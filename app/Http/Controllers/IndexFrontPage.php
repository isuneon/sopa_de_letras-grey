<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class IndexFrontPage extends Controller {

    public function index() {
        return view('sopa');
    }

    public function calcular_sopa() {
        // Obtener datos de los formularios.
        $input = Input::all();
        $numero_filas = $input['filas'];
        $numero_columnas = $input['columnas'];
        $palabra_buscada = $input['palabra_buscada'];
        // Obtener matriz y colocarlo en un Array
        $matriz_string = explode('&', $input['form']);
        foreach ($matriz_string as $contenido) {
            $celda = explode("=", $contenido);
            $key = $celda[0];
            $value = $celda[1];
            $matrix[$key] = $value; // Contiene la matrix completa en un arreglo.
        }
        // Busqueda de Horizontales y sus reversos
        $cantidades_horizontales = $this->buscar_horizontales($numero_columnas, $palabra_buscada, $matrix);
        // Busqueda de Verticales y sus reversos
        $cantidades_verticales = $this->buscar_verticales($numero_columnas, $palabra_buscada, $matrix);
        // Busqueda de diagonales de pendiente positiva y sus reversos
        $cantidades_diagonales_pendiente_positiva = $this->buscar_diagonales_pendiente_positiva($numero_columnas, $numero_filas, $palabra_buscada, $matrix);
        // Busqueda de diagonales de pendiente negativa y sus reversos
        $cantidades_diagonales_pendiente_negativa = $this->buscar_diagonales_pendiente_negativa($numero_columnas, $numero_filas, $palabra_buscada, $matrix);
        return response()->json([
                    'totales_parcial' => array_merge($cantidades_horizontales, $cantidades_verticales, $cantidades_diagonales_pendiente_positiva, $cantidades_diagonales_pendiente_negativa)
        ]);// Enviando los resultados de la busqueda a la vista
    }

    function buscar_horizontales($numero_columnas, $palabra_buscar, $matrix) {
        //Inicializando contadores y acumuladores
        $variable = "";
        $i = 0;
        //agrupar horizontales por filas
        foreach ($matrix as $value) {
            $variable .= $value;
            if ($i >= $numero_columnas - 1) {
                $filas[] = $variable;
                $variable = "";
                $i = -1;
            }
            $i++;
        }//En este punto tengo un arreglo de filas de la matriz con todos sus elementos concatenados.
        // Buscar Cantidad Horizontales
        $cantidad_horizontales = $this->buscar_palabra_clave($filas, $palabra_buscar);

        // Invertir sentido
        foreach ($filas as $value) {// invirtiendo sentido 
            $filas_reversa[] = $this->InvertStr($value);
        }

        // Buscar Cantidades Horizontales previamente invertidas.
        $cantidad_horizontal_reverso = $this->buscar_palabra_clave($filas_reversa, $palabra_buscar);
        return array(
            'horizontales' => $cantidad_horizontales,
            'horizontales_reverso' => $cantidad_horizontal_reverso
        ); //Retornando las cantidades de coincidencias Horizontales con sus reversos.
    }

    function buscar_verticales($numero_columnas, $palabra_buscar, $matrix) {
        //Inicializando contadores y acumuladores
        $i = 0;
        $j = 0;
        $columnas = "";
        //agrupar horizontales por colunmas
        foreach ($matrix as $value) {
            if ($j <= 0) {
                $columnas[$i] = $value;
            } else {
                $columnas[$i] = $columnas[$i] . $value; // Concatenando valores
            }
            $i++;
            if ($i >= $numero_columnas) {
                $i = 0;
                $j++;
            }
        }//En este punto tengo un arreglo de filas de la matris con todos sus elementos concatenados.
        // Buscar Cantidad Verticales
        $cantidad_verticales = $this->buscar_palabra_clave($columnas, $palabra_buscar);

        // Invertir sentido
        foreach ($columnas as $value) {// invirtiendo sentido
            $columnas_reversa[] = $this->InvertStr($value);
        }

        // Buscar Cantidades Verticales previamente Invertidas.
        $cantidad_vertical_reverso = $this->buscar_palabra_clave($columnas_reversa, $palabra_buscar);
        return array(
            'verticales' => $cantidad_verticales,
            'verticales_reverso' => $cantidad_vertical_reverso
        ); //Retornando las cantidades de coincidencias encontradas
    }

    function buscar_diagonales_pendiente_positiva($numero_columnas, $numero_filas, $palabra_buscar, $matrix) {
        //Extrayendo diagonales en un array.
        $numero_diagonales = $numero_filas + $numero_columnas - 2;
        for ($n = 0; $n <= $numero_diagonales; $n++) {
            $j = $n;
            $diagonal = array();
            for ($i = 0; $i <= $n; $i++) {
                if (array_key_exists($i . $j, $matrix)) {
                    $diagonal[] = $matrix[$i . $j];
                } 
                $j--;
            }
            $diagonal_completa = "";
            foreach ($diagonal as $value) {
                $diagonal_completa .= $value;
            }
            $array_diagonales[] = $diagonal_completa;
        }// Imprimir el array_diagonales para entender lo realizado

        // Buscar Cantidad Diagonales pendiente positiva
        $cantidad_diagonales = $this->buscar_palabra_clave($array_diagonales, $palabra_buscar);

        // Invertir sentido
        foreach ($array_diagonales as $value) {// invirtiendo sentido
            $diagonales_reversa[] = $this->InvertStr($value);
        }

        // Buscar Cantidades Diagonales previamente Invertidas.
        $cantidad_diagonal_reverso = $this->buscar_palabra_clave($diagonales_reversa, $palabra_buscar);
        return array(
            'diagonales_positivas' => $cantidad_diagonales,
            'diagonales_positivas_reverso' => $cantidad_diagonal_reverso
        ); //Retornando las cantidades encontradas
    }

    function buscar_diagonales_pendiente_negativa($numero_columnas, $numero_filas, $palabra_buscar, $matrix) {
        //Extrayendo diagonales en un array.
        $numero_diagonales = $numero_filas + $numero_columnas - 2;
        for ($n = 0; $n <= $numero_diagonales; $n++) {
            $j = $numero_columnas;
            $i = $numero_filas;
            $diagonal = array();
            for ($i = $n + 1; $i >= 0 || $j >= 0; $i--) {
                if (array_key_exists($i . $j, $matrix)) {
                    $diagonal[] = $matrix[$i . $j];
                } 
                $j--;
            }
            $diagonal_completa = "";
            foreach ($diagonal as $value) {
                $diagonal_completa .= $value;
            }
            $array_diagonales[] = $diagonal_completa;
        }

        // Buscar Cantidad Verticales
        $cantidad_diagonales = $this->buscar_palabra_clave($array_diagonales, $palabra_buscar);

        // Invertir Sentido
        foreach ($array_diagonales as $value) {// invirtiendo sentido
            $diagonales_reversa[] = $this->InvertStr($value);
        }

        // Buscar Cantidades Diagonales Invertidas.
        $cantidad_diagonal_reverso = $this->buscar_palabra_clave($diagonales_reversa, $palabra_buscar);
        return array(
            'diagonales_negativas' => $cantidad_diagonales,
            'diagonales_negativas_reverso' => $cantidad_diagonal_reverso
        ); //Retornando las repeticiones Diagonales.
    }

    function InvertStr($String) { // Invertir String
        $NewString = "";
        for ($i = strlen($String); $i > 0; $i--)
            $NewString .= substr($String, $i - 1, 1);
        return $NewString;
    }

    function buscar_palabra_clave($filas, $palabra_buscar) {
        $suma_search_horizontales = "";
        foreach ($filas as $value) {
            $cantidad_encontrada = substr_count($value, $palabra_buscar);
            $suma_search_horizontales = $suma_search_horizontales + $cantidad_encontrada;
        }
        return $suma_search_horizontales;
    }

}
