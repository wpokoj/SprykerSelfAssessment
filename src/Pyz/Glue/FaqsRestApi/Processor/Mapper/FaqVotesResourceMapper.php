<?php

namespace Pyz\Glue\FaqsRestApi\Processor\Mapper;

use Generated\Shared\Transfer\FaqVoteTransfer;
use Generated\Shared\Transfer\RestFaqVotesResponseAttributesTransfer;

class FaqVotesResourceMapper implements FaqVotesResourceMapperInterface {

    public function mapResource(FaqVoteTransfer $trans): RestFaqVotesResponseAttributesTransfer {

        return (new RestFaqVotesResponseAttributesTransfer())
            ->setVoted($trans->getVoted());
    }
}
