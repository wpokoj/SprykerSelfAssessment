<?php

namespace Pyz\Zed\FaqSearch\Business\Writer;

use Generated\Shared\Transfer\FaqTransfer;
use Orm\Zed\FaqSearch\Persistence\PyzFaqSearchQuery;
use Orm\Zed\Planet\Persistence\PyzFaqQuery;

class FaqSearchWriter {
    /**
     * @param int $id
     *
     * @return void
     */
    public function publish(int $id): void {
        $faqEntity = PyzFaqQuery::create()
            ->filterByIdFaq($id)
            ->findOne();

        $faqTransfer = new FaqTransfer();
        $faqTransfer->fromArray($faqEntity->toArray());

        $searchEntity = PyzFaqSearchQuery::create()
            ->filterByFkFaq($id)
            ->findOneOrCreate();

        $searchEntity->setFkFaq($id);
        $searchEntity->setData($faqTransfer->toArray());
        $searchEntity->save();
    }
}
