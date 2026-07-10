<?php

declare(strict_types=1);

/**
 * Simplified public example inspired by SkillBuilder's private learning profile flow.
 *
 * The production app stores answers as Doctrine entities and applies the result to
 * user learning settings. This small example keeps the same decision shape while
 * staying safe to publish in a portfolio repository.
 */
final class LearningProfileExample
{
    private const MIXED_THRESHOLD = 2;

    /**
     * @param list<ProfileAnswer> $answers
     */
    public function calculate(array $answers): LearningProfileResult
    {
        $scores = [
            'type' => ['visual' => 0, 'practical' => 0, 'reading' => 0, 'auditory' => 0],
            'speed' => ['slow' => 0, 'normal' => 0, 'fast' => 0],
            'repetition' => [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0],
            'task' => ['quiz' => 0, 'code' => 0, 'reading' => 0, 'project' => 0],
        ];

        foreach ($answers as $answer) {
            foreach ($answer->scores as $key => $points) {
                if (isset($scores['type'][$key])) {
                    $scores['type'][$key] += $points;
                    continue;
                }

                if (str_starts_with($key, 'speed_')) {
                    $speed = substr($key, 6);
                    if (isset($scores['speed'][$speed])) {
                        $scores['speed'][$speed] += $points;
                    }
                    continue;
                }

                if (str_starts_with($key, 'repetition_')) {
                    $level = (int) substr($key, 11);
                    if (isset($scores['repetition'][$level])) {
                        $scores['repetition'][$level] += $points;
                    }
                    continue;
                }

                if (str_starts_with($key, 'task_')) {
                    $task = substr($key, 5);
                    if (isset($scores['task'][$task])) {
                        $scores['task'][$task] += $points;
                    }
                }
            }
        }

        return new LearningProfileResult(
            learningType: $this->pickProfileDimension($scores['type']),
            speed: $this->pickTop($scores['speed'], 'normal'),
            repetitionLevel: (int) $this->pickTop($scores['repetition'], 3),
            preferredTaskType: $this->pickProfileDimension($scores['task']),
        );
    }

    public function recommend(LearningProfileResult $profile): LearningRecommendation
    {
        return new LearningRecommendation(
            firstBlock: $profile->learningType,
            questionLimit: match ($profile->speed) {
                'slow' => 5,
                'fast' => 20,
                default => 10,
            },
            showReviewQuestions: $profile->repetitionLevel >= 4,
            showExtraQuestions: $profile->speed === 'fast',
            preferredPrompt: match ($profile->preferredTaskType) {
                'code' => 'Prefer small implementation tasks.',
                'project' => 'Prefer compact project slices.',
                'reading' => 'Prefer reading tasks and summaries.',
                'quiz' => 'Prefer quiz checkpoints.',
                default => 'Mix quiz, code, reading, and project prompts.',
            },
        );
    }

    /**
     * @param array<string, int> $scores
     */
    private function pickProfileDimension(array $scores): string
    {
        arsort($scores);
        $values = array_values($scores);

        if (($values[0] ?? 0) <= 0) {
            return 'mixed';
        }

        if (count($values) > 1 && ($values[0] - $values[1]) <= self::MIXED_THRESHOLD) {
            return 'mixed';
        }

        return (string) array_key_first($scores);
    }

    /**
     * @param array<array-key, int> $scores
     */
    private function pickTop(array $scores, string|int $default): string|int
    {
        arsort($scores);

        if ((int) reset($scores) <= 0) {
            return $default;
        }

        return array_key_first($scores);
    }
}

final class ProfileAnswer
{
    /**
     * @param array<string, int> $scores
     */
    public function __construct(public array $scores)
    {
    }
}

final class LearningProfileResult
{
    public function __construct(
        public string $learningType,
        public string $speed,
        public int $repetitionLevel,
        public string $preferredTaskType,
    ) {
    }
}

final class LearningRecommendation
{
    public function __construct(
        public string $firstBlock,
        public int $questionLimit,
        public bool $showReviewQuestions,
        public bool $showExtraQuestions,
        public string $preferredPrompt,
    ) {
    }
}
