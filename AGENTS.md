# AGENTS.md - PHP Random Numbers App

## Project Overview
PHP OOP application that generates N random numbers and displays them in a table. Uses PRG pattern, separate class files, no infinite loops/switch/break.

## Build & Test Commands

```bash
# Run application (dev server)
php -S localhost:8000 -t public/


## Code Style Guidelines

### General
- PSR-12 standard
- `declare(strict_types=1)` in all PHP files
- UTF-8 encoding, 4 spaces indentation, 120 char line max

### Imports & Namespaces
```php
<?php
declare(strict_types=1);
namespace App\Src;

use InvalidArgumentException;
use function array_map;
use function count;
```
- One `use` per line, alphabetical order
- Use `use function` for functions, `use const` for constants

### Type Hints
- Always use return types on methods
- Use `?Type` for nullable
- Constructor property promotion (PHP 8+)

### Naming Conventions
- Classes: PascalCase (`RandomGenerator`)
- Methods/Properties: camelCase (`$numbers`, `getInt()`)
- Constants: UPPER_SNAKE_CASE
- Files: Match class name (`RandomGenerator.php`)

### Control Flow
- **NEVER** use `switch` or `break` (outside loops)
- **NEVER** use infinite loops (`while(true)`)
- Use `match` (PHP 8+) instead of switch if needed

### Error Handling
- Throw semantic exceptions (`InvalidArgumentException`)
- Validate inputs at method start
- Never suppress errors with `@`
- Catch specific exceptions, never generic `Exception`

### Security
- Escape all HTML output: `htmlspecialchars($value, ENT_QUOTES, 'UTF-8')`
- Validate all user input with `filter_var(..., FILTER_VALIDATE_INT)`
- Use `random_int()` for random number generation
- Never use `eval()`, `exec()`, or dangerous functions

### PHPDoc
- Document all public methods with `@param` and `@return`
- Include `@throws` for thrown exceptions

### Testing
- One test file per class: `Tests\Unit\ClassNameTest.php`
- Test method naming: `testMethodDoesExpectedBehavior()`
- Test happy path and edge cases

## File Structure
/
├── public/
│   ├── index.php         # Punto de entrada único
│   └── css/
│       └── style.css     # Estilos CSS nativos
├── src/
│   ├── App.php           # Controlador principal (Lógica PRG)
│   ├── RandomGenerator.php # Generación de números
│   ├── Request.php       # Manejo de $_GET y $_POST
│   └── Renderer.php      # Carga de archivos .php de la carpeta views
├── views/
│   ├── form.php          # Interfaz del formulario
│   └── results.php       # Interfaz de la tabla
└── tests/
    └── run_tests.php     # Script de aserciones simples

## Agent Notes
1. Read and understand structure before modifying
2. Maintain single responsibility principle (SRP)
3. No breaking changes without consensus
