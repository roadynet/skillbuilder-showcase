<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class LearningSchedulerExampleTest extends TestCase
{
    public function testWrongAnswerInStrictModeResetsStage(): void
    {
        $scheduler = new LearningSchedulerExample();
        $progress = new ProgressState();
        $progress->stage = 4;

        $settings = new LearningSettings();
        $settings->strictMode = true;

        $now = new DateTimeImmutable('2026-05-17 10:00:00');

        $scheduler->schedule($progress, $settings, false, $now);

        self::assertSame(1, $progress->stage);
        self::assertEquals($now->modify('+20 minutes'), $progress->nextDueAt);
    }
}

