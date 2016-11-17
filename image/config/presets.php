<?php

return [
    'presetsConfig' => [
        [
            'filters' => [
                (new \Imagine\Filter\Basic\Resize(new \Imagine\Image\Box(100, 100))),
                (new \Imagine\Filter\Advanced\Grayscale()),
            ],
            'usageNames' => ['test'],
        ]
    ],
];