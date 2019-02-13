# Symfony
Framework : grosse boîte à outils
-> des bloc indépendants qu’on peut utiliser séparément 

> installer l'extension php intelephent
> desinstaller l'extension intellisens

2 types de projets symfony : 
-  `skeleton` : element de base pour faire par ex une api 
-  `website-skeleton` : tous les outils pour faire un site (avec auth etc)


# Var_dumper
-> super var_dump qui affiche bcp plus d’informations qu’un var_dump

composer require/symfony/var_dumper
> pas de version = dernière version par **défaut** (majeur 4.0.0 donc va jusqu’a 4.9.9)

- **A ne pas installer sur le serveur de production !**
=> update
require --dev symfony/var_dumper

Ne pas toucher au dossier vendor

```php
*index.php*
require __DIR__ . '/vendor/autoload.php/';
```


# Installation :

- Dans un terminal :
 `composer create-project symfony/website-skeleton projetsymfony`
 > le nom du dossier sera projetsymfony

 - aller dans le répertoire du projet
`cd projetsymfony`
`code . ` => permet d'ouvrir vsCode directement dans le dossier

- Lancer le serveur 
`php bin/console server:run` : 
affichera
```
 [OK] Server listening on http://127.0.0.1:8000
```
- Aller sur le serveur http://127.0.0.1:8000/ (sur le navigateur) ou sur http://localhost:8000/

# Interface

 Il y a une barre de débug en bas pour voir les erreurs

 Commandes terminal indispensables : 
`php bin/console server:run` => lancer le serveur
`php bin/console` => afficher la console dans le terminal
`php bin/console debug:router` => afficher les routes et leur chemin


# Routes

YAML : format routes.yaml
permet de structurer
**Changer le space (passer de 2 à 4) SUPER IMPORTANT!**
**Ne pas mettre de TAB, c'est vraiment 4 spaces sinon ça marche pas** 

```yaml
 hello:
    path: /hello-world
    controller: App\Controller\HomeController::hello
```
=
ajout d'un nom à la route
path : le chemin 
utilisation du namespace :: la methode

```json
namespace : chemin virtuel pour placer toutes nos classes
On sait grâce au fichier composer.json que le namespace App pointe vers le dossier src.
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
```
> App = SRC

Exemple :
```php
namespace App\Controller;

class HomeController{
    public function hello() {
        return "hello";
    }
```
Symfony attend une response, hello doit retourner un objet de type response

On peut indiquer le type de retour de la méthode est une Response avec `method() : Response`. C'est une feature de PHP 7, qui est un prérequis à Laravel 4.

```php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController{
    public function hello() : Response {
        return new Response ('hello');
    }
```
> Cela importe automatiquement le use
> Il faut donc créer une response
> Response est donc un alias de Symfony\Component\HttpFoundation\Response
Le type Response est issu du composant HttpFoundation, qui permet d'ajouter une couche d'abstraction aux Requests et Response HTTP et les gérer pour nous
Comme il est long d'utiliser Symfony\Component\HttpFoundation\Response, si notre IDE est bien configuré, lorsque l'on précise que la méthode doit il devrait importer l'alias use Symfony\Component\HttpFoundation\Response afin de pouvoir utiliser l'alias Response directement.

Toutes les actions de routes doivent retourner un type Response (en effet, lorsque l'on saisit une URL, on attend bien une réponse HTTP !). On utilisera donc ce composant pour chaque action.

## Autre façon de faire une route : Annotation

/** => cela créer le bloc de commentaire
**Ne pas oublier le use** (Route) pour faire fonctionner la route Symfony\Component\Routing\Annotation\Route;
Attention le bloc de commentaire doit être collé à la fonction

Il n'y a pas de bonne pratique *annotation ou le fichier route yaml*

```php
use Symfony\Component\Routing\Annotation\Route;

    /**
    * @Route ("/apropos"), name="a propos")
    */
    public function apropos() : Response{
        return new Response('Page a propos');
    }
```

# TWIG

Installer l'extension Twig Language 2 (auteur : mblode)

1. Création d'un fichier home.html.twig dans le dossier templates
2. Rentrer les données voulu en insérant bien l'extends de la base twig

```twig
{% extends "base.html.twig" %}

{% block content %}

    <h1> Hello World </h1>

{% endblock %}
```
> block body a été renommé content
Du coup, on peut taper tout le HTML que l'on souhaite dans le block body

3. Donner acces  à la boite à outil

```php
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController{

    public function hello() : Response {
        return new Response ('hello');
    }
```
**AbstractController** Classe abstraite : classe parent qui ne sert pas à être utilisée en solo ; elle sert à donner des fonctions à ses classes enfants (exemple : HomeController)

Attention que le *USE* s'intègre bien

4. Utiliser la méthode render() qui permet d'afficher 

`render()` enfant de AbstractController qui aussi est enfant de ControllerTrait

```php
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController{

    public function hello() : Response {
        return $this->render('home.html.twig');
    }
```
>Décryptons la ligne `return $this->render('home.html.twig'))`; :
>
> `return` : nous allons retourner une vue. En fait, toujours un objet de type Response, qui va retourner du HTML via un template Twig
> `$this->render()` est issu du trait ControllerTrait, importé dans la classe abstraite AbstractController. Il permet d'effectuer le rendu de...
> `template.twig.html`, qui est un fichier template qui contient du HTML et du code Twig.

**On travaille dans base.html.twig car c'est notre template**
Si on veut un élément commun à toutes les pages => dans le fichier base.html.twig


*Attention* Les styles doivent se situer avant les blocks `{% block stylesheets %}{% endblock %}`, pareil pour le JS, il faut les mettre après le block content puis avant `{% block javascripts %}{% endblock %}`

# Liens

1. On utilise le chemin de la route :
```html
<a class="navbar-brand" href="{{path('user')}}">Amazon 2.0</a>
```

`{{path('user')}}` vient du nom de la route déterminée dans route.yaml ou depuis le `name` de la route créée en annotation  
```
/**
* @Route ("/apropos"), name="a propos")
*/
```

# Doctrine

Ca permet d'avoir une interface vers les tables AUTOMATIQUEMENT