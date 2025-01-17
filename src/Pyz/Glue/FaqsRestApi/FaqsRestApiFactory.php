<?php

namespace Pyz\Glue\FaqsRestApi;


use Pyz\Glue\FaqsRestApi\Processor\Faqs\Creator\FaqsCreator;
use Pyz\Glue\FaqsRestApi\Processor\Faqs\Creator\FaqsCreatorInterface;
use Pyz\Glue\FaqsRestApi\Processor\Faqs\Deleter\FaqsDeleter;
use Pyz\Glue\FaqsRestApi\Processor\Faqs\Deleter\FaqsDeleterInterface;
use Pyz\Glue\FaqsRestApi\Processor\Faqs\Reader\FaqsReader;
use Pyz\Glue\FaqsRestApi\Processor\Faqs\Reader\FaqsReaderInterface;
use Pyz\Glue\FaqsRestApi\Processor\Faqs\Updater\FaqsUpdater;
use Pyz\Glue\FaqsRestApi\Processor\Faqs\Updater\FaqsUpdaterInterface;
use Pyz\Glue\FaqsRestApi\Processor\FaqVotes\Reader\FaqVotesReader;
use Pyz\Glue\FaqsRestApi\Processor\FaqVotes\Reader\FaqVotesReaderInterface;
use Pyz\Glue\FaqsRestApi\Processor\FaqVotes\Writer\FaqVotesWriter;
use Pyz\Glue\FaqsRestApi\Processor\Mapper\FaqsResourceMapper;
use Pyz\Glue\FaqsRestApi\Processor\Mapper\FaqVotesResourceMapper;
use Pyz\Glue\FaqsRestApi\Processor\Mapper\FaqVotesResourceMapperInterface;
use Spryker\Glue\Kernel\AbstractFactory;


/**
 * @method \Pyz\Client\FaqsRestApi\FaqsRestApiClientInterface getClient()
 */
class FaqsRestApiFactory extends AbstractFactory{

    public function createFaqsResourceMapper(): FaqsResourceMapper
    {
        return new FaqsResourceMapper();
    }

    public function createFaqVotesResourceMapper(): FaqVotesResourceMapperInterface {
        return new FaqVotesResourceMapper();
    }

    public function createFaqsReader(): FaqsReaderInterface
    {
        return new FaqsReader(
            $this->getClient(),
            $this->getResourceBuilder(),
            $this->createFaqsResourceMapper()
        );
    }

    public function createFaqCreator(): FaqsCreatorInterface {

        return new FaqsCreator(
            $this->getClient(),
            $this->getResourceBuilder(),
        );
    }

    public function createFaqDeleter(): FaqsDeleterInterface {

        return new FaqsDeleter(
            $this->getClient(),
            $this->getResourceBuilder(),
        );
    }

    public function createFaqUpdater(): FaqsUpdaterInterface {

        return new FaqsUpdater(
            $this->getClient(),
            $this->getResourceBuilder(),
        );
    }

    public function createFaqVoteReader(): FaqVotesReaderInterface {

        return new FaqVotesReader(
            $this->getClient(),
            $this->getResourceBuilder(),
            $this->createFaqVotesResourceMapper(),
        );
    }

    public function createFaqVoteWriter(): FaqVotesWriter {

        return new FaqVotesWriter(
            $this->getClient(),
            $this->getResourceBuilder(),
        );
    }
}
