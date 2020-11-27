<?php

/**
 * @see       https://github.com/event-engine/php-inspectio-graph-ml for the canonical source repository
 * @copyright https://github.com/event-engine/php-inspectio-graph-ml/blob/master/COPYRIGHT.md
 * @license   https://github.com/event-engine/php-inspectio-graph-ml/blob/master/LICENSE.md MIT License
 */

declare(strict_types=1);

namespace EventEngine\InspectioGraphMl\Constraint\Exception;

use Fhaculty\Graph\Vertex;

class WrongConnectionCountException extends RuntimeException
{
    /**
     * @var Vertex
     */
    private $vertex;

    public static function lessThan(Vertex $vertex, int $count): WrongConnectionCountException
    {
        $message = 'The connection count is not less or equal than %d';

        $self = new self(\sprintf($message, $count));

        $self->vertex = $vertex;

        return $self;
    }

    public static function greaterThan(Vertex $vertex, int $count): WrongConnectionCountException
    {
        $message = 'The connection count is not greater or equal than %d';

        $self = new self(\sprintf($message, $count));

        $self->vertex = $vertex;

        return $self;
    }

    /**
     * @return Vertex
     */
    public function vertex(): Vertex
    {
        return $this->vertex;
    }
}
