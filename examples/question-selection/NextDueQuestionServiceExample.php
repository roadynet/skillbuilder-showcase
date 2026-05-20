<?php

declare(strict_types=1);

/**
 * Public example of progress-aware question selection.
 *
 * The private project uses Doctrine queries. This example keeps the same
 * ordering rule in plain PHP: prefer unanswered questions, then due questions,
 * then a stable question id fallback.
 */
final class NextDueQuestionServiceExample
{
    /**
     * @param list<QuestionCandidate> $questions
     */
    public function nextDueQuestion(array $questions, string $sectionCode, \DateTimeImmutable $now): ?QuestionCandidate
    {
        $due = array_values(array_filter(
            $questions,
            static fn (QuestionCandidate $question): bool =>
                $question->sectionCode === $sectionCode
                && ($question->progress === null || $question->progress->nextDueAt <= $now)
                && ($question->progress === null || $question->progress->correctStreak < 2)
        ));

        usort($due, static function (QuestionCandidate $left, QuestionCandidate $right): int {
            return [
                $left->progress === null ? 0 : 1,
                $left->progress?->nextDueAt?->getTimestamp() ?? 0,
                $left->id,
            ] <=> [
                $right->progress === null ? 0 : 1,
                $right->progress?->nextDueAt?->getTimestamp() ?? 0,
                $right->id,
            ];
        });

        return $due[0] ?? null;
    }

    /**
     * @param list<QuestionCandidate> $questions
     */
    public function countDueMistakes(array $questions, \DateTimeImmutable $now): int
    {
        return count(array_filter(
            $questions,
            static fn (QuestionCandidate $question): bool =>
                $question->progress !== null
                && $question->progress->wrongCount > 0
                && $question->progress->correctStreak < 2
                && $question->progress->nextDueAt <= $now
        ));
    }
}

final class QuestionCandidate
{
    public function __construct(
        public readonly int $id,
        public readonly string $sectionCode,
        public readonly ?QuestionProgress $progress = null,
    ) {
    }
}

final class QuestionProgress
{
    public function __construct(
        public readonly \DateTimeImmutable $nextDueAt,
        public readonly int $correctStreak = 0,
        public readonly int $wrongCount = 0,
    ) {
    }
}

