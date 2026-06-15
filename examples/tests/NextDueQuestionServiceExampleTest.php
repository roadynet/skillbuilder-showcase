<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class NextDueQuestionServiceExampleTest extends TestCase
{
    public function testUnansweredQuestionIsPreferredWithinTheRequestedSection(): void
    {
        $service = new NextDueQuestionServiceExample();
        $now = new DateTimeImmutable('2026-06-15 09:00:00');

        $questions = [
            new QuestionCandidate(9, '1.1', new QuestionProgress($now->modify('-2 hours'), wrongCount: 1)),
            new QuestionCandidate(3, '1.1'),
            new QuestionCandidate(1, '2.1'),
        ];

        self::assertSame(3, $service->nextDueQuestion($questions, '1.1', $now)?->id);
    }

    public function testDueQuestionsUseDueDateThenStableIdOrdering(): void
    {
        $service = new NextDueQuestionServiceExample();
        $now = new DateTimeImmutable('2026-06-15 09:00:00');

        $questions = [
            new QuestionCandidate(4, '1.1', new QuestionProgress($now->modify('-30 minutes'), wrongCount: 1)),
            new QuestionCandidate(2, '1.1', new QuestionProgress($now->modify('-2 hours'), wrongCount: 1)),
            new QuestionCandidate(1, '1.1', new QuestionProgress($now->modify('+1 day'), wrongCount: 1)),
        ];

        self::assertSame(2, $service->nextDueQuestion($questions, '1.1', $now)?->id);
    }

    public function testMistakePoolCountsOnlyDueUnresolvedMistakes(): void
    {
        $service = new NextDueQuestionServiceExample();
        $now = new DateTimeImmutable('2026-06-15 09:00:00');

        $questions = [
            new QuestionCandidate(1, '1.1', new QuestionProgress($now->modify('-1 hour'), wrongCount: 1)),
            new QuestionCandidate(2, '1.1', new QuestionProgress($now->modify('+1 hour'), wrongCount: 1)),
            new QuestionCandidate(3, '1.1', new QuestionProgress($now->modify('-1 hour'), correctStreak: 2, wrongCount: 1)),
            new QuestionCandidate(4, '1.1', new QuestionProgress($now->modify('-1 hour'))),
        ];

        self::assertSame(1, $service->countDueMistakes($questions, $now));
    }
}
