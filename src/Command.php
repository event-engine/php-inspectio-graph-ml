<?php

/**
 * @see       https://github.com/event-engine/php-inspectio-graph-ml for the canonical source repository
 * @copyright https://github.com/event-engine/php-inspectio-graph-ml/blob/master/COPYRIGHT.md
 * @license   https://github.com/event-engine/php-inspectio-graph-ml/blob/master/LICENSE.md MIT License
 */

declare(strict_types=1);

namespace EventEngine\InspectioGraphMl;

use EventEngine\InspectioGraph\CommandType;
use EventEngine\InspectioGraph\Metadata;

final class Command extends Vertex implements CommandType
{
    protected const TYPE = self::TYPE_COMMAND;

    /**
     * @var Metadata\CommandMetadata|null
     */
    protected $metadataInstance;

    public function metadataInstance(): ?Metadata\CommandMetadata
    {
        return $this->metadataInstance;
    }
}
