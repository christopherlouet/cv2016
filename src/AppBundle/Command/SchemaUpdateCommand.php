<?php

namespace AppBundle\Command;

use AppBundle\Schema\Schema;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class SchemaUpdateCommand.
 * @package AppBundle\Command
 * @author Christopher LOUËT.
 */
class SchemaUpdateCommand extends ContainerAwareCommand
{
    /**
     * Configure command.
     */
	protected function configure()
	{
		$this
			->setName('app:schema:update')
			->setDescription('App schema update')
		;
	}

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
	{
        $this->updateEntities();
	}

	/**
	 * Update all entities.
	 */
	private function updateEntities()
	{
        /** @var Schema $appSchema */
        $appSchema = $this->getContainer()->get('app.schema');
		$appSchema->updateAll();
	}
}