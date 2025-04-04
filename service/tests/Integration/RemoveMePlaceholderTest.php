<?php declare(strict_types=1);

namespace App\Tests\Integration;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class RemoveMePlaceholderTest extends TestCase
{
    public function test_remove_me(): void
    {
        Assert::assertEquals(4, 2 + 2);
    }
}
