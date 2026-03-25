<?php

declare(strict_types=1);

require_once __DIR__ . '/Request.php';
require_once __DIR__ . '/RandomGenerator.php';
require_once __DIR__ . '/Renderer.php';

class App
{
    private Request $request;
    private RandomGenerator $generator;
    private Renderer $renderer;

    public function __construct()
    {
        $this->request   = new Request();
        $this->generator = new RandomGenerator();
        $this->renderer  = new Renderer(__DIR__ . '/../views');
    }

    public function run(): void
    {
        if ($this->request->isPost()) {
            $this->handlePost();
        } else {
            $this->handleGet();
        }
    }

    // ── POST: validate → store in session → Redirect ────────────────────────
    private function handlePost(): void
    {
        session_start();

        $min      = $this->request->postInt('min');
        $max      = $this->request->postInt('max');
        $quantity = $this->request->postInt('quantity', 10);

        // Keep raw input for re-population on error
        $_SESSION['form'] = [
            'min'      => $this->request->post('min', ''),
            'max'      => $this->request->post('max', ''),
            'quantity' => $this->request->post('quantity', '10'),
        ];

        if ($min === null || $max === null || $quantity === null) {
            $_SESSION['error'] = 'Por favor ingresa valores numéricos enteros válidos.';
            $this->redirect();
            return;
        }

        try {
            $this->generator->validate($min, $max, $quantity);
            $numbers = $this->generator->generate($min, $max, $quantity);

            $_SESSION['results'] = [
                'numbers'  => $numbers,
                'min'      => $min,
                'max'      => $max,
                'quantity' => $quantity,
                'stats'    => $this->generator->stats($numbers),
            ];
            $_SESSION['error'] = null;
        } catch (InvalidArgumentException $e) {
            $_SESSION['error']   = $e->getMessage();
            $_SESSION['results'] = null;
        }

        $this->redirect();
    }

    // ── GET: read session → render ───────────────────────────────────────────
    private function handleGet(): void
    {
        session_start();

        $results = $_SESSION['results'] ?? null;
        $error   = $_SESSION['error']   ?? null;
        $form    = $_SESSION['form']    ?? ['min' => '', 'max' => '', 'quantity' => '10'];

        // Clear flash data
        unset($_SESSION['results'], $_SESSION['error'], $_SESSION['form']);

        $this->renderer->render('form', [
            'form'  => $form,
            'error' => $error,
        ]);

        if ($results) {
            $this->renderer->render('results', ['results' => $results]);
        }
    }

    private function redirect(): void
    {
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}
