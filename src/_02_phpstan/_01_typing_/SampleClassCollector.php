<?php

declare(strict_types=1);

namespace App\_01_typing;

class SampleClassCollector
{
    /** @var SampleClass[] */
    private array $sample_class_array; // SampleClass[]のようなクラス配列は使えない

    /**
     * @param SampleClass[] $sample_class_array
     */
    public function __construct(array $sample_class_array)
    {
        $this->sample_class_array = $sample_class_array;
    }

    public function show(): void
    {
        foreach ($this->sample_class_array as $sample_class) {
            $sample_class->show();
        }
    }
}

// Parameter #1 $sample_class_array of class App\_01_typing\SampleClassCollector
// constructor expects array<App\_01_typing\SampleClass>, array<int, int> given
$sample_class_array = new SampleClassCollector([1, 2, 3]);
