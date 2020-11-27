<?php

/**
 * @see       https://github.com/event-engine/php-inspectio-graph-ml for the canonical source repository
 * @copyright https://github.com/event-engine/php-inspectio-graph-ml/blob/master/COPYRIGHT.md
 * @license   https://github.com/event-engine/php-inspectio-graph-ml/blob/master/LICENSE.md MIT License
 */

declare(strict_types=1);

namespace EventEngine\InspectioGraphMl\Constraint;

use Fhaculty\Graph;

final class ConstraintChain implements Constraint
{
    /**
     * @var Constraint[]
     **/
    private $constraints;

    public function __construct(Constraint ...$constraints)
    {
        $this->constraints = $constraints;
    }

    public function __invoke(Graph\Vertex $vertex): void
    {
        foreach ($this->constraints as $constraint) {
            ($constraint)($vertex);
        }
    }
}
