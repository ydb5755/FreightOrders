<?php

namespace FreightQuote\Bid\UseCases;

use FreightQuote\Bid\BidRepository;
use InvalidArgumentException;

class GetBidForCarrier
{
    public function __construct(
        private BidRepository $bidRepo,
    ) {}

    /**
     * @throws InvalidArgumentException
     */
    public function execute(
        GetBidForCarrierRequest $dto,
    ): GetBidForCarrierResponse {
        $bid = $this->bidRepo->find($dto->id);
        if ($bid === null) {
            throw new InvalidArgumentException('Bid not found!');
        }
        if ($bid->isClosed() === true) {
            return new GetBidForCarrierResponse(
                isClosed: true,
                bid: null,
            );
        }
        if ($bid->getWasOpened() === false) {
            $bid->setWasOpened(true);
            $this->bidRepo->save($bid);
        }
        return new GetBidForCarrierResponse(
            isClosed: false,
            bid: $bid,
        );
    }
}
