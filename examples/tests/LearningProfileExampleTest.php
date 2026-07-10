<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class LearningProfileExampleTest extends TestCase
{
    public function testDominantVisualProfileIsDetected(): void
    {
        $profile = (new LearningProfileExample())->calculate([
            new ProfileAnswer(['visual' => 5, 'speed_normal' => 1, 'repetition_3' => 1, 'task_quiz' => 1]),
            new ProfileAnswer(['visual' => 4, 'task_quiz' => 2]),
        ]);

        self::assertSame('visual', $profile->learningType);
        self::assertSame('quiz', $profile->preferredTaskType);
    }

    public function testCloseLearningTypeScoresBecomeMixed(): void
    {
        $profile = (new LearningProfileExample())->calculate([
            new ProfileAnswer(['visual' => 5, 'speed_normal' => 1, 'repetition_3' => 1]),
            new ProfileAnswer(['practical' => 4]),
        ]);

        self::assertSame('mixed', $profile->learningType);
    }

    public function testFastLowRepetitionProfileGetsMoreQuestions(): void
    {
        $service = new LearningProfileExample();
        $profile = $service->calculate([
            new ProfileAnswer(['practical' => 5, 'speed_fast' => 3, 'repetition_2' => 2, 'task_code' => 3]),
            new ProfileAnswer(['speed_fast' => 2, 'task_code' => 2]),
        ]);

        $recommendation = $service->recommend($profile);

        self::assertSame('fast', $profile->speed);
        self::assertSame(2, $profile->repetitionLevel);
        self::assertSame(20, $recommendation->questionLimit);
        self::assertTrue($recommendation->showExtraQuestions);
        self::assertFalse($recommendation->showReviewQuestions);
    }
}
