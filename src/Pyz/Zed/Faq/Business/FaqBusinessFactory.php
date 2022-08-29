<?php

namespace Pyz\Zed\Faq\Business;

use Pyz\Zed\Faq\Business\Deleter\FaqDeleter;
use Pyz\Zed\Faq\Business\Deleter\FaqDeleterInterface;
use Pyz\Zed\Faq\Business\Deleter\VoteDeleter;
use Pyz\Zed\Faq\Business\Deleter\VoteDeleterInterface;
use Pyz\Zed\Faq\Business\Reader\FaqReader;
use Pyz\Zed\Faq\Business\Reader\FaqReaderInterface;
use Pyz\Zed\Faq\Business\Reader\VoteFinder;
use Pyz\Zed\Faq\Business\Reader\VoteFinderInterface;
use Pyz\Zed\Faq\Business\Updater\FaqUpdater;
use Pyz\Zed\Faq\Business\Updater\FaqUpdaterInterface;
use Pyz\Zed\Faq\Business\Writer\FaqWriter;
use Pyz\Zed\Faq\Business\Writer\FaqWriterInterface;
use Pyz\Zed\Faq\Business\Writer\VoteAdder;
use Pyz\Zed\Faq\Business\Writer\VoteAdderInterface;
use Pyz\Zed\Faq\Persistence\FaqEntityManager;
use Pyz\Zed\Faq\Persistence\FaqRepository;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

/**
 * @method FaqEntityManager getEntityManager()
 * @method FaqRepository getRepository()
 */
class FaqBusinessFactory extends AbstractBusinessFactory {

    public function createFaqDeleter(): FaqDeleterInterface {

        return new FaqDeleter($this->getEntityManager());
    }

    public function createFaqUpdater(): FaqUpdaterInterface {

        return new FaqUpdater($this->getEntityManager());
    }

    public function createFaqWriter(): FaqWriterInterface {

        return new FaqWriter($this->getEntityManager());
    }

    public function createFaqReader(): FaqReaderInterface {

        return new FaqReader($this->getRepository());
    }

    public function createVoteFinder(): VoteFinderInterface {

        return new VoteFinder($this->getRepository());
    }

    public function createVoteAdder(): VoteAdderInterface {

        return new VoteAdder($this->getEntityManager());
    }

    public function createVoteDeleter(): VoteDeleterInterface {

        return new VoteDeleter($this->getEntityManager());
    }
}
