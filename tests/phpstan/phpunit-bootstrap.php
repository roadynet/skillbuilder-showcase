<?php

declare(strict_types=1);

namespace PHPUnit\Framework;

if (!class_exists(TestCase::class, false)) {
    abstract class TestCase
    {
        /**
         * @param mixed $expected
         * @param mixed $actual
         */
        public static function assertSame($expected, $actual, string $message = ''): void
        {
        }

        /**
         * @param mixed $expected
         * @param mixed $actual
         */
        public static function assertEquals($expected, $actual, string $message = ''): void
        {
        }
    }
}
