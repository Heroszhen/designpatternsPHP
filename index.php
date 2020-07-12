<?php
	//ini_set('display_errors', 'off');
	require_once "header.php";
	require_once "service.php";
?>
<div class="container" style="margin-top:56px;">
<?php
require_once "autoload.php";
use Singleton\Connect;
use Decorator\{Calculator,SubtractDecorator};
?>

	<div class="row justify-content-center mb-5" id="singleton">
		<div class="col-md-9 col-lg-7">
			<h2 class="text-center font-weight-bold">Singleton</h2>
			<div>
				<div class="mb-2">
					Ce patron de conception a pour objectif de restreindre l'instanciation d'une classe à un seul objet. Il est utile quand on veut être sûr de n'avoir qu'une seule instance d'une classe pendant tout le cycle de vie d'une requête dans une application web.
				</div>
				<div>
					通过单例模式可以保证系统中一个类只有一个实例而且该实例易于外界访问，从而方便对实例个数的控制并节约系统资源。如果希望在系统中某个类的对象只能存在一个，单例模式是最好的解决方案。
				</div>
			</div>
		</div>
		<div class="col-md-9 col-lg-7 mt-3">
			<div>
				<img src="photos/Singleton_pattern_uml.png" alt="">
			</div>
			<div class="font-weight-bold">
				$connect = Connect::getInstance();<br>
				$pdo = $connect->getPDO();
			</div>
			<?php
				$connect = Connect::getInstance();
				Service::dump($connect);
				$pdo = $connect->getPDO();
				Service::dump($pdo);
			?>
		</div>
	</div>

	<div class="row justify-content-center mb-5" id="decorator">
		<div class="col-md-9 col-lg-7">
			<h2 class="text-center font-weight-bold">Décorateur</h2>
			<div>
				<div class="mb-2">
					Le patron de conception Décorateur (Decorator) permet d'attacher dynamiquement des nouvelles responsabilités à un objet. Il s'agit d'une alternative souple à l'héritage. Il est utile lorsque l'on constate que l'ajout de fonctionnalités dans un projet peut s’avérer complexe.
				</div>
				<div>
					在不改变原始代码的情况下动态地给一个对象(不是类)添加功能。比如有一个计算器能做加法运算，在不改变其代码的状态下加入做减法运算的功能，这时便需要使用装饰器模式
				</div>
			</div>
		</div>
		<div class="col-md-9 col-lg-7 mt-3">
			<div>
				<div>
					La class Calculator implémentant IOperator ne fait que des additions comme opération, on veut en ajouter d'autre : multiplication,soustraction etc en évitant de modifier son code. Donc on crée SubtractDecorator qui hérite d'une classe abstraite - CalculatorDecorator. CalculatorDecorator implémente IOperator et reçoit un calculator comme attribut.<br>
					Si on souhaite ajouter une autre fonctionnalité, on fait pareil comme SubstratDecorator.
				</div>
				<img src="photos/decorator.png" alt="">
			</div>
			<div class="font-weight-bold">
				$cal = new Calculator();<br>
				$add = $cal->add(3,4);<br>
				$deco1 = new SubtractDecorator($cal);<br>
				$add = $deco1->add(3,4);<br>
				$sub = $deco1->other(3,4);//soustraction<br>
			</div>
			<?php
				$cal = new Calculator();
				$add = $cal->add(3,4);
				Service::dump($add);

				$deco1 = new SubtractDecorator($cal);
				$add = $deco1->add(3,4);
				Service::dump($add);
				$sub = $deco1->other(3,4);
				Service::dump($sub);
			?>
		</div>
	</div>

	<div class="row justify-content-center mb-5" id="decorator">
		<div class="col-md-9 col-lg-7">
			<h2 class="text-center font-weight-bold">Adaptateur</h2>
			<div>
				<div class="mb-2">
					Le pattern Adaptateur permet de convertir l'interface d'une classe en une autre interface que le client attend, sans modifier la classe elle-même. Il permet donc de faire travailler ensemble des classes qui normalement ne le pouvaient pas à cause d'interfaces incompatibles.

					Pour cela, l'adaptateur va fournir l'interface demandée par le client tout en continuant à utiliser l'interface d'origine. C'est utile par exemple quand vous voulez normaliser des anciennes classes, sans modifier leurs codes.
				</div>
				<div>
					将一个类的接口转换成可应用的兼容接口。适配器使原本由于接口不兼容而不能一起工作的那些类可以一起工作。
				</div>
			</div>
		</div>
		<div class="col-md-9 col-lg-7 mt-3">
			<div>
				<img src="photos/decorator.png" alt="">
			</div>
			<div class="font-weight-bold">
				$cal = new Calculator();<br>
				$add = $cal->add(3,4);<br>
				$deco1 = new SubtractDecorator($cal);<br>
				$add = $deco1->add(3,4);<br>
				$sub = $deco1->other(3,4);<br>
			</div>
			<?php
				$cal = new Calculator();
				$add = $cal->add(3,4);
				Service::dump($add);

				$deco1 = new SubtractDecorator($cal);
				$add = $deco1->add(3,4);
				Service::dump($add);
				$sub = $deco1->other(3,4);
				Service::dump($sub);
			?>
		</div>
	</div>

</div>
<?php
	require_once "footer.php";
?>