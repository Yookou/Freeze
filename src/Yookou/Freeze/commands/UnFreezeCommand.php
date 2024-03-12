<?php

namespace Yookou\Freeze\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use Yookou\Freeze\Main;
use Yookou\Freeze\managers\FreezeManager;

class UnFreezeCommand extends Command {
	public function __construct() {
		parent::__construct("unfreeze", "Freeze a player", "/unfreeze <player>");
		$this->setPermission(DefaultPermissions::ROOT_USER);
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args) {
		if (!$sender instanceof Player) {
			return;
		}

		if (!$sender->hasPermission(Main::getInstance()->getConfig()->get("permission"))) {
			return;
		}

		if (!isset($args[0])) {
			$sender->sendMessage($this->getUsage());

			return;
		}

		$target = Main::getInstance()->getServer()->getPlayerByPrefix($args[0]);

		if (!$target instanceof Player) {
			$sender->sendMessage(str_replace("{player}", $args[0], Main::getInstance()->getConfig()->get("player-not-found")));

			return;
		}

		FreezeManager::getInstance()->unfreezePlayer($target);
	}
}
