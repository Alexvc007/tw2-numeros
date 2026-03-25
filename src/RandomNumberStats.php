<?php

class RandomNumberStats
{
    private $numbers;

    public function __construct($numbers)
    {
        $this->numbers = $numbers;
    }

    public function sum()
    {
        return array_sum($this->numbers);
    }

    public function average()
    {
        return count($this->numbers) > 0 ? $this->sum() / count($this->numbers) : 0;
    }

    public function min()
    {
        return min($this->numbers);
    }

    public function max()
    {
        return max($this->numbers);
    }
}
?>