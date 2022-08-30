<?php

namespace Pyz\Glue\FaqsRestApi\Processor\FaqVotes\Writer;

use Generated\Shared\Transfer\FaqTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface FaqVotesWriterInterface {

    public function setVote(RestRequestInterface $restRequest): RestResponseInterface;
}
