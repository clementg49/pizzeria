** Installation:**

- git clone https://github.com/clementg49/pizzeria.git
- cd pizzeria
- docker-compose up
- docker exec -it pizzeria_php-apache-1 bash
- cd pizzeria
- make install
- accéder sur localhost:8003

**Context:**

L’application va permettre aux utilisateurs de gérer un petit catalogue de pizza ainsi que les
ingrédients nécessaires à leur cuisson. En outre, l’utilisateur doit pouvoir ajouter ou
supprimer des ingrédients à une pizza existante
● Ingrédient
○ nom
○ prix
● Pizza
○ nom
○ prix de vente
○ multitude d’ingrédients

 

Le prix de vente d’une pizza est égal au total du prix de ses ingrédients plus 50% du total
pour la préparation
Exemple
● SuperPizza
○ tomate 0.5 €
○ champignons 0.5€
○ feta 0.5€
○ saucisses 0.5€
○ onions 0.5€
○ mozzarella 0.5 €
○ origan 1 €
○ Total = 7.5€
