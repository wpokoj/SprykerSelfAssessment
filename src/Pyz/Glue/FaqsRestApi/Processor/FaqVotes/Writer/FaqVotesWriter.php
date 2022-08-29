<?php

namespace Pyz\Glue\FaqsRestApi\Processor\FaqVotes\Writer;

use Pyz\Client\FaqsRestApi\FaqsRestApiClientInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;

class FaqVotesWriter implements FaqVotesWriterInterface {

    protected FaqsRestApiClientInterface $faqsRestApiClient;
    protected RestResourceBuilderInterface $restResourceBuilder;

    public function __construct(
        FaqsRestApiClientInterface $faqsRestApiClient,
        RestResourceBuilderInterface   $restResourceBuilder
    ){

        $this->faqsRestApiClient = $faqsRestApiClient;
        $this->restResourceBuilder = $restResourceBuilder;
    }
}
