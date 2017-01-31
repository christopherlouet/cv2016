<?php

namespace AppBundle\Command;

use AppBundle\Schema\Schema;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class SchemaCleanCommand.
 * @package AppBundle\Command
 * @author Christopher LOUËT.
 */
class SchemaCleanCommand extends ContainerAwareCommand
{
    /**
     * Configure command.
     */
	protected function configure()
	{
		$this
			->setName('app:schema:clean')
			->setDescription('App schema clean')
		;
	}

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
	{
        $this->cleanEntities();
	}

	/**
	 * Clean all entities.
	 */
	private function cleanEntities()
	{
        /** @var Schema $appSchema */
        $appSchema = $this->getContainer()->get('app.schema');
		$appSchema->cleanAll();
	}
}