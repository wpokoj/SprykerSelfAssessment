<?php

namespace Pyz\Glue\FaqsRestApi\Plugin;

use Generated\Shared\Transfer\RestFaqsResponseAttributesTransfer;
use Generated\Shared\Transfer\RestFaqVotesRequestAttributesTransfer;
use Pyz\Glue\FaqsRestApi\FaqsRestApiConfig;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class FaqVotesResourcePlugin
    extends AbstractPlugin
    implements ResourceRoutePluginInterface {


    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection
    ): ResourceRouteCollectionInterface {
        $enabled = ($this->getConfig())::ENABLED;

        if (!$enabled) {
            return $resourceRouteCollection;
        }

        $resourceRouteCollection->addPost('post', true);

        return $resourceRouteCollection;
    }

    public function getResourceType(): string {
        return FaqsRestApiConfig::RESOURCE_FAQ_VOTES;
    }

    public function getController(): string {
        return 'faq-votes-resource';
    }

    public function getResourceAttributesClassName(): string {
        return RestFaqVotesRequestAttributesTransfer::class;
    }
}
