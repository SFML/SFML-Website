# SFML et Python

!!! warning ""

    Vous lisez un tutoriel pour SFML 1.6, qui n'existe plus dans la dernière version. Consultez les [derniers tutoriels](/fr/tutorials/latest/).

## Introduction

Le but de ce tutoriel est de vous expliquer comment compiler / installer / utiliser le binding Python de SFML (qui est appelé **PySFML**).

## Installer les binaires PySFML

Afin d'utiliser PySFML, vous devez télécharger et installer l'archive contenant les fichiers de développement pour votre OS (SFML-x.x-python-dev-xxx). Celle-ci peut être trouvée sur la [page des téléchargements](../../../download/index.md "Aller sur la page des téléchargements"). Cette archive contient les binaires de PySFML qui peuvent être utilisés directement. Vous n'avez besoin de rien d'autre pour utiliser PySFML.

Après avoir extrait les fichiers de l'archive, copiez les fichiers vers votre installation de Python. Si vous ne savez pas où celle-ci se trouve, cela devrait être "C:\Python26" sous Windows ou "/usr/lib/python2.6" sous Linux.

Une fois les fichiers correctement installés, vous êtes prêts à utiliser PySFML.

## Installer le SDK PySFML

Installer le SDK de PySFML est optionnel, tout ce dont vous avez besoin pour faire tourner PySFML sont les fichiers de développement. Cependant, installer le SDK complet est recommandé particulièrement si vous faites vos premiers pas avec PySFML.

Tout d'abord, vous devez télécharger l'archive du SDK PySFML (SFML-x.x-python-sdk), qui peut être trouvée sur la [page des téléchargements](../../../download/index.md "Aller sur la page des téléchargements"). Cette archive contient le code source, la documentation, les exemples ainsi qu'un fichier de configuration pour compiler et installer PySFML.

Vous pouvez ensuite extraire les fichiers du SDK et profiter directement de la documentation et des programmes d'exemple.

Si vous souhaitez compiler PySFML à partir du code source, vous devez avoir les en-têtes et bibliothèques C++ de SFML dans le répertoire SFML-x.x (au même niveau que le répertoire "python"), et entrer la commande suivante :

```
python setup.py build
```

Sous Windows, cette commande utilise Visual C++ 2003 par défaut. Il est cependant possible de compiler avec MinGW, en ajoutant l'option "-cmingw32" :

```
python setup.py build -cmingw32
```

Puis vous pouvez installer les fichiers compilés, avec la commande suivante :

```
python setup.py install
```

Sous Linux vous devrez avoir les droits root pour installer les fichiers.

```
sudo python setup.py install
```

## Ecrire son premier programme avec PySFML

Contrairement aux bibliothèques C++, PySFML rassemble toutes les classes SFML dans un module unique ("sf"). Comme Python supporte les threads nativement, et qu'il possède des propres classes pour le réseau, seules les classes des modules système, fenêtrage, graphique et audio sont exposées dans PySFML.

Voici un morceau de code SFML très simple qui ouvre une fenêtre et y affiche du texte :

```
# On inclus l'extension PySFML
from PySFML import sf

# On crée la fenêtre principale
window = sf.RenderWindow(sf.VideoMode(800, 600), "PySFML test")

# On crée une chaîne graphique à afficher
text = sf.String("Hello SFML")

# On démarre la boucle de jeu
running = True
while running:
    event = sf.Event()
    while window.GetEvent(event):
        if event.Type == sf.Event.Closed:
            running = False

    # On efface l'écran, on affiche le texte, puis on met à jour la fenêtre
    window.Clear()
    window.Draw(text)
    window.Display()
```

La documentation pour PySFML est incluse au SDK. Si vous utilisez la version SVN, vous pouvez régénérer une documentation à jour en exécutant le script "doc_gen.py". Vous pouvez également obtenir la description détaillée d'une classe en tapant `help(sf.la_classe)` dans l'interpréteur. De plus, toutes les classes sont identiques à la version C++ et vous pouvez donc tout à fait utiliser la documentation complète ainsi que les tutoriels du site.

Le répertoire "samples" du SDK contient quelques démos utilisant PySFML, vous pouvez les essayer pour vous assurer que tout fonctionne correctement après compilation et/ou installation
