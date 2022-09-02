<?php

namespace Pyz\Glue\FaqsRestApi\Plugin;

use Generated\Shared\Transfer\RestFaqsResponseAttributesTransfer;
use Pyz\Glue\FaqsRestApi\FaqsRestApiConfig;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

/**
 * @method FaqsRestApiConfig getConfig()
 */
class FaqsReaderResourcePlugin
    extends AbstractPlugin
    implements ResourceRoutePluginInterface {


    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection
    ): ResourceRouteCollectionInterface {
        $enabled = $this->getConfig()->isEndpointEnabled(FaqsRestApiConfig::RESOURCE_READ_FAQS);

        if ($enabled) {
            $resourceRouteCollection->addGet('get', false);
        }

        return $resourceRouteCollection;
    }

    public function getResourceType(): string {
        return FaqsRestApiConfig::RESOURCE_READ_FAQS;
    }

    public function getController(): string {
        return 'faqs-resource';
    }

    public function getResourceAttributesClassName(): string {
        return RestFaqsResponseAttributesTransfer::class;
    }
}
