# SFML et Code::Blocks (MinGW)

## [Introduction](https://www.sfml-dev.org/tutorials/2.6/start-cb-fr.php#introduction)[](https://www.sfml-dev.org/tutorials/2.6/start-cb-fr.php#top "Haut de la page")

Ce tutoriel est le premier que vous devriez lire si vous utilisez SFML avec l'EDI Code::Blocks et le compilateur GCC (celui qui est livré avec par défaut). Il va vous expliquer comment configurer vos projets SFML.

## [Installer SFML](https://www.sfml-dev.org/tutorials/2.6/start-cb-fr.php#installer-sfml)[](https://www.sfml-dev.org/tutorials/2.6/start-cb-fr.php#top "Haut de la page")

Tout d'abord, vous devez télécharger le SDK SFML depuis la [page des téléchargements](https://www.sfml-dev.org/download-fr.php "Aller à la page des téléchargements").

Il existe plusieurs variantes de GCC pour Windows, qui sont incompatibles entre elles (différences au niveau de la gestion des exceptions, du modèle de threading, etc.). Assurez-vous de bien choisir le bon package, selon la version que vous utilisez. Si vous ne savez pas quelle est votre version, vous pouvez regarder dans le répertoire MinGW/bin lequel des fichiers libgcc_s_sjlj-1.dll ou libgcc_s_dw2-1.dll vous avez. Si vous utilisez la version de GCC qui vient avec Code::Blocks, alors il s'agit probablement d'une version SJLJ.  
Si vous pensez que votre version de GCC ne fonctionnera avec aucune des versions des bibliothèques SFML précompilées, n'hésitez pas à [recompiler SFML](https://www.sfml-dev.org/tutorials/2.6/compile-with-cmake-fr.php "Comment compiler SFML"), ce n'est pas compliqué.

Vous pouvez ensuite décompresser l'archive SFML où vous voulez. Copier les en-têtes et bibliothèques directement dans votre répertoire MinGW n'est pas conseillé, il vaut mieux laisser les bibliothèques à part dans leur coin, tout particulièrement si vous avez l'intention d'utiliser plusieurs versions d'une même bibliothèque, ou plusieurs compilateurs différents.

## [Créer et configurer un projet SFML](https://www.sfml-dev.org/tutorials/2.6/start-cb-fr.php#crceer-et-configurer-un-projet-sfml)[](https://www.sfml-dev.org/tutorials/2.6/start-cb-fr.php#top "Haut de la page")

La première chose à faire est de choisir quel type de projet créer. Code::Blocks propose une grande variété de types de projets, dont l'un est "SFML project". **Ne l'utilisez pas !** Il semble qu'il ne fonctionne tout simplement pas. Choisissez plutôt un projet vide (Empty project). Si vous voulez une application graphique sans console, allez dans les propriétés du projet, puis dans l'onglet "Build targets", et choisissez "GUI application" dans la liste déroulante au lieu de "Console application".

Nous devons maintenant indiquer au compilateur où trouver les en-têtes SFML (fichiers .hpp), et à l'éditeur de liens où trouver les bibliothèques SFML (fichiers .a).

Dans les "Build options" du projet, onglet "Search directories", ajoutez :

- Le chemin vers les en-têtes SFML (_<installation-de-sfml>/include_) aux chemins de recherche du compilateur (Compiler)
- Le chemin vers les bibliothèques SFML (_<installation-de-sfml>/lib_) aux chemins de recherche de l'éditeur de liens (Linker)

Ces chemins sont les mêmes dans les deux configurations (Debug et Release), vous pouvez donc les affecter globalement pour tout le projet.

![Capture d'écran de la boîte de dialogue pour configurer les chemins de recherche](https://www.sfml-dev.org/tutorials/2.6/images/start-cb-paths.png "Capture d'écran de la boîte de dialogue pour configurer les chemins de recherche")

L'étape suivante est de lier votre application aux bibliothèques SFML (fichiers .a) que votre code utilise. SFML est composée de 5 modules (système, fenêtrage, graphique, réseau et audio), et il y a une bibliothèque pour chacun.  
Les bibliothèques doivent être ajoutées aux propriétés du projet, dans l'onglet "Linker settings", dans la liste "Link libraries". Ajoutez toutes les bibliothèques SFML dont vous avez besoin, par exemple "sfml-graphics", "sfml-window" et "sfml-system" (le préfixe "lib" et l'extension ".a" doivent être omises).

