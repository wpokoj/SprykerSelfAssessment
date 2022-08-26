<?php

namespace Pyz\Zed\Faq\Persistence;

use Orm\Zed\Planet\Persistence\PyzFaqQuery;
use Orm\Zed\Planet\Persistence\PyzFaqVote;
use Orm\Zed\Planet\Persistence\PyzFaqVoteQuery;

class FaqPersistenceFactory {

    public function createFaqQuery(): PyzFaqQuery {

        return new PyzFaqQuery();
    }

    public function createVoteQuery(): PyzFaqVoteQuery {

        return new PyzFaqVoteQuery();
    }
}
