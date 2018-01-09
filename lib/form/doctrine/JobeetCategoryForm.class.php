<?php

/**
 * JobeetCategory form.
 *
 * @package    jobeet
 * @subpackage form
 * @author     Vladimir Kuprienko
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class JobeetCategoryForm extends BaseJobeetCategoryForm
{
    /**
     * @inheritdoc
     */
    public function configure()
    {
      unset(
          $this['created_at'],
          $this['updated_at'],
          $this['jobeet_affiliates_list']
      );
    }
}
