<?php

namespace Pyz\Glue\FaqsRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

/**
 * @method \Pyz\Shared\FaqsRestApi\FaqsRestApiConfig getSharedConfig()
 */
class FaqsRestApiConfig extends AbstractBundleConfig {

    public const RESOURCE_FAQS = 'faqs';
    public const RESOURCE_READ_FAQS = 'faqs-get';
    public const RESOURCE_FAQ_VOTES = 'faq-votes';
    public const RESOURCE_READ_FAQ_VOTES = 'faq-votes-get';


    public function isEndpointEnabled($name): bool {
        return $this->getSharedConfig()->isEndpointEnabled($name);
    }

}
