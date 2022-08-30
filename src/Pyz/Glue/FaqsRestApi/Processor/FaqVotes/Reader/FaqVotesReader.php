<?php

namespace Pyz\Glue\FaqsRestApi\Processor\FaqVotes\Reader;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqTransfer;
use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestFaqVotesRequestAttributesTransfer;
use Pyz\Client\FaqsRestApi\FaqsRestApiClientInterface;
use Pyz\Glue\FaqsRestApi\FaqsRestApiConfig;
use Pyz\Glue\FaqsRestApi\Processor\Mapper\FaqVotesResourceMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FaqVotesReader implements FaqVotesReaderInterface {

    protected FaqsRestApiClientInterface $faqsRestApiClient;
    protected RestResourceBuilderInterface $restResourceBuilder;
    protected FaqVotesResourceMapperInterface $faqVotesResourceMapper;

    public function __construct(
        FaqsRestApiClientInterface $faqsRestApiClient,
        RestResourceBuilderInterface   $restResourceBuilder,
        FaqVotesResourceMapperInterface $faqVotesResourceMapper
    ){

        $this->faqsRestApiClient = $faqsRestApiClient;
        $this->restResourceBuilder = $restResourceBuilder;
        $this->faqVotesResourceMapper = $faqVotesResourceMapper;
    }

    public function readVote(RestRequestInterface $restRequest): RestResponseInterface {

        $restResponse = $this->restResourceBuilder->createRestResponse();

        $res =
            $this->faqsRestApiClient->getUserVoteByFaqId(
                (new FaqVoteTransfer())
                    ->setIdCustomer($restRequest->getUser()->getSurrogateIdentifier())
            );

        if($res->getIdFaq() === null || $res->getVoted() === null) {
            return $restResponse
                ->addError((new RestErrorMessageTransfer())
                    ->setCode('Not found')
                    ->setStatus(404));
        }

        $restResource = $this->restResourceBuilder->createRestResource(
            FaqsRestApiConfig::RESOURCE_READ_FAQ_VOTES,
            $res->getIdFaq(),
            $this->faqVotesResourceMapper->mapResource($res)
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
                $this->faqVotesResourceMapper->mapResource($faqTransfer)
            );
            $restResponse->addResource($restResource);
        }

        return $restResponse;
    }
}
