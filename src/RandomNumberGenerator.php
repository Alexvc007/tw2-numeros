<?php

class RandomNumberGenerator
{
    private $count;
    private $min;
    private $max;
    private $numbers = [];

    public function __construct($count, $min, $max)
    {
        $this->count = $count;
        $this->min = $min;
        $this->max = $max;
    }

    public function generateNumbers()
    {
        $this->numbers = [];
        for ($i = 0; $i < $this->count; $i++) {
            $this->numbers[] = rand($this->min, $this->max);
        }
        return $this->numbers;
    }

    public function getNumbers()
    {
        return $this->numbers;
    }
}
?>