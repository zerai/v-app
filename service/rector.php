<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
        __DIR__ . '/context/clinicManagement/src',
        __DIR__ . '/context/clinicManagement/tests',
        __DIR__ . '/context/frontDesk/src',
        __DIR__ . '/context/frontDesk/tests',
        __DIR__ . '/context/vetClinicPublic/src',
        __DIR__ . '/context/vetClinicPublic/tests',
    ])

    ->withSkip([
        __DIR__ . '/src/Kernel.php',
        __DIR__ . '/tests/bootstrap.php',
    ])

    ->withPhpSets(php82: true)
    ->withTypeCoverageLevel(0)
    ->withDeadCodeLevel(0)
    ->withCodeQualityLevel(0);
