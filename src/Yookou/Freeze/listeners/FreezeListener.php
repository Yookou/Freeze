<?php

namespace Yookou\Freeze\listeners;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityItemPickupEvent;
use pocketmine\event\Event;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\server\CommandEvent;
use pocketmine\player\Player;
use Yookou\Freeze\Main;
use Yookou\Freeze\managers\FreezeManager;

class FreezeListener implements Listener {
	public function __construct(private readonly Main $plugin) {
	}

	public function onCommand(CommandEvent $event) : void {
		$this->onFreeze("listeners.command.on", "listeners.command.messageOn", "listeners.command.message", $event);
	}

	public function onPlayerMove(PlayerMoveEvent $event) : void {
		$this->onFreeze("listeners.move.on", "listeners.move.messageOn", "listeners.move.message", $event);
	}

	public function onPlayerDropItem(PlayerDropItemEvent $event) : void {
		$this->onFreeze("listeners.drop.on", "listeners.drop.messageOn", "listeners.drop.message", $event);
	}

	public function onPlayerInteract(PlayerInteractEvent $event) : void {
		$this->onFreeze("listeners.interact.on", "listeners.interact.messageOn", "listeners.interact.message", $event);
	}

	public function onEntityItemPickup(EntityItemPickupEvent $event) : void {
		$this->onFreeze("listeners.pickup.on", "listeners.pickup.messageOn", "listeners.pickup.message", $event);
	}

	public function onEntityDamage(EntityDamageEvent $event) : void {
		$this->onFreeze("listeners.damage.on", "listeners.damage.messageOn", "listeners.damage.message", $event);
	}

	public function onEntityDamageByEntityEvent(EntityDamageByEntityEvent $event) : void {
		$this->onFreeze("listeners.damage.on", "listeners.damage.messageOn", "listeners.damage.message", $event);
	}

	public function onBlockBreak(BlockBreakEvent $event) : void {
		$this->onFreeze("listeners.break.on", "listeners.break.messageOn", "listeners.break.message", $event);
	}

	public function onBlockPlace(BlockPlaceEvent $event) : void {
		$this->onFreeze("listeners.place.on", "listeners.place.messageOn", "listeners.place.message", $event);
	}

	private function onFreeze(string $eventOn, string $messageOn, string $message, Event $event) : void {
		if ($this->plugin->getConfig()->getNested($eventOn) !== true) {
			return;
		}
		if ($event instanceof CommandEvent) {
			$player = $event->getSender();
		} elseif (
			$event instanceof PlayerMoveEvent || $event instanceof PlayerDropItemEvent || $event instanceof PlayerInteractEvent || $event instanceof BlockBreakEvent || $event instanceof BlockPlaceEvent) {
			$player = $event->getPlayer();
		} elseif ($event instanceof EntityItemPickupEvent || $event instanceof EntityDamageEvent || $event instanceof EntityDamageByEntityEvent) {
			$player = $event->getEntity();
		} else {
			$this->plugin->getLogger()->error("Invalid event type");

			return;
		}

		if (!$player instanceof Player) {
			return;
		}

		if (!FreezeManager::getInstance()->isFreeze($player)) {
			return;
		}

		if ($this->plugin->getConfig()->getNested($messageOn) !== true) {
			return;
		}
		$player->sendMessage($this->plugin->getConfig()->getNested($message));
		$event->cancel();
	}
}
