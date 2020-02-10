<?php

declare(strict_types=1);

namespace OCA\Polls\Migration;

use Doctrine\DBAL\Types\Type;
use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\IOutput;
use OCP\Migration\SimpleMigrationStep;

/**
 * create columns for consens voting in the oc_polls_polls table
 */
class Version0103Date20200210073237 extends SimpleMigrationStep {

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 * @return null|ISchemaWrapper
	 */
	public function changeSchema(IOutput $output, Closure $schemaClosure, array $options) {
		$schema = $schemaClosure();

        if ($schema->hasTable('polls_polls')) {
            $table = $schema->getTable('polls_polls');
            if (!$table->hasColumn('consens_vote')) {
                $table->addColumn('consens_vote', Type::INTEGER, [
                    'notnull' => true,
                    'default' => 0
                ]);
            }
        }

        return $schema;
	}
}
