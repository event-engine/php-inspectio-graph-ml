<?php

/**
 * @see       https://github.com/event-engine/php-inspectio-graph-ml for the canonical source repository
 * @copyright https://github.com/event-engine/php-inspectio-graph-ml/blob/master/COPYRIGHT.md
 * @license   https://github.com/event-engine/php-inspectio-graph-ml/blob/master/LICENSE.md MIT License
 */

declare(strict_types=1);

namespace EventEngine\InspectioGraphMl\Constraint;

use EventEngine\InspectioGraphMl\Constraint\Exception\MissingAttributeException;
use Fhaculty\Graph;

final class MandatoryAttribute implements Constraint
{
    /**
     * @var string[]
     **/
    private $attributes;

    public function __construct(string ...$attributes)
    {
        $this->attributes = $attributes;
    }

    public function __invoke(Graph\Vertex $vertex): void
    {
        foreach ($this->attributes as $attribute) {
            if (null === $vertex->getAttribute($attribute)) {
                throw MissingAttributeException::missingAttribute($vertex, $attribute);
            }
        }
    }
}
