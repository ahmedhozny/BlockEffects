<?php

/*
 *  ____  _            _    ______  __  __          _
 * |  _ \| |          | |  |  ____|/ _|/ _|        | |
 * | |_) | | ___   ___| | _| |__  | |_| |_ ___  ___| |_ ___
 * |  _ <| |/ _ \ / __| |/ /  __| |  _|  _/ _ \/ __| __/ __|
 * | |_) | | (_) | (__|   <| |____| | | ||  __/ (__| |_\__ \
 * |____/|_|\___/ \___|_|\_\______|_| |_| \___|\___|\__|___/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * link: https://github.com/killer549/BlockEffects
*/

declare(strict_types=1);

namespace killer549\blockeffects;

use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class BlockEffects extends PluginBase implements Listener{

	private $config = [];

	public function onEnable(){
		@mkdir($this->getDataFolder());
		$this->saveDefaultConfig();
		$config = new Config($this->getDataFolder(). "config.yml", Config::YAML);
		if($config->get("enabled") !== false){
			$this->config = $config->getAll();
			$this->getServer()->getPluginManager()->registerEvents($this, $this);
		}else{
			$this->getLogger()->info("Disabled from the config");
			$this->getServer()->getPluginManager()->disablePlugin($this);
		}
	}

	public function onMoving(PlayerMoveEvent $ev): void{
		$player = $ev->getPlayer();
		$config = $this->config["blocks"];
		$block = $player->getLevel()->getBlock($ev->getPlayer()->floor()->subtract(0, 1));
		// TODO: Add additional block that gives players effect(s) if they are inside specific area.
		if(isset($config[$block->getId(). ":". $block->getDamage()])){
			$effectsArrays = $config[$block->getId(). ":". $block->getDamage()];
			foreach($effectsArrays as $effect){
				if(isset($effect["beneath"])){
					$beneath = $player->getLevel()->getBlock($ev->getPlayer()->floor()->subtract(0, 2));
					if($effect["beneath"] != $beneath->getId(). ":". $beneath->getDamage())continue;
				}

				if(!isset($effect["effect"]) or !isset($effect["duration"]))continue;

				$effectID = Effect::getEffect((int) $effect["effect"]);
				$duration = (int) $effect["duration"];
				$amplifier = isset($effect["amplifier"]) ? (int) $effect["amplifier"] : 0;
				$visible = isset($effect["visible"]) ? (bool) $effect["visible"] : false;
				$player->addEffect(new EffectInstance($effectID, $duration * 20, $amplifier, $visible));
			}
		}
	}
}