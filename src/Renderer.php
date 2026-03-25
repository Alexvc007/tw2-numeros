<?php

declare(strict_types=1);

class Renderer
{
    private string $viewsPath;

    public function __construct(string $viewsPath)
    {
        $this->viewsPath = rtrim($viewsPath, DIRECTORY_SEPARATOR);
    }

    /**
     * Render a view file, injecting the given variables into its scope.
     *
     * @param string $view   View filename without .php extension
     * @param array  $data   Associative array of variables to expose in the view
     */
    public function render(string $view, array $data = []): void
    {
        $file = $this->viewsPath . DIRECTORY_SEPARATOR . $view . '.php';

        if (!file_exists($file)) {
            throw new RuntimeException("View not found: {$file}");
        }

        extract($data, EXTR_SKIP);
        require $file;
    }
}
