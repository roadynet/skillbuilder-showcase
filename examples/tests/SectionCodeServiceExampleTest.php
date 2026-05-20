<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class SectionCodeServiceExampleTest extends TestCase
{
    public function testFilenameParsingNormalizesHierarchy(): void
    {
        $service = new SectionCodeServiceExample();

        self::assertSame('1.2.3', $service->parseFilename('01_002_0003_intro.md'));
        self::assertSame('1.1.1', $service->parseFilename('1-1-1_example.txt'));
    }

    public function testUniqueSortedUsesNumericHierarchy(): void
    {
        $service = new SectionCodeServiceExample();

        self::assertSame(
            ['1.1', '1.2', '1.10', '2'],
            $service->uniqueSorted(['1.10', '2', '01_002', '1.1', '1.2'])
        );
    }
}

