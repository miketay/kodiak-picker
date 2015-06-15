<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html lang="en" ng-app="kodiak" ng-controller="MainController">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title ng-bind="page.title()">Kodiak Picker</title>
	<?= $this->Html->meta('icon') ?>

    <?= $this->fetch('meta') ?>
	<base href="<?= $this->request->webroot; ?>">

	<link rel="stylesheet" href="/bower_components/angular-material/angular-material.min.css" />
	<?= $this->Html->css('app.css') ?>

</head>
<body layout="row">
	<md-sidenav md-is-locked-open="$mdMedia('gt-sm')" class="site-sidenav md-sidenav-left md-whiteframe-z2" md-component-id="left">
		<md-toolbar>
			<h1 class="md-toolbar-tools">
				<a ng-href="/" layout="row" flex class="site-logo">
					<!--<md-icon md-svg-icon="logo" class="logo"></md-icon>-->
					<div class="site-logotype" layout="column" layout-align="center">Kodiak</div>
				</a>
			</h1>
		</md-toolbar>
		<md-content flex role="navigation">
			<md-list class="leftNav">
				<md-item ng-repeat="it in nav.items()">
					<md-button ng-click="select(it)" ng-class="{'selected': nav.selected(it)}">
						<md-icon md-svg-icon="{{it.icon}}" class=""></md-icon>
						{{it.text}}
					</md-button>
				</md-item>
			</md-list>
		</md-content>
	</md-sidenav>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,400italic">

	<script src="/bower_components/angular/angular.min.js"></script>
	<script src="/bower_components/angular-route/angular-route.min.js"></script>
	<script src="/bower_components/angular-resource/angular-resource.min.js"></script>
	<script src="/bower_components/angular-messages/angular-messages.min.js"></script>
	<script src="/bower_components/angular-animate/angular-animate.min.js"></script>
	<script src="/bower_components/angular-aria/angular-aria.min.js"></script>
	<script src="/bower_components/angular-material/angular-material.min.js"></script>

	<!-- add modules here -->
</body>
</html>
