<?php

namespace AppBundle\Command;

use AppBundle\Schema\Schema;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * @author Christopher LOUËT.
 *
 */
class SchemaUpdateCommand extends ContainerAwareCommand
{
	const ENTITY_COMPETENCE = "Competence";
	const ENTITY_EXPERIENCE = "Experience";
	const ENTITY_FORMATION = "Formation";
	const ENTITY_PROFIL = "Profil";

	public static $entities = array (
		self::ENTITY_COMPETENCE,
		self::ENTITY_EXPERIENCE,
		self::ENTITY_FORMATION,
		self::ENTITY_PROFIL,
	);
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Console\Command\Command::configure()
	 */
	protected function configure()
	{
		$this
			->setName('app:schema:update')
			->setDescription('App schema update')
			->addArgument(
					'entity',
					InputArgument::OPTIONAL,
					'Entity to update ?'
			)
			->addOption(
					'all',
					null,
					InputOption::VALUE_NONE,
					'If set, update all entities'
			)
		;
	}

	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Console\Command\Command::execute()
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$updateAll = $input->getOption('all');
		
		if ($updateAll)
		{
			$this->updateEntities();
		}
		else
		{
			$entity = $input->getArgument('entity');
			if (!in_array($entity, self::$entities)) {
				throw new \InvalidArgumentException($this->getMsgInvalidArgument($entity));
			}
			$this->updateEntity($entity);
		}
	}
	
	/**
	 * Invalid argument message.
	 * 
	 * @param string $entity
	 * @return string
	 */
	private function getMsgInvalidArgument($entity)
	{
		$message = sprintf("%s is not a valid entity, existing entities :\n", $entity);
		foreach (self::$entities as $entityExist)
		{
			$message.= '- '.$entityExist."\n";
		}
		
		return $message;
	}
	
	/**
	 * Update all entities.
	 */
	private function updateEntities()
	{
		$appSchema = $this->getContainer()->get('app.schema');
		$appSchema->updateAll();
	}
	
	/**
	 * Update an entity.
	 * 
	 * @param string $entity
	 */
	private function updateEntity($entity)
	{
		$appSchema = $this->getContainer()->get('app.schema');
		
		switch ($entity)
		{
			case self::ENTITY_COMPETENCE:
				$appSchema->updateCompetence();
				break;
			case self::ENTITY_EXPERIENCE:
				$appSchema->updateExperience();
				break;
			case self::ENTITY_FORMATION:
				$appSchema->updateFormation();
				break;
			case self::ENTITY_PROFIL:
				$appSchema->updateProfil();
				break;
		}
	}

}