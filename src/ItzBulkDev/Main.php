<?php

namespace AppleEatingOnly;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener{

public function onEnable(){
		$this->getLogger()->info(TextFormat::LIGHT_PURPLE."ChaoticUHC: AEO Enabled!");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onDisable(){
		$this->getLogger()->info(TextFormat::LIGHT_PURPLE."ChaoticUHC: AEO Disabled!!");
	}
	
	
	//Apple Eating Only
	
	 public function onEat(PlayerItemConsumeEvent $event) {
    	$player = $event->getPlayer();
    	$config = $this->getConfig();
        if($item == "Apple"){
        	$player->sendMessage("");
	}else{
        	$event->setCancelled();
        	$player->sendMessage("[UHC] You are Only allowed to eat Apples!");
	}
	 }
	 
	 
	 //Sign Change
	 
    public function onSignChange(SignChangeEvent $event){
        $player = $event->getPlayer();
        if(strtolower(trim($event->getLine(0))) == "[UHC]" || strtolower(trim($event->getLine(0))) == "[uhc]"){
            if($player->hasPermission("1v1.all")){
		        $world = strtolower(trim($event->getLine(1)));
		        $p = count($this->getServer()->getLevelByName($world)->getPlayers());
                //Detects if its a uhc sign, changes lines
                $event->setLine(0,TextFormat::GREEN."[" . TextFormat::LIGHT_PURPLE . "[" . TextFormat::GOLD . "UHC" . TextFormat::BLUE . "]");
                $event->setLine(1,TextFormat::RED."MAP: " . TextFormat::GREEN . "$world");
                $event->setLine(2,TextFormat::BLUE."PLAYERS: " . TextFormat::GREEN . "" . $p . "/" . TextFormat::RED . "2");
                $event->setLine(3,TextFormat::LIGHT_PURPLE."[" . TextFormat::GREEN . "TAP");
                $player->sendMessage("§9§o[§a1v1§o§9] §6Sign §2Created!");
            }else{
                $player->sendMessage("§9§o[§a1v1§o§9] §4You don't have permission!");
                $event->setCancelled(true);
            }
        }
    }
    
    
    //Commands
    
    
	 
}

