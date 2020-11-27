<?php

/**
 * @see       https://github.com/event-engine/php-inspectio-graph-ml for the canonical source repository
 * @copyright https://github.com/event-engine/php-inspectio-graph-ml/blob/master/COPYRIGHT.md
 * @license   https://github.com/event-engine/php-inspectio-graph-ml/blob/master/LICENSE.md MIT License
 */

declare(strict_types=1);

namespace EventEngine\InspectioGraphMl\Constraint;

use EventEngine\InspectioGraphMl\Constraint\Exception\WrongConnectionCountException;
use Fhaculty\Graph;

final class AllowedConnectionToLessThan implements Constraint
{
    /**
     * @var string
     **/
    private $forType;

    /**
     * @var int
     **/
    private $max;

    public function __construct(string $forType, int $max)
    {
        $this->forType = $forType;
        $this->max = $max;
    }

    public function __invoke(Graph\Vertex $vertex): void
    {
        $type = $vertex->getAttribute('type');

        if ($type !== $this->forType) {
            return;
        }

        $vertices = $this->vertices($vertex);
        $verticesCount = $vertices->count();

        if ($verticesCount > $this->max) {
            throw WrongConnectionCountException::lessThan($vertex, $this->max);
        }
    }

    protected function vertices(Graph\Vertex $vertex): Graph\Set\Vertices
    {
        return $vertex->getVerticesEdgeFrom();
    }
}
