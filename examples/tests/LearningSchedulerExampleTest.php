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
        self::assertEquals($now->modify('+25 minutes'), $progress->nextDueAt);
    }

    public function testCorrectLongTermStreakPromotesStage(): void
    {
        $scheduler = new LearningSchedulerExample();
        $progress = new ProgressState();
        $progress->stage = 2;
        $progress->correctStreak = 2;

        $settings = new LearningSettings();
        $settings->mode = LearningMode::LongTerm;
        $settings->pace = 1.0;

        $now = new DateTimeImmutable('2026-05-17 10:00:00');

        $scheduler->schedule($progress, $settings, true, $now);

        self::assertSame(3, $progress->stage);
        self::assertEquals($now->modify('+11 days'), $progress->nextDueAt);
    }
}
