<?php
namespace siebird\WatchTower;

use Craft;
use yii\base\Event;
use craft\base\Plugin;
use craft\commerce\elements\Order;
use craft\events\RegisterUrlRulesEvent;
use craft\helpers\UrlHelper;
use craft\web\UrlManager;

use siebird\WatchTower\base\PluginTrait;
use siebird\WatchTower\models\Settings;
use siebird\WatchTower\services\App;

use GuzzleHttp\Client;

class WatchTower extends Plugin
{

	use PluginTrait;

	public static $app;
	public static $plugin;
	public $hasCpSection 		= true;
	public $hasCpSettings 		= true;
    public static $pluginHandle = 'craft-watchtower';
	public $schemaVersion 		= '1.0.0';

	public function init()
	{
	    parent::init();
	    self::$plugin = $this;
	    self::$app = new App();

	    $this->_registerCpRoutes();
	    $this->_setPluginComponents();
	    $this->_registerEvents();
	}

	private function _registerCpRoutes()
    {
        Event::on(UrlManager::class, UrlManager::EVENT_REGISTER_CP_URL_RULES, function(RegisterUrlRulesEvent $event) {
            $event->rules = array_merge($event->rules, [
                'craft-watchtower' 				=> 'craft-watchtower/settings/general',
    			'craft-watchtower/settings' 	=> 'craft-watchtower/settings/general',
            ]);
        });
    }

	private function _registerEvents()
	{

	}

    public function getCpNavItem()
	{

	    $parent = parent::getCpNavItem();
	    $parent['label'] = $this->getSettings()->pluginName;
        $parent['url'] = 'craft-watchtower';

	    if($parent['label'] == "")
	    {
	    	$parent['label'] = "Watch Tower";
	    }

		return $parent;

	}

    protected function cpNavIconPath()
	{
	    $path = $this->getBasePath() . DIRECTORY_SEPARATOR . 'icon-mask.svg';
	    return is_file($path) ? $path : null;
	}

    protected function createSettingsModel(): Settings
	{
	    return new Settings();
	}

	public function getSettingsResponse()
    {
        Craft::$app->getResponse()->redirect(UrlHelper::cpUrl('craft-watchtower/settings'));
    }

	protected function afterInstall()
	{

	}

	public function beforeUninstall(): bool
	{
		return true;
	}

}