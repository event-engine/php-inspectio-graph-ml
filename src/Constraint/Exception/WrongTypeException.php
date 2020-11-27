<?php

/**
 * @see       https://github.com/event-engine/php-inspectio-graph-ml for the canonical source repository
 * @copyright https://github.com/event-engine/php-inspectio-graph-ml/blob/master/COPYRIGHT.md
 * @license   https://github.com/event-engine/php-inspectio-graph-ml/blob/master/LICENSE.md MIT License
 */

declare(strict_types=1);

namespace EventEngine\InspectioGraphMl\Constraint\Exception;

use Fhaculty\Graph\Vertex;

class WrongTypeException extends RuntimeException
{
    public static function wrongType(Vertex $vertex, string ...$allowedTypes): WrongTypeException
    {
        return new self(
            \sprintf(
                'Type "%s" is not allowed. Allowed types are: "%s".',
                $vertex->getAttribute('type'), \implode(', ', $allowedTypes)
            )
        );
    }
}
