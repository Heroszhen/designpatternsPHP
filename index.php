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
use Strategy\{QuickSort,BubbleSort,MergeSort,ArrayRand};
use Facade\Facade;
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

	<div class="row justify-content-center mb-5" id="strategy">
		<div class="col-md-9 col-lg-7">
			<h2 class="text-center font-weight-bold">Strategie</h2>
			<div>
				<div class="mb-2">
					Ce patron de conception permet à un code client de sélectionner un algorithme à la volée en fonction de ses besoins. Il encapsule les algorithmes, ce qui permet de les utiliser à divers endroits de votre application, sans avoir à dupliquer le code.
				</div>
				<div>
					在软件开发中也常常遇到类似的情况，实现某一个功能有多种算法或者策略，我们可以根据环境或者条件的不同选择不同的算法或者策略来完成该功能。如查找、排序等，一种常用的方法是硬编码（Hard Coding）在一个类中，如需要提供多种查找算法，可以将这些算法写到一个类中，在该类中提供多个方法，每一个方法对应一个具体的查找算法；当然也可以将这些查找算法封装在一个统一的方法中，通过if…else…或者case等条件判断语句来进行选择。这两种实现方法我们都可以称之为硬编码，如果需要增加一种新的查找算法，需要修改封装算法类的源代码；更换查找算法，也需要修改客户端调用代码。在这个算法类中封装了大量查找算法，该类代码将较复杂，维护较为困难。如果我们将这些策略包含在客户端，这种做法更不可取，将导致客户端程序庞大而且难以维护，如果存在大量可供选择的算法时问题将变得更加严重。 如何让算法和对象分开来，使得算法可以独立于使用它的客户而变化？为此我们引入策略模式。 策略模式（Strategy），又叫算法簇模式，就是定义了不同的算法族，并且之间可以互相替换，此模式让算法的变化独立于使用算法的客户。 常见的使用场景比如对象筛选，可以根据日期筛选，也可以根据 ID 筛选；又比如在单元测试中，我们可以在文件和内存存储之间进行切换。
				</div>
			</div>
		</div>
		<div class="col-md-9 col-lg-7 mt-3">
			<div class="border border-primary rounded p-1">
				<div>
					On a plusieurs méthodes de tri, pour les utiliser sans modifier le code de la classe ArrayRand, on crée des classes de tri implémentant ISort.<br>
					Comme cela, on peut aussi créer d'autres méthodes de tri sans toucher à la classe ArrayRand.
				</div>
				<img src="photos/strategy.png" alt="">
			</div>
			<div class="font-weight-bold">
				//tri rapide<br>
				$qs = new QuickSort();<br>
				//tri à bulle<br>
				$bs = new BubbleSort();<br>
				//tri fusion<br>
				$ms = new MergeSort();<br>
				$ar = new ArrayRand($qs,10);<br>
				$ar->display();
			</div>
			<?php
				$qs = new QuickSort();
				$bs = new BubbleSort();
				$ms = new MergeSort();
				$ar = new ArrayRand($ms,10);
				$ar->display();
			?>
		</div>
	</div>

	<div class="row justify-content-center mb-5" id="facade">
		<div class="col-md-9 col-lg-7">
			<h2 class="text-center font-weight-bold">Facade</h2>
			<div>
				<div class="mb-2">
					Nous devons considérer l’utilisation du pattern Facade dans les cas où le code que nous voulons utiliser se compose de plusieurs classes et méthodes, et tout ce que nous voulons, c’est une interface simple, de préférence une méthode, qui peut faire tout le travail pour nous.
				</div>
				<div>
					门面模式，也叫外观模式。不管是门面还是外观，都是我们对外的媒介，就好像我们的脸面一样。所以，这个模式最大的特点就是要表现的“好看”。怎么说呢？一堆复杂的对象调用，自己都看蒙了，特别是对老系统进行升级维护的时候。用门面来把老系统的功能调用封装起来，在外面看来就和新系统一样，这就是门面模式的用途啦！
				</div>
			</div>
		</div>
		<div class="col-md-9 col-lg-7 mt-3">
			<div class="border border-primary rounded p-1">
				<div>
					Prenons les classes de Strategy, pour utiliser une méthode de tri, on était obligé d'instancier un ISort, un ArrayRand et d'appeler display().<br>
					Avec le pattern Facade, on stocke toutes ces instanciations dans la classe Facade.<br>
					Maintenant on instancie un seul objet - facade, puis appelle la méthode qu'on veut utiliser.
				</div>
				<img src="photos/facade.png" alt="">
			</div>
			<div class="font-weight-bold">
				$facade = new Facade();<br>
				$facade->BubbleSort(5);
			</div>
			<?php
				$facade = new Facade();
				$facade->BubbleSort(5);
			?>
		</div>
	</div>

</div>
<?php
	require_once "inc/footer.php";
?>