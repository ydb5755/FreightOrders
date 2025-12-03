<?php

namespace FreightQuote\Bid\UseCases;

use FreightQuote\Bid\BidRepository;

class UpdateBid
{
    public function __construct(
        private BidRepository $bidRepo,
    ) {}

    public function execute(UpdateBidRequest $dto): void
    {
        $bid = $this->bidRepo->find($dto->bidId);
        $bid->setCost($dto->cost);
        $bid->setIsClosed($dto->isClosed);
        $bid->setNotes($dto->notes);
        $bid->setFileAttachments($dto->fileAttachments);
        $this->bidRepo->save($bid);
    }
}
