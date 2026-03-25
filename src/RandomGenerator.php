<?php

declare(strict_types=1);

class RandomGenerator
{
    public const MIN_QUANTITY = 1;
    public const MAX_QUANTITY = 100;

    /**
     * Generate an array of random integers between $min and $max (inclusive).
     *
     * @param  int  $min
     * @param  int  $max
     * @param  int  $quantity
     * @return int[]
     * @throws InvalidArgumentException
     */
    public function generate(int $min, int $max, int $quantity): array
    {
        $this->validate($min, $max, $quantity);

        $numbers = [];
        for ($i = 0; $i < $quantity; $i++) {
            $numbers[] = random_int($min, $max);
        }
        return $numbers;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function validate(int $min, int $max, int $quantity): void
    {
        if ($min > $max) {
            throw new InvalidArgumentException(
                "El mínimo ($min) no puede ser mayor que el máximo ($max)."
            );
        }

        if ($quantity < self::MIN_QUANTITY || $quantity > self::MAX_QUANTITY) {
            throw new InvalidArgumentException(
                "La cantidad debe estar entre " . self::MIN_QUANTITY . " y " . self::MAX_QUANTITY . "."
            );
        }
    }

    /** Returns basic stats about a list of numbers */
    public function stats(array $numbers): array
    {
        if (empty($numbers)) {
            return ['min' => null, 'max' => null, 'avg' => null, 'sum' => null];
        }
        return [
            'min' => min($numbers),
            'max' => max($numbers),
            'avg' => round(array_sum($numbers) / count($numbers), 2),
            'sum' => array_sum($numbers),
        ];
    }
}
