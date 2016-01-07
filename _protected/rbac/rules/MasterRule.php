<?php
namespace app\rbac\rules;

use yii\rbac\Rule;

/**
 * Checks if authorID matches user passed via params
 */
class MasterRule extends Rule
{
    public $name = 'isMaster';

    public function execute($user, $item, $params)
    {
        return isset($params['auth_rule']) ? $params['auth_rule']->name == $user : false;
    }
}