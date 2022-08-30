<?php

namespace Pyz\Glue\FaqsRestApi\Processor\Mapper;

use Generated\Shared\Transfer\FaqVoteTransfer;
use Generated\Shared\Transfer\RestFaqVotesResponseAttributesTransfer;

interface FaqVotesResourceMapperInterface {
    public function mapResource(FaqVoteTransfer $trans): RestFaqVotesResponseAttributesTransfer;
}
