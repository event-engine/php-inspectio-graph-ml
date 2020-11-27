<?php

/**
 * @see       https://github.com/event-engine/php-inspectio-graph-ml for the canonical source repository
 * @copyright https://github.com/event-engine/php-inspectio-graph-ml/blob/master/COPYRIGHT.md
 * @license   https://github.com/event-engine/php-inspectio-graph-ml/blob/master/LICENSE.md MIT License
 */

declare(strict_types=1);

namespace EventEngine\InspectioGraphMl;

use EventEngine\InspectioGraph\EventType;
use EventEngine\InspectioGraph\Metadata;

final class Event extends Vertex implements EventType
{
    protected const TYPE = self::TYPE_EVENT;

    /**
     * @var Metadata\EventMetadata|null
     */
    protected $metadataInstance;

    public function metadataInstance(): ?Metadata\EventMetadata
    {
        return $this->metadataInstance;
    }
}
