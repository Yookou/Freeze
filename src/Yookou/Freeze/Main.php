<?php

namespace Yookou\Freeze;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use Yookou\Freeze\commands\FreezeCommand;
use Yookou\Freeze\commands\UnFreezeCommand;
use Yookou\Freeze\listeners\FreezeListener;

class Main extends PluginBase {
	use SingletonTrait;

	protected function onLoad() : void {
		self::setInstance($this);
		$this->saveDefaultConfig();
	}

	protected function onEnable() : void {
		$server = $this->getServer();
		$server->getPluginManager()->registerEvents(new FreezeListener($this), $this);
		$server->getCommandMap()->registerAll("Freeze", [
			new FreezeCommand(),
			new UnFreezeCommand()
		]);
	}
}
