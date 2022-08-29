<?php

namespace Pyz\Glue\FaqsRestApi\Processor\FaqVotes\Reader;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqTransfer;
use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestFaqVotesRequestAttributesTransfer;
use Pyz\Client\FaqsRestApi\FaqsRestApiClientInterface;
use Pyz\Glue\FaqsRestApi\FaqsRestApiConfig;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FaqVotesReader implements FaqVotesReaderInterface {

    protected FaqsRestApiClientInterface $faqsRestApiClient;
    protected RestResourceBuilderInterface $restResourceBuilder;

    public function __construct(
        FaqsRestApiClientInterface $faqsRestApiClient,
        RestResourceBuilderInterface   $restResourceBuilder
    ){

        $this->faqsRestApiClient = $faqsRestApiClient;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    public function readVote(RestRequestInterface $restRequest): RestResponseInterface {

        $restResponse = $this->restResourceBuilder->createRestResponse();

        $res =
            $this->faqsRestApiClient->getUserVoteByFaqId(
                (new FaqVoteRequestTransfer())
            );

        if($res === null) {
            $restResponse->addError((new RestErrorMessageTransfer())
                ->setCode('Entity with given id not found')
                ->setStatus(404));

            return $restResponse;
        }

        $restResource = $this->restResourceBuilder->createRestResource(
            FaqsRestApiConfig::RESOURCE_FAQS,
            $res->getIdFaq(),
            $this->faqMapper->mapFaqDataToFaqRestAttributes($res)
        );
        $restResponse->addResource($restResource);

        return $restResponse;

    }

    public function readVotes(RestRequestInterface $restRequest): RestResponseInterface {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $voteCollectionTransfer =
            $this->faqsRestApiClient->getUserVotesCollection(
                (new FaqVoteCollectionTransfer())
                    ->setCustomerId(
                        $restRequest->getUser()->getSurrogateIdentifier()
                    )
            );


        foreach ($voteCollectionTransfer->getFaqs() as $faqTransfer) {
            $restResource = $this->restResourceBuilder->createRestResource(
                FaqsRestApiConfig::RESOURCE_FAQ_VOTES,
                $faqTransfer->getIdFaq(),
                $faqTransfer
            );
            $restResponse->addResource($restResource);
        }

        return $restResponse;
    }
}
