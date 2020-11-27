<?php

/**
 * @see       https://github.com/event-engine/php-inspectio-graph-ml for the canonical source repository
 * @copyright https://github.com/event-engine/php-inspectio-graph-ml/blob/master/COPYRIGHT.md
 * @license   https://github.com/event-engine/php-inspectio-graph-ml/blob/master/LICENSE.md MIT License
 */

declare(strict_types=1);

namespace EventEngine\InspectioGraphMl\Constraint\Exception;

use Fhaculty\Graph\Vertex;

class ConnectionException extends RuntimeException
{
    public static function wrongConnection(Vertex $vertex, string ...$allowedTypes): ConnectionException
    {
        return new self(
            \sprintf(
                'No other connections than %s allowed for command "%s".',
                \implode(', ', $allowedTypes), $vertex->getAttribute('label')
            )
        );
    }
}
