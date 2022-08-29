<?php

namespace Pyz\Glue\FaqsRestApi\Controller;

use Pyz\Glue\FaqsRestApi\FaqsRestApiFactory;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method FaqsRestApiFactory getFactory()
 */
class FaqVotesResourceController extends AbstractController {


    public function getAction(RestRequestInterface $restRequest): RestResponseInterface {

        $reader = $this->getFactory()->createFaqVoteReader();

        if($restRequest->getResource()->getId() !== null) {
            return $reader->readVote($restRequest);
        }
        else {
            return $reader->readVotes($restRequest);
        }

    }

    public function postAction(RestRequestInterface $restRequest): RestResponseInterface {

        return $this->getFactory()->createFaqVoteWriter()->setVote($restRequest);
    }
}

