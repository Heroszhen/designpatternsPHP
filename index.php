<?php
	//ini_set('display_errors', 'off');
	require_once "inc/header.php";
	require_once "inc/service.php";
?>
<div class="container" style="margin-top:56px;">
<?php
require_once "autoload.php";
use Singleton\Connect;
use Decorator\{Calculator,SubtractDecorator};
use Adapter\{Book,EBook,EBookAdapter};
use Observer\{User,EditUser};
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
			<div class="border border-primary rounded p-1">
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
			<div class="border border-primary rounded p-1">
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

	<div class="row justify-content-center mb-5" id="adapter">
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
			<div class="border border-primary rounded p-1">
				<div>
					La class Book implémente IBook, la class EBook implémente IEBook.<br> 
					Maintenant on ne veut plus utiliser l'interface IBook, mais on veut garder la class Book en l'utilisant avec IEBook, donc on crée un adaptateur implémentant IEBook et reçevant un book de type IBook.<br>
					Comme cela la class Book peut fonctionner avec l'interface IEBook sans que son code soit modifié.
				</div>
				<img src="photos/adapter.png" alt="">
			</div>
			<div class="font-weight-bold">
				$book = new Book();<br>
				$book->read();<br>
				$book->turn();<br>
				$book->read();<br>

				$ebook = new EBook();<br>
				$ebook->display();<br>

				$ebookadapter = new EBookAdapter($book);<br>
				$ebookadapter->display();
			</div>
			<?php
				$book = new Book();
				$book->read();
				$book->turn();
				$book->read();

				$ebook = new EBook();
				$ebook->display();

				$ebookadapter = new EBookAdapter($book);
				$ebookadapter->display();
			?>
		</div>
	</div>

	<div class="row justify-content-center mb-5" id="observer">
		<div class="col-md-9 col-lg-7">
			<h2 class="text-center font-weight-bold">Observateur</h2>
			<div>
				<div class="mb-2">
					Ce patron de conception permet de limiter la dépendance entre les objets. Lorsqu'un événement précis se produit dans une application, il peut être nécessaire de lancer une ou plusieurs actions. Habituellement, toutes ces actions sont appelées à la suite dans une méthode.<br>
					Grâce à ce patron de conception, on va pouvoir séparer les différentes actions. Pour cela, on crée un objet qui va être observé. C'est lui qui va lancer l'alerte. Ensuite, on va créer plusieurs objets qui vont observer cet objet. Dès que l'alerte est donnée par l'objet observé, les objets observateurs vont lancer leur(s) action(s).
				</div>
				<div>
					观察者模式有时也被称作发布/订阅模式，该模式用于为对象实现发布/订阅功能：一旦主体对象状态发生改变，与之关联的观察者对象会收到通知，并进行相应操作。 PHP 为观察者模式定义了两个接口：SplSubject 和 SplObserver。SplSubject 可以看做主体对象的抽象，SplObserver 可以看做观察者对象的抽象，要实现观察者模式，只需让主体对象实现 SplSubject ，观察者对象实现 SplObserver，并实现相应方法即可。
				</div>
			</div>
		</div>
		<div class="col-md-9 col-lg-7 mt-3">
			<div class="border border-primary rounded p-1">
				<div>
					La classe User étant l'objet observé implémente SplSubject,<br> 
					la classe EditUser étant un observateur implémente SplObserver.<br>
					Lorsqu'on modifie les infos d'un user, on veut les enregistrer directement dans la bdd, <br>
					donc on insère l'observateur EditUser dans la liste dans User.<br>
					Une fois qu'on modifie l'user, l'action est déclenchée par l'observateur.<br>
					Si on a une autre action, on crée un autre observateur comme EditUser.
				</div>
				<img src="photos/observer.png" alt="">
			</div>
			<div class="font-weight-bold">
				//créer un observateur<br>
				$observer = new EditUser();<br>
				//créer un user<br> 
				$user = new User("Federer", "Roger", "aa@gmail.com"); <br>
				//enregistrer l'observateur dans la liste dans l'user<br>
				$user->attach($observer); <br>
				//modifier l'user et déclencher l'action<br>
				$user->update("aaa", "bbb", "ccc@gmail.com"); <br>
				$user->update("xxx", "yyy", "zzz@gmail.com");
			</div>
			<?php
				$observer = new EditUser();
				$user = new User("Federer","Roger","aa@gmail.com");
				$user->attach($observer);
				$user->update("aaa","bbb","ccc@gmail.com");
				$user->update("xxx","yyy","zzz@gmail.com");
			?>
		</div>
	</div>

</div>
<?php
	require_once "inc/footer.php";
?>