<?php

/**
 * JobeetJob form.
 *
 * @package    jobeet
 * @subpackage form
 * @author     Vladimir Kuprienko
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class JobeetJobForm extends BaseJobeetJobForm
{
    /**
     * @inheritdoc
     */
    public function configure()
    {
        $this->removeFields();

        // validators
        $this->validatorSchema['email'] = new sfValidatorAnd([
            $this->validatorSchema['email'],
            new sfValidatorEmail()
        ]);

        $this->validatorSchema['logo'] = new sfValidatorFile([
            'required' => false,
            'path' => sfConfig::get('sf_upload_dir') . '/jobs',
            'mime_types' => 'web_images',
        ]);

        // widgets
        $this->widgetSchema['type'] = new sfWidgetFormChoice([
            'choices' => Doctrine_Core::getTable('JobeetJob')->getTypes(),
            'expanded' => true,
        ]);

        $this->widgetSchema['logo'] = new sfWidgetFormInputFile(['label' => 'Company logo']);

        // labels
        $this->widgetSchema->setLabels([
            'category_id'   => 'Category',
            'is_public'     => 'Is public?',
            'how_to_apply'  => 'How to apply?',
        ]);

        // hints
        $this->widgetSchema->setHelp('is_public', 'Whether the job can also be published on affiliate websites or not.');
    }

    protected function removeFields()
    {
        unset(
            $this['created_at'],
            $this['updated_at'],
            $this['expires_at'],
            $this['is_activated'],
            $this['token']
        );
    }
}
