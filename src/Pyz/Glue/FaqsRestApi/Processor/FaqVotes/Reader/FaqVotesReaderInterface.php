<?php

namespace Pyz\Glue\FaqsRestApi\Processor\FaqVotes\Reader;

use Generated\Shared\Transfer\FaqTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface FaqVotesReaderInterface {

    public function readVote(RestRequestInterface $restRequest): RestResponseInterface;
    public function readVotes(RestRequestInterface $restRequest): RestResponseInterface;
}
