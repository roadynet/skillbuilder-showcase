# Code Walkthrough

This repository contains selected public examples inspired by SkillBuilder's private Symfony codebase. The examples are intentionally small, but they show the shape of the real engineering work: domain services, explicit security boundaries, progress-aware learning logic, and tests around business rules.

## Learning Scheduler

File: `examples/learning-scheduler/LearningSchedulerExample.php`

The scheduler demonstrates how SkillBuilder turns a submitted answer into a new repetition plan.

Important ideas:

- wrong answers shorten the next interval
- strict mode can reset a question to the first stage
- correct streaks gradually promote a question to higher stages
- long-term mode uses day-based intervals
- short-term mode keeps repetition close to the current session

This kind of logic belongs in a service, not in a controller. Controllers should report that an answer was correct or wrong; the scheduler owns the policy.

## Section Codes

File: `examples/section-code/SectionCodeServiceExample.php`

SkillBuilder uses section codes such as `1.1.2` as stable identifiers between imported material, reading navigation, questions, and statistics.

The public example shows:

- parsing filenames into normalized section codes
- removing leading zeroes
- sorting section codes numerically instead of lexicographically
- de-duplicating equivalent codes

This is small code, but it solves a real product problem: imported content, question filters, and navigation must agree on the same hierarchy.

## Next Due Question

File: `examples/question-selection/NextDueQuestionServiceExample.php`

This example shows the selection rule behind adaptive practice.

The service prefers:

1. unanswered questions
2. questions whose due date has passed
3. stable question id order as a fallback

It also shows the concept of a mistake pool: questions with previous wrong answers stay visible until the user rebuilds enough correct streak.

## Security Boundary

File: `examples/security/RoleCheckExample.php`

The private app uses Symfony Security, route access rules, CSRF protection, and admin-only workflows. The public example is deliberately simple, but it captures the rule: sensitive actions need explicit authorization and resource context.

## Tests

Files:

- `examples/tests/LearningSchedulerExampleTest.php`
- `examples/tests/SectionCodeServiceExampleTest.php`

The tests show how business rules can be verified without a browser or database. This is the same testing style used for the private project's core learning behavior.

## What These Examples Are Not

These files are not a copy of the private production repository. They are compact, publishable examples designed for portfolio review and technical interviews.

