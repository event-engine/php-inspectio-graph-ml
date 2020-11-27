<?php

/**
 * @see       https://github.com/event-engine/php-inspectio-graph-ml for the canonical source repository
 * @copyright https://github.com/event-engine/php-inspectio-graph-ml/blob/master/COPYRIGHT.md
 * @license   https://github.com/event-engine/php-inspectio-graph-ml/blob/master/LICENSE.md MIT License
 */

declare(strict_types=1);

namespace EventEngine\InspectioGraphMl;

use EventEngine\InspectioGraph\AggregateType;
use EventEngine\InspectioGraph\Metadata;

final class Aggregate extends Vertex implements AggregateType
{
    protected const TYPE = self::TYPE_AGGREGATE;

    /**
     * @var Metadata\AggregateMetadata|null
     */
    protected $metadataInstance;

    public function metadataInstance(): ?Metadata\AggregateMetadata
    {
        return $this->metadataInstance;
    }
}
