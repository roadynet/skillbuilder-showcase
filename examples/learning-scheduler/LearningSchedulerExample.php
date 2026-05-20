<?php

declare(strict_types=1);

/**
 * Simplified public example inspired by SkillBuilder's private learning scheduler.
 *
 * This is not production code from the private repository. It demonstrates the
 * shape of the business rule: correct answers increase stability, wrong answers
 * shorten the next review interval, and user settings influence the pacing.
 */
final class LearningSchedulerExample
{
    public function schedule(ProgressState $progress, LearningSettings $settings, bool $isCorrect, \DateTimeImmutable $now): void
    {
        if ($settings->mode === LearningMode::ShortTerm) {
            $this->scheduleShortTerm($progress, $settings, $isCorrect, $now);
            return;
        }

        $this->scheduleLongTerm($progress, $settings, $isCorrect, $now);
    }

    private function scheduleShortTerm(ProgressState $progress, LearningSettings $settings, bool $isCorrect, \DateTimeImmutable $now): void
    {
        if (!$isCorrect) {
            $progress->wrongCount++;
            $progress->correctStreak = 0;
            $progress->stage = $settings->strictMode ? 1 : max(1, $progress->stage - 1);
            $progress->nextDueAt = $now;

            return;
        }

        $progress->correctStreak++;
        $minutes = max(5, $settings->shortIntervalMinutes) + min(40, $progress->wrongCount * 5);
        $progress->nextDueAt = $now->modify('+' . $minutes . ' minutes');
    }

    private function scheduleLongTerm(ProgressState $progress, LearningSettings $settings, bool $isCorrect, \DateTimeImmutable $now): void
    {
        if (!$isCorrect) {
            $progress->wrongCount++;
            $progress->correctStreak = 0;
            $progress->stage = $settings->strictMode ? 1 : max(1, $progress->stage - 1);
            $minutes = max(5, $settings->shortIntervalMinutes) + min(40, $progress->wrongCount * 5);
            $progress->nextDueAt = $now->modify('+' . $minutes . ' minutes');

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

        $stageFactor = 1.0 + max(0, $progress->stage - 1) * 0.25;
        $wrongPenalty = 1.0 - min(0.4, $progress->wrongCount * 0.05);
        $days = max(1, (int) round($days * $stageFactor * $wrongPenalty * $settings->pace));

        $progress->nextDueAt = $now->modify('+' . $days . ' days');
    }
}

enum LearningMode
{
    case ShortTerm;
    case LongTerm;
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
    public LearningMode $mode = LearningMode::LongTerm;
    public int $maxStage = 5;
    public int $shortIntervalMinutes = 20;
    public float $pace = 1.0;
    public bool $strictMode = false;
}
