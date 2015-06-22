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
	<link rel="stylesheet" href="/css/app.css" />
<script>
FULL_BASE_URL = '<?= $this->request->webroot; ?>';
</script>
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
	<div layout="column" tabIndex="-1" role="main" flex>
		<md-toolbar>
			<div class="md-toolbar-tools" tabIndex="-1">
				<md-button class="menu" hide-gt-sm ng-click="toggleSidenav('left')" aria-label="Show left side nav">
					<md-icon md-svg-icon="menu"></md-icon>
				</md-button>
				<div layout="row" flex class="fill-height">
					<h2 class="md-toolbar-item md-breadcrumb">
						<span>{{page.title()}}</span>
					</h2>
				</div>
			</div>
		</md-toolbar>
		<md-content ng-view md-scroll-y flex class="md-padding"></md-content>
	</div>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,400italic">

	<script src="/bower_components/angular/angular.min.js"></script>
	<script src="/bower_components/angular-route/angular-route.min.js"></script>
	<script src="/bower_components/angular-resource/angular-resource.min.js"></script>
	<script src="/bower_components/angular-messages/angular-messages.min.js"></script>
	<script src="/bower_components/angular-animate/angular-animate.min.js"></script>
	<script src="/bower_components/angular-aria/angular-aria.min.js"></script>
	<script src="/bower_components/angular-material/angular-material.min.js"></script>

	<!-- add modules here -->
	<script src="/js/config/Config.js"></script>
	<script src="/js/config/Constants.js"></script>
	<script src="/js/config/Routes.js"></script>

	<script src="/js/auth/Auth.js"></script>
	<script src="/js/auth/provider/AuthFactory.js"></script>
	<script src="/js/auth/resource/UserResource.js"></script>
	
	<script src="/js/page/Page.js"></script>
	<script src="/js/page/provider/PageFactory.js"></script>
	<script src="/js/page/provider/NavFactory.js"></script>
	<script src="/js/page/controller/MainController.js"></script>
	<script src="/js/page/controller/LandingController.js"></script>
	<script src="/js/page/directive/FileUploadDirective.js"></script>

	<script src="/js/cycle/Cycle.js"></script>
	<script src="/js/cycle/resource/CycleResource.js"></script>
	<script src="/js/cycle/controller/CycleListController.js"></script>
	<script src="/js/cycle/controller/CycleCreateController.js"></script>

	<script src="/js/student/Student.js"></script>
	<script src="/js/student/controller/StudentImportController.js"></script>
	<script src="/js/student/provider/StudentFactory.js"></script>
	<script src="/js/student/resource/StudentResource.js"></script>

	<script src="/js/main.js"></script>
</body>
</html>
