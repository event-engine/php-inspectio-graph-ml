<?php

/**
 * @see       https://github.com/event-engine/php-inspectio-graph-ml for the canonical source repository
 * @copyright https://github.com/event-engine/php-inspectio-graph-ml/blob/master/COPYRIGHT.md
 * @license   https://github.com/event-engine/php-inspectio-graph-ml/blob/master/LICENSE.md MIT License
 */

declare(strict_types=1);

namespace EventEngine\InspectioGraphMl\Metadata;

use EventEngine\InspectioGraph\Metadata\CommandMetadata;

final class Command implements CommandMetadata
{
    /**
     * @var bool
     */
    private $newAggregate = false;

    /**
     * @var string|null
     */
    private $schema;

    private function __construct()
    {
    }

    public static function fromJsonMetadata(string $json): self
    {
        $self = new self();

        if (empty($json)) {
            return $self;
        }
        $data = GraphMlJsonMetadataFactory::decodeJson($json);

        $self->newAggregate = $data['newAggregate'] ?? false;

        if (! empty($data['schema'])) {
            $self->schema = GraphMlJsonMetadataFactory::encodeJson($data['schema']);
        }

        return $self;
    }

    public function newAggregate(): bool
    {
        return $this->newAggregate;
    }

    public function schema(): ?string
    {
        return $this->schema;
    }
}
