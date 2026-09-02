session_start();

// 1. Constante para un cargo administrativo fijo
define("CARGO_ADMINISTRATIVO", 2.50);

// 2. Arreglo asociativo multidimensional de videojuegos disponibles
$videojuegos = [
    "dbz" => [
        "nombre" => "Dragon Ball Sparking Zero",
        "categoria" => "Peleas",
        "costo" => 15.00,
        "max_participantes" => 16
    ],
    "fifa" => [
         "nombre" => "Torneo Futbol 11",
         "categoria" => "Deporte",
         "costo" => 20.00,
         "max_participantes" => 11
    ],
    "parcial" => [
        "nombre" => "Parcial TPI",
        "categoria" => "Examen",
        "costo" => "10.00",
        "max_participantes" => 30
    ]
];

if (!isset($_SESSION['inscripciones'])) {
    $_SESSION['inscripciones'] = [];
}

$errores = [];
$comprobanteActual = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recuperar y sanitizar/limpiar campos usando funciones de cadenas
    $nombre = trim($_POST["nombre"] ?? "");
    $edadInput = trim($_POST["edad"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $juegoKey = trim($_POST["videojuego"] ?? "");
    $modalidad = trim($_POST["modalidad"] ?? ""); // Estudiante / General
    $experiencia = trim($_POST["experiencia"] ?? ""); // Principiante / Intermedio / Avanzado
}

    // 3. Validaciones
    if (strlen($nombre) === 0) {
        $errores[] = "El nombre del participante es obligatorio.";
    }

    if (!is_numeric($edadInput) || intval($edadInput) <= 0) {
        $errores[] = "La edad debe ser un valor numérico válido mayor a 0.";
    } else {
        $edad = intval($edadInput);
    }

    if (strlen($correo) === 0 || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "Debe proporcionar un correo electrónico válido.";
    }

    if (!array_key_exists($juegoKey, $videojuegos)) {
        $errores[] = "El videojuego seleccionado no es válido.";
    }

    // 4. Procesar solo si no hay errores de validacion
    if (empty($errores)) {
        $juegoSeleccionado = $videojuegos[$juegoKey];

        // Determinar categoria del participante segun edad y experiencia usando match
        $categoriaParticipante = match (true) {
            $edad < 18 && $experiencia === "Principiante" => "Junior Novato",
            $edad < 18 => "Junior Promesa",
            $edad >= 18 && $experiencia === "Principiante" => "Amateur",
            $edad >= 18 && $experiencia === "Avanzado" => "Pro Player",
            default => "Clásico / Estándar"
        };
    }

        $costoBase = $juegoSeleccionado["costo"];
        $descuento = 0.0;

        // 5. Descuento del 10% para estudiantes principiantes
        if (strtolower($modalidad) === "estudiante" && strtolower($experiencia) === "principiante") {
            $descuento = $costoBase * 0.10;
        }

        $costoFinal = ($costoBase - $descuento) + CARGO_ADMINISTRATIVO;


