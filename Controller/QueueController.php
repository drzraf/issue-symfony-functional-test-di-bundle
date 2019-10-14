<?php

namespace MyBundle\Controller;

use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Signature;
use MyBundle\Entity\Synchronization;
use MyBundle\Service\DestinationRegistry;
use MyBundle\Service\ExpressionOverride;

class QueueController
{

    private $logger;
    private $em;
    private $exprOverride;
    private $destReg;

    public function __construct(
        LoggerInterface $logger,
        EntityManagerInterface $em,
        ExpressionOverride $exprOverride,
        DestinationRegistry $destReg
    ) {
        $this->logger = $logger;
        $this->em = $em;
        $this->exprOverride = $exprOverride;
        $this->destReg = $destReg;
    }
}
