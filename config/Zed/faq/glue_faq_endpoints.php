<?php


use Pyz\Glue\FaqsRestApi\FaqsRestApiConfig;

$config[FaqsRestApiConfig::RESOURCE_READ_FAQ_VOTES] = true;
$config[FaqsRestApiConfig::RESOURCE_FAQ_VOTES] = true;
$config[FaqsRestApiConfig::RESOURCE_READ_FAQS] = true;
$config[FaqsRestApiConfig::RESOURCE_FAQS] = false;

return $config;
