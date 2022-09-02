<?php

namespace Pyz\Shared\FaqsRestApi;

class FaqsRestApiConfig {

    protected array $conf;

    public function __construct() {
        $this->conf = require_once (APPLICATION_ROOT_DIR . '/config/Zed/faq/glue_faq_endpoints.php');
    }

    public function isEndpointEnabled(string $name): bool {
        return boolval($this->conf[$name] ?? false);
    }
}
