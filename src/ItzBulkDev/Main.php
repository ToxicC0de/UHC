<?php

namespace AppleEatingOnly;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerItemConsumeEvent as onEat;

class Main extends PluginBase implements Listener{
	
	public $config;
        public $spawn;

public function onEnable(){
	@mkdir($this->getDataFolder());
 
        $this->config = new Config($this->getDataFolder() . "border.yml", Config::YAML, [
                "worldborder" => "on",
                        "message" => "§l§4[§6UHC§4] §4Stay In the area!",
                "worlds" => array()
        ]);
		$this->getLogger()->info(TextFormat::LIGHT_PURPLE."ChaoticUHC: AEO Enabled!");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onDisable(){
		$this->getLogger()->info(TextFormat::LIGHT_PURPLE."ChaoticUHC: AEO Disabled!!");
	}
	
	
	//Apple Eating Only
	
	 public function onEat(PlayerItemConsumeEvent $event) {
    	$player = $event->getPlayer();
    	$item = $event->getItem()->getName();
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
    
public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
		if($sender instanceof Player) {
			if(strtolower($command->getName('auto'))) {
				if(empty($args)) {
					$sender->sendMessage(TextFormat::RED."-----------------------------------------");
					$sender->sendMessage(TextFormat::GOLD."              UHC   Commands:                ");
					$sender->sendMessage(TextFormat::BLUE."- /uhc join [name]");
					$sender->sendMessage(TextFormat::BLUE."- /uhc list");
					$sender->sendMessage(TextFormat::RED"------------------------------------------");
          return true;
          }else{
          	if(count($args == 2)) {
          	if($args[0] == "join") {
          	foreach($sender as $ps)
	  	$p = count($this->getServer()->getLevelByName($gamename)->getPlayers());
	  	
          	$gamename = ($args[1]);
          	if(!isset($args[1])) {
			$sender->sendMessage(TextFormat::GREEN."[" . TextFormat::LIGHT_PURPLE . "UHC" . TextFormat::GREEN . "]" . TextFormat::GOLD . "Please Provide The Game Name\n" . TextFormat::GOLD . "Usage: /uhcjoin [name]");
			return true; 
				}else{
				if($args[1] == "UHC1" || $args[1] == "UHC2" || $args[1] == "UHC3" || $args[1] == "UHC4" || $args[1] == "UHC5"){
					$sender->sendPopup("§l§5Teleporting §aTo §6Match§9...");
					$sender->teleport(Server::getInstance()->getLevelByName($gamename)->getSafeSpawn());
					return true;
				}else{
					$sender->sendMessage("§9§o[§aUHC§o§9] §4§lGame: $gamename not found!\n§l§4Use /uhc list for a list of games!");
				}else{
					if($p == "2"){
					$sender->sendMesage("§9§o[§aUHC§o§9] §4Match Full!\n§9§o[§a1v1§o§9] §4Join another §4Match §4Or Wait");
					}
				}
		}
			}else{
				if($args[0] == "list") {
					$world1 = count($this->getServer()->getLevelByName("UHC1")->getPlayers());
					$world2 = count($this->getServer()->getLevelByName("UHC2")->getPlayers());
					$world3 = count($this->getServer()->getLevelByName("UHC3")->getPlayers());
					$world4 = count($this->getServer()->getLevelByName("UHC4")->getPlayers());
					$world5 = count($this->getServer()->getLevelByName("UHC5")->getPlayers());
					$sender->sendMessage(TextFormat::RED."-----------------------------------------");
					$sender->sendMessage(TextFormat::BLUE."- UHC1 : " . $world1 . "/2");
					$sender->sendMessage(TextFormat::BLUE."- UHC2 : " . $world3 . "/2");
					$sender->sendMessage(TextFormat::BLUE."- UHC3 : " . $world5 . "/2");
					$sender->sendMessage(TextFormat::BLUE."- UHC4 : " . $world7 . "/2");
					$sender->sendMessage(TextFormat::BLUE."- UHC5 : " . $world9 . "/2");
					$sender->sendMessage(TextFormat::RED."------------------------------------------");					
					return true; 
				}else{
				if($args[0] == "border") {
					 if(isset($args[0]) && isset($args[1])){
                        		 if($this->getServer()->isLevelLoaded($args[0])){
                                        	$world = in_array($args[0], $this->config->get("worlds"));
                                        	if($world){
                                                if(($key = array_search($args[0], $this->config->get("worlds"))) != false){
                                                        $worlds = $this->config->get("worlds");
                                                        unset($worlds[$key]);
                                                        $this->config->set("worlds", $worlds);
                                                }      
                                        }else{
                                                if((int)$args[1] <= 0){
                                                        return false;
                                                }else{
                                                        $sender->sendMessage("[UHC] You border world: ".$args[0]." in: ".$args[1]." blocks.");
                                                        $worlds = $this->config->get("worlds");
                                                        array_push($worlds, array($args[0] => $args[1]));
                                                        $this->config->set("worlds", $worlds);
                                                }
                                        }
                                        $this->config->save();
                                }else{
                                        $sender->sendMessage("[UHC] World doesn't exist.");
                                }
                        }else{
                                return false;
                        }
                }
				}
			}
          	}
          }
			}
		}else{
			$this->getLogger()->info(TextFormat::RED."RUN THIS COMMAND IN GAME!");
		}
}

        public function checkBorder($player){
                if($this->config->get("worldborder") == "on"){
                        $level = $this->getServer()->getLevelByName($player["level"]);
                        $t = new Vector2($player["x"], $player["z"]);
                        $s = new Vector2($level->getSpawn()->getX(), $level->getSpawn()->getZ());
                        $worlds = $this->config->get("worlds");
                        foreach($worlds as $key => $value){
                                if(!empty($value[$player["level"]])){
                                        $r = $value[$player["level"]];
                                }
                        }
                        if($t->distance($s) >= $r){
                                return true;
                        }else{
                                return false;
                        }
                }
        }
        



