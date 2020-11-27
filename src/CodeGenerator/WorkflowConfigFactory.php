<?php

/**
 * @see       https://github.com/event-engine/php-inspectio-graph-ml for the canonical source repository
 * @copyright https://github.com/event-engine/php-inspectio-graph-ml/blob/master/COPYRIGHT.md
 * @license   https://github.com/event-engine/php-inspectio-graph-ml/blob/master/LICENSE.md MIT License
 */

declare(strict_types=1);

namespace EventEngine\InspectioGraphMl\CodeGenerator;

use EventEngine\InspectioGraphMl\Constraint\AllowedConnectionFromGreaterThan;
use EventEngine\InspectioGraphMl\Constraint\AllowedConnectionToLessThan;
use EventEngine\InspectioGraphMl\Constraint\AllowedConnectionToType;
use EventEngine\InspectioGraphMl\Constraint\AllowedVertexType;
use EventEngine\InspectioGraphMl\Constraint\ConstraintChain;
use EventEngine\InspectioGraphMl\Constraint\MandatoryAttribute;
use EventEngine\InspectioGraphMl\Transformator;
use EventEngine\InspectioGraphMl\Validator;
use Graphp\GraphML\Loader;
use OpenCodeModeling\CodeGenerator;
use OpenCodeModeling\CodeGenerator\Config\WorkflowConfig;

final class WorkflowConfigFactory
{
    /**
     * Slot for the \Fhaculty\Graph\Graph instance
     */
    public const SLOT_GRAPH = 'inspectio_graph-event_sourcing_graph';

    /**
     * Slot for the \EventEngine\InspectioGraph\EventSourcingAnalyzer instance
     */
    public const SLOT_EVENT_SOURCING_ANALYZER = 'inspectio_graph-event_sourcing_analyzer_graph';

    /**
     * Configures a workflow to transform a GraphML XML string to an EventSourcingAnalyzer instance which is put to the
     * slot WorkflowConfigFactory::SLOT_EVENT_SOURCING_ANALYZER.
     *
     * @param string $inputSlotGraphMlXml Input slot name for GraphML XML document
     * @param callable $filterConstName
     * @param callable|null $metadataFactory
     * @return WorkflowConfig
     */
    public static function graphMlXmlToEventSourcingAnalyzer(
        string $inputSlotGraphMlXml,
        callable $filterConstName,
        ?callable $metadataFactory = null
    ): WorkflowConfig {
        $componentDescription = [
            // Configure model validation
            Transformator\GraphMlToGraph::workflowComponentDescription(
                new Loader(),
                $inputSlotGraphMlXml,
                self::SLOT_GRAPH
            ),
            Transformator\GraphToEventSourcingAnalyzer::workflowComponentDescription(
                self::defaultValidator(),
                $filterConstName,
                $metadataFactory,
                self::SLOT_GRAPH,
                self::SLOT_EVENT_SOURCING_ANALYZER
            ),
        ];

        return new CodeGenerator\Config\Workflow(...$componentDescription);
    }

    public static function defaultValidator(): Validator
    {
        return new Validator(
            new ConstraintChain(
                new MandatoryAttribute('type', 'label'),
                new AllowedVertexType('command', 'event', 'aggregate'),
                new AllowedConnectionToType('command', 'aggregate'),
                new AllowedConnectionToType('aggregate', 'event'),
                new AllowedConnectionToLessThan('aggregate', 1),
                new AllowedConnectionFromGreaterThan('aggregate', 1)
            )
        );
    }
}
