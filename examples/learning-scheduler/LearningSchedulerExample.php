<?php

declare(strict_types=1);

/**
 * Simplified public example inspired by SkillBuilder's private learning scheduler.
 *
 * This is not production code from the private repository. It demonstrates the
 * kind of business rule that is covered by tests: correct answers increase
 * stability, wrong answers shorten the next review interval.
 */
final class LearningSchedulerExample
{
    public function schedule(ProgressState $progress, LearningSettings $settings, bool $isCorrect, \DateTimeImmutable $now): void
    {
        if (!$isCorrect) {
            $progress->wrongCount++;
            $progress->correctStreak = 0;
            $progress->stage = $settings->strictMode ? 1 : max(1, $progress->stage - 1);
            $progress->nextDueAt = $now->modify('+20 minutes');

            return;
        }

        $progress->correctStreak++;

        if ($progress->correctStreak >= 3) {
            $progress->stage = min($settings->maxStage, $progress->stage + 1);
        }

        $days = match (true) {
            $progress->correctStreak <= 1 => 1,
            $progress->correctStreak === 2 => 3,
            $progress->correctStreak === 3 => 7,
            default => 14,
        };

        $progress->nextDueAt = $now->modify('+' . $days . ' days');
    }
}

final class ProgressState
{
    public int $stage = 1;
    public int $wrongCount = 0;
    public int $correctStreak = 0;
    public ?\DateTimeImmutable $nextDueAt = null;
}

final class LearningSettings
{
    public int $maxStage = 5;
    public bool $strictMode = false;
}

