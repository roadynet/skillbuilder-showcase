<?php

declare(strict_types=1);

/**
 * Public example of the SectionCode idea used by SkillBuilder.
 *
 * Section codes are stable identifiers such as "1.1.2". They connect imported
 * files, reading navigation, question filters, and statistics. Keeping parsing
 * and sorting centralized avoids subtle mismatches between features.
 */
final class SectionCodeServiceExample
{
    public function parseFilename(string $filename): ?string
    {
        return $this->extractDigitBlocks($filename, stopAtFirstDot: true);
    }

    public function normalize(string $code): ?string
    {
        return $this->extractDigitBlocks($code, stopAtFirstDot: false);
    }

    /**
     * @param list<string> $codes
     * @return list<string>
     */
    public function uniqueSorted(array $codes): array
    {
        $normalized = [];

        foreach ($codes as $code) {
            $value = $this->normalize($code);
            if ($value !== null) {
                $normalized[$value] = true;
            }
        }

        $result = array_keys($normalized);
        usort($result, fn (string $left, string $right): int => $this->compare($left, $right));

        return $result;
    }

    private function compare(string $left, string $right): int
    {
        $a = array_map('intval', explode('.', $left));
        $b = array_map('intval', explode('.', $right));
        $max = max(count($a), count($b));

        for ($i = 0; $i < $max; $i++) {
            $diff = ($a[$i] ?? 0) <=> ($b[$i] ?? 0);
            if ($diff !== 0) {
                return $diff;
            }
        }

        return strcmp($left, $right);
    }

    private function extractDigitBlocks(string $value, bool $stopAtFirstDot): ?string
    {
        $blocks = [];
        $current = '';

        foreach (str_split($value) as $char) {
            if ($stopAtFirstDot && $char === '.') {
                break;
            }

            if (ctype_digit($char)) {
                $current .= $char;
                continue;
            }

            if ($current !== '') {
                $blocks[] = $this->normalizeBlock($current);
                $current = '';
            }
        }

        if ($current !== '') {
            $blocks[] = $this->normalizeBlock($current);
        }

        return $blocks === [] ? null : implode('.', $blocks);
    }

    private function normalizeBlock(string $block): string
    {
        $normalized = ltrim($block, '0');

        return $normalized === '' ? '0' : $normalized;
    }
}

