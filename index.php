<?php
session_start();

include_once("inc/autoload.php");
include_once("config/settings.php");

$appli 				= new OCFram\Application(
									new OCFram\Router(
										include_once("config/route.php")
									)
							);

$controller 	= $appli->getController();

$result 			= $controller->getResult();
$title 				= $controller->getTitle();
$body_class 	= $controller->getClass();
$vue 					= $controller->getView();
$layout 			= $controller->getLayout();

if(!is_null($layout)) include_once($layout);
