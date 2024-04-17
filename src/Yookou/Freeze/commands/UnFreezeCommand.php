<?php

namespace Yookou\Freeze\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;
use Yookou\Freeze\Main;
use Yookou\Freeze\managers\FreezeManager;

class UnFreezeCommand extends Command implements PluginOwned {
	public function __construct() {
		parent::__construct("unfreeze", "Freeze a player", "/unfreeze <player>");
		$this->setPermission("freeze.cmd");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args): void {
		if (!$sender instanceof Player) {
			return;
		}

		if (!$sender->hasPermission("freeze.cmd")) {
			return;
		}

		if (!isset($args[0])) {
			$sender->sendMessage($this->getUsage());

			return;
		}

        $owningPlugin = $this->getOwningPlugin();

		$target = $owningPlugin->getServer()->getPlayerByPrefix($args[0]);

		if (!$target instanceof Player) {
			$sender->sendMessage(str_replace("{player}", $args[0], $owningPlugin->getConfig()->get("player-not-found")));

			return;
		}

		FreezeManager::getInstance()->unfreezePlayer($target);
	}

    public function getOwningPlugin(): Main {
        return Main::getInstance();
    }
}
