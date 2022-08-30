<?php

namespace PyzTest\Zed\Faq\Business;

use Codeception\Test\Unit;
use Generated\Shared\DataBuilder\FaqBuilder;
use Generated\Shared\Transfer\FaqTransfer;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Zed
 * @group StringReverser
 * @group Business
 * @group Facade
 * @group StringReverserFacadeTest
 * Add your own group annotations below this line
 */
class FaqFacadeTest extends Unit
{
    /**
     * @var \PyzTest\Zed\Faq\FaqBusinessTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testStringIsReversedCorrectly(): void
    {
        // Arrange
        $stringReverserTransfer = (new FaqBuilder([
            'originalString' => 'Hello Spryker!'
        ]))->build();

        // Act
        //$stringReverserResultTransfer = $this->tester->getFacade()->setFactory(null);

        // Assert
        $this->assertSame('!rekyrpS olleH', $stringReverserTransfer->getVoteCount());
    }

}
