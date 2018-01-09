<?php

class JobeetCleanupTask extends sfBaseTask
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->addOptions([
            new sfCommandOption(
                'application',
                null,
                sfCommandOption::PARAMETER_REQUIRED,
                'The application',
                'frontend'
            ),
            new sfCommandOption(
                'env',
                null,
                sfCommandOption::PARAMETER_REQUIRED,
                'The environement',
                'prod'
            ),
            new sfCommandOption('days', null, sfCommandOption::PARAMETER_REQUIRED, '', 90)
        ]);

        $this->namespace = 'jobeet';
        $this->name = 'cleanup';
        $this->briefDescription = 'Cleanup jobeet database';
        $this->detailedDescription = <<<EOF
The [jobeet:cleanup|INFO] task cleans up the Jobeet database:

[./symfony jobeet:cleanup --env=prod --days=90|INFO]
EOF;

    }

    /**
     * @inheritdoc
     */
    protected function execute($arguments = [], $options = [])
    {
        $dm = new sfDatabaseManager($this->configuration);

        $nb = Doctrine_Core::getTable('JobeetJob')->cleanup($options['days']);
        $this->logSection('doctrine', sprintf('Removed %d stale jobs', $nb));
    }
}