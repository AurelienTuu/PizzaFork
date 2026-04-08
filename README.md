# Pizza Fork

## Création du projet codeIgniter4 :
```
composer create-project codeigniter4/appstarter PizzaFork
```

## Création des model : 
```
php spark make:model <nom du model>
```

## Création des controller : 
```
php spark make:controller <nom du controller>
```

## Création des view : 
```
php spark make:view <nom de la vue>
```

## Cas d'utilisation :
```plantuml
left to right direction
actor Administrateur
actor Utilisateur
package Pizza{
    Administrateur -- (Supprimer une pizza)
    Administrateur -- (Modifier une pizza)
    Administrateur -- (Ajouter une pizza)
}

package Ingrédient{
    Administrateur -- (Supprimer un ingrédient)
    Administrateur -- (Modifier un ingrédient)
    Administrateur -- (Ajouter un ingrédient)
}

package Pizzaria{
    Utilisateur -- (Payer)
    Utilisateur -- (Commander une pizza)
    Utilisateur -- (Ajouter des pizzas dans le panier)
    Utilisateur -- (Se déconnecter)
    Utilisateur -- (Se connecter)

}
```