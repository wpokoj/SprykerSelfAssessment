<?php

namespace Pyz\Glue\FaqsRestApi\Plugin;


use Generated\Shared\Transfer\RestFaqsRequestAttributesTransfer;
use Generated\Shared\Transfer\RestFaqsResponseAttributesTransfer;
use Pyz\Glue\FaqsRestApi\FaqsRestApiConfig;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

/**
 * @method \Pyz\Glue\FaqsRestApi\FaqsRestApiFactory getFactory()
 * @method FaqsRestApiConfig getConfig()
 */
class FaqsResourceRoutePlugin
    extends AbstractPlugin
    implements ResourceRoutePluginInterface {


    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        $enabled = $this->getConfig()->isEndpointEnabled(FaqsRestApiConfig::RESOURCE_FAQS);

        if($enabled) {
            $resourceRouteCollection->addPost('post', true);
            $resourceRouteCollection->addPatch('patch', true);
            $resourceRouteCollection->addDelete('delete', true);
        }

        return $resourceRouteCollection;
    }

    public function getResourceType(): string
    {
        return FaqsRestApiConfig::RESOURCE_FAQS;
    }

    public function getController(): string
    {
        return 'faqs-resource';
    }

    public function getResourceAttributesClassName(): string
    {
        return RestFaqsRequestAttributesTransfer::class;
    }
}
