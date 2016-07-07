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
class SchemaCleanCommand extends ContainerAwareCommand
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
			->setName('app:schema:clean')
			->setDescription('App schema clean')
			->addArgument(
					'entity',
					InputArgument::OPTIONAL,
					'Entity to clean ?'
			)
			->addOption(
					'all',
					null,
					InputOption::VALUE_NONE,
					'If set, clean all entities'
			)
		;
	}

	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Console\Command\Command::execute()
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$cleanAll = $input->getOption('all');
		
		if ($cleanAll)
		{
			$this->cleanEntities();
		}
		else
		{
			$entity = $input->getArgument('entity');
			if (!in_array($entity, self::$entities)) {
				throw new \InvalidArgumentException($this->getMsgInvalidArgument($entity));
			}
			$this->cleanEntity($entity);
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
	 * Clean all entities.
	 */
	private function cleanEntities()
	{
		$appSchema = $this->getContainer()->get('app.schema');
		$appSchema->cleanAll();
	}
	
	/**
	 * Clean an entity.
	 * 
	 * @param string $entity
	 */
	private function cleanEntity($entity)
	{
		$appSchema = $this->getContainer()->get('app.schema');
		
		switch ($entity)
		{
			case self::ENTITY_COMPETENCE:
				$appSchema->cleanCompetence();
				break;
			case self::ENTITY_EXPERIENCE:
				$appSchema->cleanExperience();
				break;
			case self::ENTITY_FORMATION:
				$appSchema->cleanFormation();
				break;
			case self::ENTITY_PROFIL:
				$appSchema->cleanProfil();
				break;
		}
	}

}