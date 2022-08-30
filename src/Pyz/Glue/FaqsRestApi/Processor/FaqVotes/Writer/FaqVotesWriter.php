<?php

namespace Pyz\Glue\FaqsRestApi\Processor\FaqVotes\Writer;

use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Pyz\Client\FaqsRestApi\FaqsRestApiClientInterface;
use Pyz\Glue\FaqsRestApi\FaqsRestApiConfig;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

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

    public function setVote(RestRequestInterface $restRequest): RestResponseInterface {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $trans = (new FaqVoteTransfer())
            ->fromArray(
                $restRequest->getResource()->getAttributes()->toArray(),
                true)
            ->setIdCustomer($restRequest->getUser()->getSurrogateIdentifier());


        $voteRes =
            $this->faqsRestApiClient->setUserVote($trans);


        return $restResponse
            ->addError((new RestErrorMessageTransfer())
                ->setStatus(201)
                ->setCode('Success'));
    }
}
