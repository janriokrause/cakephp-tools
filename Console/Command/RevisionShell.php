<?php
App::uses('Shell', 'Console');

class RevisionShell extends Shell {

	public function getOptionParser() {
		return parent::getOptionParser()
			->description('Manage revisions')
			->addSubcommand('init', [
				'help' => 'Will create a current revision of all rows in given model, if none exist. Use this if you add the revision to a model that already has data in the database.',
				'parser' => [
					'arguments' => [
						'model' => [
							'help' => 'Model to process',
							'required' => true,
						],
						'limit' => [
							'help' => 'Number of rows to initialize in one run',
						],
					],
				],
			])
		;
	}

	public function init() {
		$model = $this->args[0];
		$limit = array_key_exists(1, $this->args) ? $this->args[1] : 100;

		$this->uses[] = $model;
		if($this->$model->initializeRevisions($limit)) {
			$this->out('Successfully initialized revisions.');
		} else {
			$this->out('Nothing todo.');
		}
	}

}
