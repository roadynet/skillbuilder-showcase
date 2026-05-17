<?php

declare(strict_types=1);

/**
 * Simplified public example showing the shape of explicit workflow checks.
 *
 * The private application uses Symfony Security and route-level authorization.
 * This small sample only demonstrates the principle: sensitive actions require
 * an explicit role and the correct resource context.
 */
final class RoleCheckExample
{
    public function canEditQuestion(UserContext $user, QuestionContext $question): bool
    {
        if (!$user->hasRole('ROLE_ADMIN')) {
            return false;
        }

        if ($question->isArchived) {
            return false;
        }

        return true;
    }
}

final class UserContext
{
    /**
     * @param list<string> $roles
     */
    public function __construct(private array $roles)
    {
    }

    public function hasRole(string $role): bool
    {
        return in_array($role, $this->roles, true);
    }
}

final class QuestionContext
{
    public bool $isArchived = false;
}

