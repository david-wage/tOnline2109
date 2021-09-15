<?php

namespace Unit2\CustomUrlRewriteCli\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UrlRewriteGeneratorCommand extends Command
{
    /**
     * @var \Magento\UrlRewrite\Model\UrlRewriteFactory
     */
    private $urlRewriteFactory;

    public function __construct(
        \Magento\UrlRewrite\Model\UrlRewriteFactory $urlRewriteFactory,
        string $name = null
    )
    {
        parent::__construct($name);
        $this->urlRewriteFactory = $urlRewriteFactory;
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('unit2:urlrewritegenerator');
        $this->setDescription('UrlRewriteGeneratorCommand');
        parent::configure();
    }

    /**
     * CLI command description
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $rewriteList = [
            // 'custom-page-<type>' => 'frontname/actionpath/actionclass',
             'custom-page-page.html' => 'results/demo/page',
             'custom-page-raw.html' => 'results/demo/raw',
             'custom-page-json.html' => 'results/demo/json',
             'custom-page-redirect.html' => 'results/demo/redirect',
             'custom-page-forward.html' => 'results/demo/forward',
        ];

        foreach ($rewriteList as $requestPath => $targetPath) {
            try {
                /** @var \Magento\UrlRewrite\Model\UrlRewrite  $urlRewriteModel */
                $urlRewriteModel = $this->urlRewriteFactory->create();
                $urlRewriteModel->setEntityType('custom')
                    ->setRequestPath($requestPath)
                    ->setTargetPath($targetPath)
                    ->setStoreId(1);
                $urlRewriteModel->save();
                $output->writeln($requestPath);
            } catch (\Exception $exception) {
                $output->writeln("Error: {$requestPath}");
            }
        }
        $output->writeln("DONE...!");
    }
}
