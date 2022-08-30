<?php

namespace Pyz\Glue\FaqsRestApi\Plugin;

use Generated\Shared\Transfer\RestFaqsResponseAttributesTransfer;
use Pyz\Glue\FaqsRestApi\FaqsRestApiConfig;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class FaqsReaderResourcePlugin
    extends AbstractPlugin
    implements ResourceRoutePluginInterface {


    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection
    ): ResourceRouteCollectionInterface {
        $enabled = ($this->getConfig())::ENABLED;

        if (!$enabled) {
            return $resourceRouteCollection;
        }

        $resourceRouteCollection->addGet('get', true);
        //$resourceRouteCollection->addPost('post', true);
        //$resourceRouteCollection->addDelete('delete', true);

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
