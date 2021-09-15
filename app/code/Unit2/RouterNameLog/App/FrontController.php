<?php

namespace Unit2\RouterNameLog\App;

use Magento\Framework\App\AreaList;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Request\ValidatorInterface as RequestValidator;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterListInterface;
use Magento\Framework\App\State;
use Magento\Framework\Message\ManagerInterface as MessageManager;
use Psr\Log\LoggerInterface;

class FrontController extends \Magento\Framework\App\FrontController
{
    public function __construct(
        RouterListInterface $routerList,
        ResponseInterface $response,
        ?RequestValidator $requestValidator = null,
        ?MessageManager $messageManager = null,
        ?LoggerInterface $logger = null,
        ?State $appState = null,
        ?AreaList $areaList = null
    ) {
        $this->logger = $logger ?? ObjectManager::getInstance()->get(LoggerInterface::class);
        parent::__construct($routerList, $response, $requestValidator, $messageManager, $logger, $appState, $areaList);
    }

    public function dispatch(RequestInterface $request)
    {
        foreach ($this->_routerList as $router) {
            echo "<pre>" . get_class($router). "</pre>";
            $this->logger->critical(get_class($router));
        }
        return parent::dispatch($request);
    }

}
