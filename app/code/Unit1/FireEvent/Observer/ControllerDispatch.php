<?php
namespace Unit1\FireEvent\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;


class ControllerDispatch implements ObserverInterface
{
    /**
     * @var \Magento\Framework\Event\ManagerInterface
     */
    private $eventManager;
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;
    /**
     * @var \Magento\Framework\App\RouterListInterface
     */
    private $routerList;

    public function __construct(
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\App\RouterListInterface $routerList
    )
    {
        $this->eventManager = $eventManager;
        $this->logger = $logger;
        $this->routerList = $routerList;
    }
    public $count = 0;

    public function execute(Observer $observer)
    {
        foreach ($this->routerList as $router) {
            echo "<pre> EventObserver > ".get_class($router)."</pre>";
        }
        /*
        echo "<pre>{$this->count}</pre>";
        if($this->count < 1) {
            $this->count = 1;
            $params = [
                'controller_action' => $observer->getEvent()->getData('controller_action'),
                'request' => $observer->getEvent()->getData('request')];
            $this->eventManager->dispatch('controller_action_predispatch', $params);
        }*/

        $request = $observer->getEvent()->getData('request');
        echo "<pre>EventObserver" . $request->getFullActionName(). "</pre>";
        $this->logger->critical("EventObserver: " . $request->getFullActionName());
    }
}
