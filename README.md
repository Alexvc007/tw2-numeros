Generador de Números Aleatorios

Aplicación PHP orientada a objetos que genera N números aleatorios dentro de un rango configurable y muestra estadísticas (suma, promedio, mínimo, máximo).
Requisitos

    Docker + docker-compose
    Puerto 8082 mapeado en docker-compose.yml
    PHP 7.4+

Estructura

/noo
├── index.php              # Punto de entrada
├── controllers/
│   ├── Request.php        # Validación de entrada
│   └── App.php            # Orquestación PRG
├── services/
│   ├── RandomGenerator.php # Generación de números
│   └── Renderer.php       # Renderizado de vistas
├── views/
│   ├── form.php           # Formulario HTML
│   └── results.php        # Tabla de resultados
└── README.md

Instalación

    Colocar esta carpeta en ./html/noo/ del proyecto con docker-compose.yml
    Ejecutar docker-compose up -d
    Abrir http://localhost:8082/noo/

Uso

    Ingresar cantidad de números (n) entre 1 y 1000
    (Opcional) Definir rango mínimo y máximo
    Click en "Generar"
    Ver resultados en tabla con estadísticas

Características

    Sin Composer ni dependencias externas
    Patrón PRG (Post/Redirect/Get) para prevenir reenvío
    Validación server-side
    Escape de salida HTML (XSS)
    Diseño Bootstrap 5
    Compatible PHP 7.4