![Capture d'écran de la boîte de dialogue pour configurer les bibliothèques du projet](https://www.sfml-dev.org/tutorials/2.6/images/start-cb-link-libs.png "Capture d'écran de la boîte de dialogue pour configurer les bibliothèques du projet")

Il est important de lier les bibliothèques qui correspondent à la configuration : "sfml-xxx-d" pour Debug, et "sfml-xxx" pour Release. Un mauvais mélange pourrait produire des crashs.

Lorsque vous liez à plusieurs bibliothèques SFML, assurez-vous de les lier dans le bon ordre, c'est très important pour GCC. La règle est que les bibliothèques qui dépendent d'autres doivent être ajoutées en premier dans la liste. Chaque bibliothèque SFML dépend de sfml-system, et sfml-graphics dépend aussi de sfml-window. Ainsi, le bon ordre pour ces trois bibliothèques serait : sfml-graphics, sfml-window, sfml-system -- comme dans la capture d'écran ci-dessus.

Les options montrées ici vont lier votre application à la version dynamique de SFML, celle qui a besoin des fichiers DLL pour fonctionner. Si vous voulez vous débarrasser de ces DLLs et avoir SFML directement intégrée à votre exécutable, vous devez lier à la version statique. Les bibliothèques statiques de SFML ont le suffixe "-s" : "sfml-xxx-s-d" en Debug et "sfml-xxx-s" en Release.  
Dans ce cas, vous devrez aussi définir la macro SFML_STATIC dans les options préprocesseur de votre projet.

![Capture d'écran de la boîte de dialogue pour définir la macro SFML_STATIC](https://www.sfml-dev.org/tutorials/2.6/images/start-cb-static.png "Capture d'écran de la boîte de dialogue pour définir la macro SFML_STATIC")

Depuis SFML 2.2, lors d'une liaison statique, il faut aussi lier toutes les dépendances de SFML. Par exemple: si vous liez à sfml-window-s ou sfml-window-s-d sur Windows, il faudra aussi lier à winmm, gdi32 et opengl32. Parfois ces bibliothèques seront listées sous "Inherited values" mais les ajouter une fois de plus ne devrait pas poser de problème.

Voici la liste des dépendances de chaque module; il faudra y ajouter -d pour lier les bibliothèques SFML de débogage.

|Module|Dépendences|
|---|---|
|`sfml-graphics-s`|- sfml-window-s<br>- sfml-system-s<br>- opengl32<br>- freetype|
|`sfml-window-s`|- sfml-system-s<br>- opengl32<br>- winmm<br>- gdi32|
|`sfml-audio-s`|- sfml-system-s<br>- openal32<br>- flac<br>- vorbisenc<br>- vorbisfile<br>- vorbis<br>- ogg|
|`sfml-network-s`|- sfml-system-s<br>- ws2_32|
|`sfml-system-s`|- winmm|

Il est important de remarquer que les modules de SFML peuvent dépendre les uns des autres. Par exemple, sfml-graphics-s dépend de sfml-window-s et de sfml-system-s. Si vous liez statiquement une bibliothèque SFML, soyez sûr de lier les dépendances de cette bibliothèque ainsi que les dépendances de ses dépendances. Si une partie de l'arbre de dépendances manque, il est _certain_ que vous aurez des erreurs de liaison.

De plus, puisque Code::Blocks utilise GCC, l'ordre de liaison est important. C'est à dire que les bibliothèques qui dépendent d'autres bibliothèques doivent être ajoutées _avant_ les bibliothèques desquels elles dépendent. Si cette règle n'est pas respectée, il est _certain_ que vous aurez des erreurs de liaison.

Si vous êtes un peu perdu, ne vous inquiétez pas. Il est parfaitement normal pour un débutant d'être submergé par toutes ces informations. Si quelque chose ne marche pas du premier coup, vous pouvez toujours essayer de vous rappeler de ce qu'il a été dit ci-dessus. Si vous n'y parvenez toujours pas, vous pouvez consulter la [FAQ](https://www.sfml-dev.org/faq.php#build-link-static "Visitez la page FAQ") ou le [forum](http://fr.sfml-dev.org/forums/index.php?board=25.0) pour trouver des astuces sur l'édition des liens statiques.

Si vous ne connaissez pas les différences entre les bibliothèques dynamiques (aussi appelées "partagées") et statiques, et ne savez pas lesquelles utiliser, vous pouvez faire une petite recherche sur Google, vous devriez trouver de bons articles/messages pour vous aider.

Votre projet est prêt, écrivons maintenant un peu de code pour voir si tout cela fonctionne. Ajoutez un fichier "main.cpp" à votre projet, avec le code suivant dedans :

```
#include <SFML/Graphics.hpp>

int main()
{
    sf::RenderWindow window(sf::VideoMode(200, 200), "SFML works!");
    sf::CircleShape shape(100.f);
    shape.setFillColor(sf::Color::Green);

    while (window.isOpen())
    {
        sf::Event event;
        while (window.pollEvent(event))
        {
            if (event.type == sf::Event::Closed)
                window.close();
        }

        window.clear();
        window.draw(shape);
        window.display();
    }

    return 0;
}
```

Compilez-le, et si vous avez lié la version dynamique de SFML, n'oubliez pas de copier les DLLs de SFML (qui se trouvent dans _<installation-de-sfml/bin>_) dans le répertoire où se trouve votre exécutable compilé. Puis lancez le programme, et si tout s'est bien passé vous devriez voir ceci :

![Capture d'écran de l'application Hello SFML](https://www.sfml-dev.org/tutorials/2.6/images/start-cb-app.png "Capture d'écran de l'application Hello SFML")

Si vous utilisez le module sfml-audio (que ce soit dynamiquement ou statiquement), vous devez aussi copier la DLL de bibliothèque externe dont il dépend, qui est OpenAL32.dll.  
Ces fichiers se trouvent également dans _<installation-de-sfml/bin>_.