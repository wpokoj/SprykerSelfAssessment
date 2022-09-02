<?php

namespace Pyz\Glue\FaqsRestApi\Plugin;

use Generated\Shared\Transfer\RestFaqsResponseAttributesTransfer;
use Generated\Shared\Transfer\RestFaqVotesRequestAttributesTransfer;
use Generated\Shared\Transfer\RestFaqVotesResponseAttributesTransfer;
use Pyz\Glue\FaqsRestApi\FaqsRestApiConfig;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

/**
 * @method FaqsRestApiConfig getConfig()
 */
class FaqVotesReaderResourcePlugin
    extends AbstractPlugin
    implements ResourceRoutePluginInterface {


    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection
    ): ResourceRouteCollectionInterface {
        $enabled = $this->getConfig()->isEndpointEnabled(FaqsRestApiConfig::RESOURCE_FAQ_VOTES);

        if ($enabled) {
            $resourceRouteCollection->addGet('get', true);
        }

        return $resourceRouteCollection;
    }

    public function getResourceType(): string {
        return FaqsRestApiConfig::RESOURCE_READ_FAQ_VOTES;
    }

    public function getController(): string {
        return 'faq-votes-resource';
    }

    public function getResourceAttributesClassName(): string {
        return RestFaqVotesResponseAttributesTransfer::class;
    }
}
