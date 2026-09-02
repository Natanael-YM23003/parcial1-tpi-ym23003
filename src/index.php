session_start();

// Constante para un cargo administrativo fijo
define("CARGO_ADMINISTRATIVO", 2.50);

// Arreglo asociativo multidimensional de videojuegos disponibles
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

// 3. Procesamiento del Formulario vía POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recuperar y sanitizar/limpiar campos usando funciones de cadenas
    $nombre = trim($_POST["nombre"] ?? "");
    $edadInput = trim($_POST["edad"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $juegoKey = trim($_POST["videojuego"] ?? "");
    $modalidad = trim($_POST["modalidad"] ?? ""); // Estudiante / General
    $experiencia = trim($_POST["experiencia"] ?? ""); // Principiante / Intermedio / Avanzado
}
