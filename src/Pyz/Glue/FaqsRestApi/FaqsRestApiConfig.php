<?php

namespace Pyz\Glue\FaqsRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class FaqsRestApiConfig extends AbstractBundleConfig {

    //protected $sharedConfig;

    public function __construct() {
        //$config = require(APPLICATION_ROOT_DIR . '/config/Zed/faq/glue_faq_endpoints.php');

        //var_dump($config);
    }

    public const ENABLED = true;

    public const RESOURCE_FAQS = 'faqs';
    public const RESOURCE_READ_FAQS = 'faqs-get';
    public const RESOURCE_FAQ_VOTES = 'faq-votes';
    public const RESOURCE_READ_FAQ_VOTES = 'faq-votes-get';
}
