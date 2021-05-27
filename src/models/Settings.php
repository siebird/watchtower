<?php
namespace siebird\WatchTower\models;

use Craft;
use craft\base\Model;
use craft\elements\Category;

class Settings extends Model
{

    public $pluginName 	      = 'Watch Tower';

    public function getSettingsNavItems()
    {

        $ret =  [
            'local' => [
                'label' => Craft::t('craft-watchtower', 'General Settings'),
                'url' => 'craft-watchtower',
                'action' => 'craft-watchtower/settings/save-general-settings',
                'selected' => 'local',
                'template' => 'craft-watchtower/_templates/general'
            ],
        ];

        return $ret;

    }

    public function rules()
    {
        return [
            [['pluginName'], 'required'],
        ];
    }

}