<html lang="en">
<head>
<meta charset="utf-8">
<title>Robotique évolutionniste</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/these.css" rel="stylesheet">
  <link href="css/cv.css" rel="stylesheet">		
</HEAD>
<BODY >

<?php include ("menu.html")?>
		<div class="platform">



	      	
	      	<div class="main">  	
<H1 CLASS="section"><!--SEC ANCHOR --><A NAME="htoc1">1</A>  Robotique évolutionniste (ER)</H1><!--SEC END --><P>
<A NAME="section:ER"></A></P><P>Apparu dans les années 1990, l'objectif de la robotique évolutionniste
(<A HREF="#Harvey1992">Harvey and Husbands, 1992</A>,<A HREF="#Meyer1998">Meyer et al., 1998</A>,<A HREF="#Floreano2000a">Floreano and Nolfi, 2000</A>)(ou ER pour Evolutionary Robotics)
est de développer des méthodes de conception automatiques afin de créer des
contrôleurs pour robots autonomes,
effectuant des tâches dans des environnements non structurés et, ceci,
sans la nécessité que le contrôleur soit directement programmé par des
humains.
Cette approche repose sur l'idée d'utiliser des algorithmes évolutionnistes
afin d'optimiser des contrôleurs ou des morphologies pour des robots. </P><P>
Nous nous intéresserons ici à l'optimisation 
d'architecture de contrôle.</P><P>La robotique évolutionniste peut être formalisée en tant que 
problème d'optimisation. L'action <I>a</I> du robot est
est obtenue grâce à la formule suivante :
</P><TABLE CLASS="display dcenter"><TR VALIGN="middle"><TD CLASS="dcell"><I>a</I> = <I>g</I><SUB><I>x</I></SUB> (<I>p</I>(<I>t</I>) + <I>p</I>(<I>t</I>−1) + <I>p</I>(<I>t</I>−2) + ⋯ )</TD></TR>
</TABLE><P>où <I>a</I> ∈ ℝ<SUP><I>n</I></SUP>, <I>p</I>(<I>t</I>) correspond aux perceptions du robot
au temps <I>t</I> avec <I>p</I> ∈
ℝ<SUP><I>k</I></SUP> et <I>g</I><SUB><I>x</I></SUB>() correspond à l'architecture de contrôle.
Il s'agit donc de trouver <I>g</I><SUB><I>x</I></SUB>(.) minimisant <I>f</I>(<I>g</I><SUB><I>x</I></SUB>(.)) avec différentes
contraintes :
</P><TABLE CLASS="display dcenter"><TR VALIGN="middle"><TD CLASS="dcell"><I>h</I><SUB><I>j</I></SUB>(<I>g</I><SUB><I>x</I></SUB>(.)) ≤ 0, <I>j</I> = 1, 2, ⋯, <I>q</I></TD></TR>
</TABLE><TABLE CLASS="display dcenter"><TR VALIGN="middle"><TD CLASS="dcell"><I>l</I><SUB><I>j</I></SUB>(<I>g</I><SUB><I>x</I></SUB>(.)) = 0, <I>j</I> = 1, 2,  ⋯, <I>r</I></TD></TR>
</TABLE><P>d'ailleurs si 
</P><TABLE CLASS="display dcenter"><TR VALIGN="middle"><TD CLASS="dcell"><I>g</I><SUB><I>x</I></SUB> (<I>p</I>(<I>t</I>) + <I>p</I>(<I>t</I>−1) + <I>p</I>(<I>t</I>−3) + ⋯ = <I>g</I><SUB><I>x</I></SUB> (<I>p</I>(<I>t</I>)))</TD></TR>
</TABLE><P> 
le robot peut être considéré comme réactif car son action ne dépend pas 
des perceptions précédentes.</P><P>Nous allons nous intéresser dans cette section aux différentes types de tâches
qu'ont été réalisées via ER, pour des revues plus détaillées
voir (<A HREF="#Matari1996">Mataric and Cliff, 1996</A>,<A HREF="#Harvey1997">Harvey et al., 1997</A>,<A HREF="#Meyer1998">Meyer et al., 1998</A>,<A HREF="#Meeden1998">Meeden and Kumar, 1998</A>,<A HREF="#Floreano2000a">Floreano and Nolfi, 2000</A>,<A HREF="#Pratihar2003">Pratihar, 2003</A>,<A HREF="#Walker2003">Walker et al., 2003</A>,<A HREF="#Pfeifer2003">Pfeifer et al., 2003</A>,<A HREF="#Jin2005">Jin, 2005</A>,<A HREF="#Teo2005">Teo and Abbass, 2005</A>,<A HREF="#Nelson2007">Nelson and Grant, 2007</A>,<A HREF="#Nelson2009">Nelson et al., 2009</A>,<A HREF="#Doncieux2011a">Doncieux et al., 2011</A>). 
</P><P>De nombreuses tâches réalisées en ER sont souvent inspirées de comportements
d'animaux (voir tableau <A HREF="#table:ER_review">??</A>). Nous allons décrire
différentes catégories :
</P><UL CLASS="itemize"><LI CLASS="li-itemize">
tâches de navigation;
</LI><LI CLASS="li-itemize">tâches nécessitant un comportement cognitif minimal;
</LI><LI CLASS="li-itemize">tâches sensorimotrices intégrant une forme de mémoire;
</LI><LI CLASS="li-itemize">tâches intégrant un changement de règle de comportement.
</LI></UL><!--TOC subsection Tâches de navigation-->
<H2 CLASS="subsection"><!--SEC ANCHOR --><A NAME="htoc2">1.1</A>  Tâches de navigation</H2><!--SEC END --><!--TOC paragraph Tâches de locomotion ou d'évitement d'obstacles.-->
<H4 CLASS="paragraph"><!--SEC ANCHOR -->Tâches de locomotion ou d'évitement d'obstacles.</H4><!--SEC END --><P>
Tâches dans lesquelles les robots doivent évoluer afin d'être capables de se déplacer dans un environnement, tout en évitant des
obstacles statiques, voir même mobiles dans certains cas.
(<A HREF="#Lund1996">Lund and Miglino, 1996</A>), par exemple, proposent une tâche d'évitement d'obstacles utilisant un robot
Khepera. L'architecture est un simple réseau de neurones sans couche cachée.
Dans (<A HREF="#Schultz1996">Schultz et al., 1996</A>) un robot marcheur est optimisé afin d'éviter les
obstacles. Les contrôleurs sont d'abord évalués en simulation puis transférés
sur robot réel pour vérification. Le robot possède des capteurs infrarouges et
tactiles.</P><!--TOC paragraph Comportement phototaxique.-->
<H4 CLASS="paragraph"><!--SEC ANCHOR -->Comportement phototaxique.</H4><!--SEC END --><P>
Tâches où le robot doit détecter une source de lumière et se diriger vers elle.</P><P>Des contrôleurs capables de réaliser un comportement phototaxie dans un
environment contenant de nombreux obstacles ont été optimisés dans
(<A HREF="#Parker2006">Parker and Georgescu, 2006</A>). Un robot construit à partir de kits LEGO Mindstorm et
équipé de deux photodétecteurs et de capteur tactile à été utilisé.
(<A HREF="#Seok2000">Seok et al., 2000</A>) ont présenté l'évolution d'un comportement phototaxique et
d'évitement d'objets sur un robot équipé d'un sonar et de capteur de lumière.</P><!--TOC paragraph Recherche de nourriture avec dépose d'objets (<EM>foraging</EM>).-->
<H4 CLASS="paragraph"><!--SEC ANCHOR -->Recherche de nourriture avec dépose d'objets (<EM>foraging</EM>).</H4><!--SEC END --><P>
Dans ce type de tâche, le robot doit trouver des objets dans un environnement,
les ramasser, les porter vers un autre lieu et les déposer.
Nous pouvons citer comme exemple une tâche de ramassage de balles dans une
arène proposé par (<A HREF="#2010ACTI1525">Doncieux and Mouret, 2010</A>,<A HREF="#2011ACLI2061">Mouret and Doncieux, 2012</A>), où le robot doit effectuer une série de
sous-tâches : naviguer, trouver une balle, ramasser la balle, atteindre la
corbeille, relâcher la balle, …. 
Ce type de tâche est considéré comme une des tâches les
plus complexes en robotique évolutionniste (<A HREF="#Nelson2009">Nelson et al., 2009</A>), car elle
contient une séquence d'évènements qui n'est pas facilement réalisable avec un
système purement réflexif.</P><!--TOC paragraph Tâche de retour au nid.-->
<H4 CLASS="paragraph"><!--SEC ANCHOR -->Tâche de retour au nid.</H4><!--SEC END --><P>
Ici, le robot doit retourner dans son nid et la localisation de cet
emplacement n'est pas indiquée par une source de lumière et peut ne pas être
indiquée du tout.
(<A HREF="#Floreano1996">Floreano and Mondada, 1996</A>) ont optimisé un robot Khepera possédant des capteurs
infrarouges, des lumières, et des capteurs de niveau de batterie. L'objectif
de ce robot était d'être capable de se déplacer tout droit le plus rapidement
possible ainsi que de retourner à sa base afin de recharger ses batteries.
Le robot optimisé était capable d'intégrer de l'information sur
l'environnement et sur la consommation d'énergie afin de permettre au robot
de retourner à la station de recharge périodiquement, juste avant que son
niveau d'énergie tombe en dessous d'un seuil
critique.
(<A HREF="#vickerstaff2005evolved">Vickerstaff and Di Paolo, 2005a</A>,<A HREF="#vickerstaff2005evolving">Vickerstaff and Di Paolo, 2005b</A>) ont optimisé des robots
simulés (dotés de compas, de capteurs de vitesse et de capteurs de lumières)
pouvant exhiber un comportement de retour au nid. Les robots qui sont
initialement placés dans leur nid, sont sélectionnés pour leur capacité à
retourner au même endroit après avoir atteint un nombre variable de balises
lumineuses placées aléatoirement.</P><!--TOC subsection Tâches impliquant un comportement cognitif minimal-->
<H2 CLASS="subsection"><!--SEC ANCHOR --><A NAME="htoc3">1.2</A>  Tâches impliquant un comportement cognitif minimal</H2><!--SEC END --><P>Le terme de comportement cognitif minimal a été défini par (<A HREF="#Beer1996">Beer, 1996</A>).
Beer définit ce terme comme étant un compromis entre une tâche
assez complexe pour être "<EM>representation-hungry</EM>" (<A HREF="#Clark1998">Clark, 1997</A>) et soulever
des questions cognitivement intéressantes tout en restant assez simple dans 
le but d'être facilement analysable.
Un problème "<EM>representation-hungry</EM>" employé par (<A HREF="#Clark1998">Clark, 1997</A>)
représente les cas où il semble qu'il y a nécessité d'une représentation interne au sein d'un
contrôleur.</P><P>Pour illustrer ce comportement cognitif minimal, (<A HREF="#Beer1996">Beer, 1996</A>) a proposé une tâche
où un agent visuellement guidé a été optimisé pour s'orienter et atteindre des objets
tout en étant capable de discriminer différents objets. L'agent attrape les objets
circulaires et évite les objets en forme de losange (<A HREF="#beer2003dynamics">Beer, 2003</A>).</P><!--TOC subsection Tâches sensorimotrices intégrant une forme de mémoire-->
<H2 CLASS="subsection"><!--SEC ANCHOR --><A NAME="htoc4">1.3</A>  Tâches sensorimotrices intégrant une forme de mémoire</H2><!--SEC END --><P>
<A NAME="section:memory_task"></A></P><P>(<A HREF="#Gallagher1999">Gallagher, 1999</A>,<A HREF="#Slocum2000">Slocum and Downey, 2000</A>) proposent une 
extension du comportement cognitif minimal évoqué par (<A HREF="#Beer1996">Beer, 1996</A>). 
Dans leur tâche, le robot évolue pour être capable d'attraper des objets
tombant verticalement après avoir seulement brièvement observé sa position,
pour ensuite se déplacer vers le bon emplacement. </P><P><A NAME="para:roadsign"></A>
Une des premières tâches utilisées en robotique évolutionniste impliquant une
certaine forme de mémoire a été le problème de panneau de
signalisation (<A HREF="#ulbricht1996">Ulbricht, 1996</A>,<A HREF="#jakobi1997">Jakobi, 1997</A>,<A HREF="#Rylatt2000">Rylatt and Czarnecki, 2000</A>,<A HREF="#Linaker2001">Linaker and Jacobsson, 2001</A>,<A HREF="#Bergfeldt2002">Bergfeldt and Linaker, 2002</A>,<A HREF="#Blynel2003">Blynel and Floreano, 2003</A>,<A HREF="#Kim2004">Kim, 2004</A>,<A HREF="#Ziemke2002">Ziemke and Thieme, 2002</A>,<A HREF="#Ziemke2004">Ziemke et al., 2004</A>)
(<EM>"road-sign problem"</EM>).
Dans cette cette tâche le robot doit choisir une direction en fonction
d'un stimulus de départ, comme par exemple l'emplacement d'une source de
lumière. C'est une tâche à réponse différée (Delayed Response task, cf.
<A HREF="#section:delayedresponsetasks">??</A>),
habituellement considérée comme demandant une certaine forme de mémoire à court
terme puisque l'agent doit se souvenir durant une certaine période quel était
l'emplacement de la source de lumière.
Le problème de panneau de signalisation le plus simple consiste en un
labyrinthe en T (fig. <A HREF="#fig:simple_tmaze">??</A>) où le robot doit tourner à
gauche ou à droite en fonction de l'emplacement d'un stimulus situé au début du
corridor (<A HREF="#ulbricht1996">Ulbricht, 1996</A>,<A HREF="#jakobi1997">Jakobi, 1997</A>,<A HREF="#Linaker2001">Linaker and Jacobsson, 2001</A>).
Ce protocole a été utilisé dans différents cas : pour tester la capacité de généralisation au niveau
temporel (<A HREF="#ulbricht1996">Ulbricht, 1996</A>), pour éprouver la robustesse d'un contrôleur en
vue d'être transféré sur un robot réel (<A HREF="#jakobi1997">Jakobi, 1997</A>,<A HREF="#Koos2012">Koos et al., 2012</A>), dans des
versions étendues (<A HREF="#Linaker2001">Linaker and Jacobsson, 2001</A>,<A HREF="#Ziemke2002">Ziemke and Thieme, 2002</A>,<A HREF="#Ziemke2004">Ziemke et al., 2004</A>), ou comme tâche de
mémoire (<A HREF="#Ziemke2002">Ziemke and Thieme, 2002</A>,<A HREF="#Kim2004">Kim, 2004</A>).
</P><P>(<A HREF="#nolfi2002evolving">Nolfi, 2002</A>) a optimisé un robot Khepera simulé
capable de naviguer dans un environnement comportant deux pièces et
de déterminer dans quelle pièce il se trouve. 
Dans l'expérience décrite dans cet article, le robot ne pouvait
pas faire une méthode d'intégration de chemin, du fait que la position
de départ du robot était initialisée aléatoirement.
De plus, dans l'expérience, le robot se retrouvait dans des
états de capteurs identiques à différents endroits de l'environnement.
Il était donc nécessaire de discriminer le lieu en intégrant des informations 
à travers le temps.</P><P>Dans deux autres expériences proposées par (<A HREF="#nolfi1999extracting">Nolfi and Tani, 1999</A>,<A HREF="#tani1999learning">Tani and Nolfi, 1999</A>),
l'objectif est de déterminer comment des robots à roues – qui disposent de capteurs
de distance et se déplacent dans un environnement à plusieurs 
pièces – peuvent développer une capacité de prédire les états des capteurs à venir 
en segmentant les états des capteurs en catégories et en anticipant les catégories
des états des capteurs à venir.</P><P>Dans la tâche de (<A HREF="#Capi2005">Capi and Doya, 2005</A>), l'agent doit visiter alternativement
un emplacement où se trouve de la nourriture et un
autre où se trouve de l'eau, après avoir visité
son nid. L'agent doit apprendre des réponses
réactives de bas niveau afin d'atteindre le prochain 
emplacement récompensé tout en évitant les autres.
A plus haut niveau, l'agent doit sélectionner le prochain
but à visiter.
Cette tâche est présentée comme étant une tâche non-markoviennes séquentielles où la mémoire du précédent évènement ne peut pas déterminer la prochaine action.</P><P>(<A HREF="#Hartland2009">Hartland et al., 2009</A>) utilisent le peigne de Tolman (<A HREF="#Tolman1948">Tolman, 1948</A>). Celui-ci est composé d'un corridor
comportant de nombreuses branches s'ouvrant sur le même côté à intervalles
réguliers. L'objectif du robot est de tourner exclusivement dans
la troisième branche dans l'environnement. Cela impose au robot d'identifier un
contexte temporel, le seul permettant de distinguer les différentes branches.</P><!--TOC subsection Tâches intégrant un changement de règle de comportement-->
<H2 CLASS="subsection"><!--SEC ANCHOR --><A NAME="htoc5">1.4</A>  Tâches intégrant un changement de règle de comportement</H2><!--SEC END --><P>
Dans ce type de tâche, le comportement de l'agent dépend du contexte. En
fonction d'une entrée externe celui-ci doit changer son comportement. Comme
par exemple sur une tâche impliquant un comportement phototaxique où, en
fonction d'une récompense le robot doit éviter ou s'approcher d'une source de
lumière (<A HREF="#Meeden1995">Meeden, 1995</A>,<A HREF="#Ziemke1996">Ziemke, 1996</A>).</P><P>(<A HREF="#Maniadakis2009">Maniadakis and Tani, 2009</A>) et (<A HREF="#Maniadakis2010">Maniadakis et al., 2010</A>) proposent une extension du
"roadsign problem". Dans ce cas, la règle change durant l'expérience : 
soit le robot doit tourner du même côté que le stimulus visuel, soit il doit se
diriger du côté opposé.
Pour apprendre à tourner du bon côté du labyrinthe en T, l'agent reçoit un
signal de récompense ou de punition. Après un nombre aléatoire d'essais, la
règle change et l'agent doit être capable de s'adapter et à réapprendre à
tourner du bon côté.
C'est une tâche inspiré du tri de carte du Wisconsin étudiée chez différents
animaux comme chez l'homme ou chez les rats (<A HREF="#Joel1997">Joel et al., 1997</A>). </P><!--TOC subsection Synthèse-->

<H2 CLASS="subsection"><!--SEC ANCHOR --><A NAME="htoc6">1.5</A>  Synthèse</H2><!--SEC END --><P>Nous avons pu faire un bref aperçu de différentes tâches effectuées en
robotique évolutionniste. Parmi elles, un grand nombre de tâches sont
réactives et ne nécessitent donc pas nécessairement une forme de mémoire au
sein de l'agent. Parmi les tâches de mémoire, la tâche "panneau de
signalisation" fait partie des plus fréquemment utilisées. </P><!--TOC chapter Références-->
<H1 CLASS="chapter"><!--SEC ANCHOR -->Références</H1><!--SEC END --><DL CLASS="thebibliography"><DT CLASS="dt-thebibliography">
<A NAME="Banzhaf1997"><FONT COLOR=purple>[Banzhaf et al., 1997]</FONT></A></DT><DD CLASS="dd-thebibliography">
Banzhaf, W., Nordin, P., and Olmer, M. (1997).
Generating Adaptive Behavior using Function Regression within
Genetic Programming and a Real Robot.
<EM>Evolutionary Computation</EM>, pages 1–13.</DD><DT CLASS="dt-thebibliography"><A NAME="Barlow2005"><FONT COLOR=purple>[Barlow et al., 2005]</FONT></A></DT><DD CLASS="dd-thebibliography">
Barlow, G., Mattos, L., Grant, E., and Oh, C. (2005).
Transference of Evolved Unmanned Aerial Vehicle Controllers to a
Wheeled Mobile Robot.
<EM>Proceedings of the 2005 IEEE International Conference on
Robotics and Automation</EM>, pages 2087–2092.</DD><DT CLASS="dt-thebibliography"><A NAME="Beer1996"><FONT COLOR=purple>[Beer, 1996]</FONT></A></DT><DD CLASS="dd-thebibliography">
Beer, R. D. (1996).
Toward the evolution of dynamical neural networks for minimally
cognitive behavior.
<EM>From animals to animats</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="beer2003dynamics"><FONT COLOR=purple>[Beer, 2003]</FONT></A></DT><DD CLASS="dd-thebibliography">
Beer, R. D. (2003).
The dynamics of active categorical perception in an evolved model
agent.
<EM>Adaptive Behavior</EM>, 11(4):209–243.</DD><DT CLASS="dt-thebibliography"><A NAME="Bergfeldt2002"><FONT COLOR=purple>[Bergfeldt and Linaker, 2002]</FONT></A></DT><DD CLASS="dd-thebibliography">
Bergfeldt, N. and Linaker, F. (2002).
Self-organized modulation of a neural robot controller.
In <EM>Proceedings of the International Joint Conference on Neural
Networks, Hawaii</EM>, volume pages, pages 495–500. Citeseer.</DD><DT CLASS="dt-thebibliography"><A NAME="Blynel2003"><FONT COLOR=purple>[Blynel and Floreano, 2003]</FONT></A></DT><DD CLASS="dd-thebibliography">
Blynel, J. and Floreano, D. (2003).
Exploring the T-maze: Evolving learning-like robot behaviors using
CTRNNs.
<EM>Lecture notes in computer science</EM>, pages 593–604.</DD><DT CLASS="dt-thebibliography"><A NAME="Boeing2004"><FONT COLOR=purple>[Boeing et al., 2004]</FONT></A></DT><DD CLASS="dd-thebibliography">
Boeing, A., Hanham, S., and Braunl, T. (2004).
Evolving autonomous biped control from simulation to reality.
<EM>on Autonomous Robots</EM>, 445(6):440–445.</DD><DT CLASS="dt-thebibliography"><A NAME="Capi2005"><FONT COLOR=purple>[Capi and Doya, 2005]</FONT></A></DT><DD CLASS="dd-thebibliography">
Capi, G. and Doya, K. (2005).
Evolution of recurrent neural controllers using an extended parallel
genetic algorithm.
<EM>Robotics and Autonomous Systems</EM>, 52:148–159.</DD><DT CLASS="dt-thebibliography"><A NAME="Chemova2004"><FONT COLOR=purple>[Chemova and Veloso, 2004]</FONT></A></DT><DD CLASS="dd-thebibliography">
Chemova, S. and Veloso, M. (2004).
An evolutionary approach to gait learning for four-legged robots.
<EM>2004 IEEE/RSJ International Conference on Intelligent Robots and
Systems (IROS)</EM>, pages 2562–2567.</DD><DT CLASS="dt-thebibliography"><A NAME="Clark1998"><FONT COLOR=purple>[Clark, 1997]</FONT></A></DT><DD CLASS="dd-thebibliography">
Clark, A. (1997).
<EM>Being there: Putting brain, body, and world together again</EM>.
MIT press.</DD><DT CLASS="dt-thebibliography"><A NAME="2010ACTI1525"><FONT COLOR=purple>[Doncieux and Mouret, 2010]</FONT></A></DT><DD CLASS="dd-thebibliography">
Doncieux, S. and Mouret, J.-B. (2010).
Behavioral diversity measures for Evolutionary Robotics.
In <EM>Proceedings of IEEE-CEC'10</EM>, pages 1303–1310.</DD><DT CLASS="dt-thebibliography"><A NAME="Doncieux2011a"><FONT COLOR=purple>[Doncieux et al., 2011]</FONT></A></DT><DD CLASS="dd-thebibliography">
Doncieux, S., Mouret, J.-B., Bredeche, N., and Padois, V. (2011).
<EM>Evolutionary Robotics: Exploring New Horizons</EM>, pages 3–25.
Springer.</DD><DT CLASS="dt-thebibliography"><A NAME="Earon2000"><FONT COLOR=purple>[Earon and Barfoot, 2000]</FONT></A></DT><DD CLASS="dd-thebibliography">
Earon, E. J. P. and Barfoot, T. D. (2000).
From the Sea to the Sidewalk: The Evolution of Hexapod Walking Gaits
by a Genetic Algorithm.
<EM>Evolvable Systems: From Biology to Hardware</EM>, pages 51–60.</DD><DT CLASS="dt-thebibliography"><A NAME="Ebner1998"><FONT COLOR=purple>[Ebner and Zell, 1998]</FONT></A></DT><DD CLASS="dd-thebibliography">
Ebner, M. and Zell, A. (1998).
Evolving a behavior-based control architecture - From simulations to
the real world.
In <EM>GECCO</EM>, pages 13—-17.</DD><DT CLASS="dt-thebibliography"><A NAME="Filliat1999"><FONT COLOR=purple>[Filliat et al., 1999]</FONT></A></DT><DD CLASS="dd-thebibliography">
Filliat, D., Kodjabachian, J., and Meyer, J.-A. (1999).
Incremental evolution of neural controllers for navigation in a
6-legged robot.
<EM>on Artificial Life and Robots</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Floreano1996"><FONT COLOR=purple>[Floreano and Mondada, 1996]</FONT></A></DT><DD CLASS="dd-thebibliography">
Floreano, D. and Mondada, F. (1996).
Evolution of homing navigation in a real mobile robot.
<EM>Systems, Man, and Cybernetics, Part</EM>, 26(3):396–407.</DD><DT CLASS="dt-thebibliography"><A NAME="Floreano2000a"><FONT COLOR=purple>[Floreano and Nolfi, 2000]</FONT></A></DT><DD CLASS="dd-thebibliography">
Floreano, D. and Nolfi, S. (2000).
<EM>Evolutionary Robotics: The Biology, Intelligence, and
Technology of Self-Organizing Machines</EM>.
Bradford Book.</DD><DT CLASS="dt-thebibliography"><A NAME="Floreano2000"><FONT COLOR=purple>[Floreano and Urzelai, 2000]</FONT></A></DT><DD CLASS="dd-thebibliography">
Floreano, D. and Urzelai, J. (2000).
Evolutionary robots with on-line self-organization and behavioral
fitness.
<EM>Neural networks : the official journal of the International
Neural Network Society</EM>, 13(4-5):431–43.</DD><DT CLASS="dt-thebibliography"><A NAME="Gallagher1999"><FONT COLOR=purple>[Gallagher, 1999]</FONT></A></DT><DD CLASS="dd-thebibliography">
Gallagher, J. (1999).
Evolution and analysis of dynamical neural networks for agents
integrating vision, locomotion, and short-term memory.
In <EM>Proceedings of the Genetic and Evolutionary</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Gomi1998"><FONT COLOR=purple>[Gomi and Ide, 1998]</FONT></A></DT><DD CLASS="dd-thebibliography">
Gomi, T. and Ide, K. (1998).
Evolution of gaits of a legged robot.
<EM>1998 IEEE International Conference on Fuzzy Systems Proceedings.
IEEE World Congress on Computational Intelligence (Cat. No.98CH26228)</EM>, pages
159–164.</DD><DT CLASS="dt-thebibliography"><A NAME="Hartland2009"><FONT COLOR=purple>[Hartland et al., 2009]</FONT></A></DT><DD CLASS="dd-thebibliography">
Hartland, C., Bredeche, N., and Sebag, M. (2009).
Memory-enhanced evolutionary robotics: the echo state network
approach.
In <EM>In proc. of IEEE-CEC'09</EM>, number section IV, pages
2788–2795.</DD><DT CLASS="dt-thebibliography"><A NAME="Harvey1992"><FONT COLOR=purple>[Harvey and Husbands, 1992]</FONT></A></DT><DD CLASS="dd-thebibliography">
Harvey, I. and Husbands, P. (1992).
Evolutionary robotics.
In <EM>Proceedings of IEE Colloquium on Genetic Algorithms for
Control Systems Engineering</EM>, pages 1–4.</DD><DT CLASS="dt-thebibliography"><A NAME="Harvey1994"><FONT COLOR=purple>[Harvey et al., 1994]</FONT></A></DT><DD CLASS="dd-thebibliography">
Harvey, I., Husbands, P., and Cliff, D. (1994).
<EM>Seeing The Light: Artificial Evolution A Real Vision</EM>.
Number April. School of Cognitive and Computing Sciences, University
of Sussex.</DD><DT CLASS="dt-thebibliography"><A NAME="Harvey1997"><FONT COLOR=purple>[Harvey et al., 1997]</FONT></A></DT><DD CLASS="dd-thebibliography">
Harvey, I., Husbands, P., Cliff, D., and Thompson, A. (1997).
Evolutionary robotics: the Sussex approach.
<EM>Robotics and autonomous systems</EM>, 20:205–224.</DD><DT CLASS="dt-thebibliography"><A NAME="Hoffmann1996"><FONT COLOR=purple>[Hoffmann and Pfister, 1996]</FONT></A></DT><DD CLASS="dd-thebibliography">
Hoffmann, F. and Pfister, G. (1996).
Evolutionary learning of a fuzzy control rule base for an autonomous
vehicle.
<EM>Management of Uncertainty in Knowledge-Based</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Hornby2001"><FONT COLOR=purple>[Hornby and Lipson, 2001]</FONT></A></DT><DD CLASS="dd-thebibliography">
Hornby, G. S. and Lipson, H. (2001).
Evolution of generative design systems for modular physical robots.
In <EM>Robotics and Automation, 2001. Proceedings 2001 ICRA. IEEE
International Conference on</EM>, pages 4146—-4151.</DD><DT CLASS="dt-thebibliography"><A NAME="Hornby2005a"><FONT COLOR=purple>[Hornby et al., 2005]</FONT></A></DT><DD CLASS="dd-thebibliography">
Hornby, G. S., Takamura, S., Yamamoto, T., and Fujita, M. (2005).
Autonomous evolution of dynamic gaits with two quadruped robots.
<EM>IEEE Transactions on Robotics</EM>, 21(3):402–410.</DD><DT CLASS="dt-thebibliography"><A NAME="Ishiguro1999"><FONT COLOR=purple>[Ishiguro et al., 1999]</FONT></A></DT><DD CLASS="dd-thebibliography">
Ishiguro, A., Tokura, S., Kondo, T., Uchikawa, Y., and Eggenberger, P. (1999).
Reduction of the gap between simulated and real environments in
evolutionary robotics: a dynamically-rearranging neural network approach.
In <EM>Systems, Man, and Cybernetics, 1999. IEEE SMC'99 Conference
Proceedings. 1999 IEEE International Conference on</EM>, volume 3, pages
239–244. IEEE.</DD><DT CLASS="dt-thebibliography"><A NAME="jakobi1997"><FONT COLOR=purple>[Jakobi, 1997]</FONT></A></DT><DD CLASS="dd-thebibliography">
Jakobi, N. (1997).
Evolutionary robotics and the radical envelope-of-noise hypothesis.
<EM>Adaptive behavior</EM>, 6(2):325–368.</DD><DT CLASS="dt-thebibliography"><A NAME="Jakobi1998"><FONT COLOR=purple>[Jakobi, 1998]</FONT></A></DT><DD CLASS="dd-thebibliography">
Jakobi, N. (1998).
Running across the reality gap: Octopod locomotion evolved in a
minimal simulation.
<EM>Evolutionary Robotics</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Jin2005"><FONT COLOR=purple>[Jin, 2005]</FONT></A></DT><DD CLASS="dd-thebibliography">
Jin, Y. (2005).
Evolutionary Optimization in Uncertain Environments.
<EM>IEEE Transactions on Evolutionary Computation</EM>,
2610(1):264–317.</DD><DT CLASS="dt-thebibliography"><A NAME="Joel1997"><FONT COLOR=purple>[Joel et al., 1997]</FONT></A></DT><DD CLASS="dd-thebibliography">
Joel, D., Weiner, I., and Feldon, J. (1997).
Electrolytic lesions of the medial prefrontal cortex in rats disrupt
performance on an analog of the Wisconsin Card Sorting Test, but do not
disrupt latent inhibition: implications for animal models of schizophrenia.
<EM>Behavioural Brain Research</EM>, 85(2):187–201.</DD><DT CLASS="dt-thebibliography"><A NAME="Kamio2005"><FONT COLOR=purple>[Kamio and Iba, 2005]</FONT></A></DT><DD CLASS="dd-thebibliography">
Kamio, S. and Iba, H. (2005).
Adaptation Technique for Integrating Genetic Programming and
Reinforcement Learning for Real Robots.
<EM>IEEE Transactions on Evolutionary Computation</EM>, 9(3):318–333.</DD><DT CLASS="dt-thebibliography"><A NAME="Kim2004"><FONT COLOR=purple>[Kim, 2004]</FONT></A></DT><DD CLASS="dd-thebibliography">
Kim, D. (2004).
Evolving internal memory for T-maze tasks in noisy environments.
<EM>Connection Science</EM>, 16(3):183–210.</DD><DT CLASS="dt-thebibliography"><A NAME="Koos2012"><FONT COLOR=purple>[Koos et al., 2012]</FONT></A></DT><DD CLASS="dd-thebibliography">
Koos, S., Mouret, J.-B., and Doncieux, S. (2012).
The Transferability Approach: Crossing the Reality Gap in
Evolutionary Robotics.
<EM>IEEE Transactions on Evolutionary Computation</EM>, 1:1.</DD><DT CLASS="dt-thebibliography"><A NAME="Lee1997"><FONT COLOR=purple>[Lee et al., 1997]</FONT></A></DT><DD CLASS="dd-thebibliography">
Lee, W., Hallam, J., and Lund, H. H. (1997).
Applying genetic programming to evolve behavior primitives and
arbitrators for mobile robots.
<EM>Evolutionary Computation, 1997</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Linaker2001"><FONT COLOR=purple>[Linaker and Jacobsson, 2001]</FONT></A></DT><DD CLASS="dd-thebibliography">
Linaker, F. and Jacobsson, H. (2001).
Mobile robot learning of delayed response tasks through event
extraction: A solution to the road sign problem and beyond.
In <EM>International Joint Conference On Artificial Intelligence</EM>,
volume 17, pages 777–782.</DD><DT CLASS="dt-thebibliography"><A NAME="Liu1999"><FONT COLOR=purple>[Liu, 1999]</FONT></A></DT><DD CLASS="dd-thebibliography">
Liu, J. (1999).
Learning coordinated maneuvers in complex environments: a sumo
experiment.
<EM>Proceedings of the 1999 Congress on Evolutionary
Computation-CEC99 (Cat. No. 99TH8406)</EM>, pages 343–349.</DD><DT CLASS="dt-thebibliography"><A NAME="Lund1996"><FONT COLOR=purple>[Lund and Miglino, 1996]</FONT></A></DT><DD CLASS="dd-thebibliography">
Lund, H. H. and Miglino, O. (1996).
From simulated to real robots.
In <EM>Proceedings of IEEE International Conference on Evolutionary
Computation</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Macinnes2003"><FONT COLOR=purple>[Macinnes and Paolo, 2003]</FONT></A></DT><DD CLASS="dd-thebibliography">
Macinnes, I. and Paolo, E. (2003).
Crawling Out of the Simulation: Evolving Real Robot Morphologies
Using Cheap, Reusable Modules.
<EM>Neuroscience</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Maniadakis2009"><FONT COLOR=purple>[Maniadakis and Tani, 2009]</FONT></A></DT><DD CLASS="dd-thebibliography">
Maniadakis, M. and Tani, J. (2009).
Acquiring Rules for Rules: Neuro-Dynamical Systems Account for
Meta-Cognition.
<EM>Adaptive Behavior</EM>, 17(1):58–80.</DD><DT CLASS="dt-thebibliography"><A NAME="Maniadakis2010"><FONT COLOR=purple>[Maniadakis et al., 2010]</FONT></A></DT><DD CLASS="dd-thebibliography">
Maniadakis, M., Trahanias, P., and Tani, J. (2010).
Self-organized executive control functions.
In <EM>Neural Networks (IJCNN), The 2010 International Joint
Conference on</EM>, pages 1–8.</DD><DT CLASS="dt-thebibliography"><A NAME="Matari1996"><FONT COLOR=purple>[Mataric and Cliff, 1996]</FONT></A></DT><DD CLASS="dd-thebibliography">
Mataric, M. and Cliff, D. (1996).
Challenges in evolving controllers for physical robots.
<EM>Robotics and autonomous systems</EM>, 19:67–83.</DD><DT CLASS="dt-thebibliography"><A NAME="Matellan1998"><FONT COLOR=purple>[Matellán et al., 1998]</FONT></A></DT><DD CLASS="dd-thebibliography">
Matellán, V., Fernandez, C., and Molina, J. (1998).
Genetic learning of fuzzy reactive controllers.
<EM>Robotics and Autonomous Systems</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Meeden1995"><FONT COLOR=purple>[Meeden, 1995]</FONT></A></DT><DD CLASS="dd-thebibliography">
Meeden, L. (1995).
An Incremental Approach to Developing Intelligent Neural Network
Controllers for Robots.
<EM>IEEE Transactions on Systems, Man, and Cybernetics</EM>,
26:474–485.</DD><DT CLASS="dt-thebibliography"><A NAME="Meeden1998"><FONT COLOR=purple>[Meeden and Kumar, 1998]</FONT></A></DT><DD CLASS="dd-thebibliography">
Meeden, L. and Kumar, D. (1998).
Trends in evolutionary robotics.
<EM>Soft computing for intelligent robotic</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Meyer1998"><FONT COLOR=purple>[Meyer et al., 1998]</FONT></A></DT><DD CLASS="dd-thebibliography">
Meyer, J.-A., Husbands, P., and Harvey, I. (1998).
Evolutionary robotics: A survey of applications and problems.
<EM>Evolutionary Robotics</EM>, pages 1–22.</DD><DT CLASS="dt-thebibliography"><A NAME="Miglino1998"><FONT COLOR=purple>[Miglino et al., 1998]</FONT></A></DT><DD CLASS="dd-thebibliography">
Miglino, O., Denaro, D., Tascini, G., and Parisi, D. (1998).
Detour Behavior in Evolving Robots: Are Internal Representations
Necessary?
In <EM>Evolutionary Robotics</EM>, pages 59—-70.</DD><DT CLASS="dt-thebibliography"><A NAME="2011ACLI2061"><FONT COLOR=purple>[Mouret and Doncieux, 2012]</FONT></A></DT><DD CLASS="dd-thebibliography">
Mouret, J.-B. and Doncieux, S. (2012).
Encouraging Behavioral Diversity in Evolutionary Robotics: an
Empirical Study.
<EM>Evolutionary Computation</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Nakamura2000"><FONT COLOR=purple>[Nakamura et al., 2000]</FONT></A></DT><DD CLASS="dd-thebibliography">
Nakamura, H., Ishiguro, A., and Uchikawa, Y. (2000).
Evolutionary construction of behavior arbitration mechanisms based
on dynamically-rearranging neural networks.
In <EM>Proceedings of the 2000 Congress on Evolutionary Computation.
CEC00</EM>, pages 158–165.</DD><DT CLASS="dt-thebibliography"><A NAME="Nehmzow2002"><FONT COLOR=purple>[Nehmzow, 2002]</FONT></A></DT><DD CLASS="dd-thebibliography">
Nehmzow, U. (2002).
Physically embedded genetic algorithm learning in multi-robot
scenarios: The PEGA algorithm.
<EM>Lund University Cognitive Studies</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Nelson2004"><FONT COLOR=purple>[Nelson, 2004]</FONT></A></DT><DD CLASS="dd-thebibliography">
Nelson, A. L. (2004).
Maze exploration behaviors using an integrated evolutionary robotics
environment.
<EM>Robotics and Autonomous Systems</EM>, 46(3):159–173.</DD><DT CLASS="dt-thebibliography"><A NAME="Nelson2009"><FONT COLOR=purple>[Nelson et al., 2009]</FONT></A></DT><DD CLASS="dd-thebibliography">
Nelson, A. L., Barlow, G., and Doi Tsidis, L. (2009).
Fitness functions in evolutionary robotics: A survey and analysis.
<EM>Robotics and Autonomous Systems</EM>, 57(4):345–370.</DD><DT CLASS="dt-thebibliography"><A NAME="Nelson2007"><FONT COLOR=purple>[Nelson and Grant, 2007]</FONT></A></DT><DD CLASS="dd-thebibliography">
Nelson, A. L. and Grant, E. (2007).
Aggregate selection in evolutionary robotics.
In <EM>Mobile Robots: The Evolutionary Approach</EM>, volume 50, pages
63–87.</DD><DT CLASS="dt-thebibliography"><A NAME="Nolfi1996"><FONT COLOR=purple>[Nolfi, 1996]</FONT></A></DT><DD CLASS="dd-thebibliography">
Nolfi, S. (1996).
Evolving non-Trivial Behaviors on Real Robots: a garbage collecting
robot.
<EM>Robotics and Autonomous Systems</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="nolfi2002evolving"><FONT COLOR=purple>[Nolfi, 2002]</FONT></A></DT><DD CLASS="dd-thebibliography">
Nolfi, S. (2002).
Evolving robots able to self-localize in the environment: the
importance of viewing cognition as the result of processes occurring at
different time-scales.
<EM>Connection Science</EM>, 14(3):231–244.</DD><DT CLASS="dt-thebibliography"><A NAME="nolfi1999extracting"><FONT COLOR=purple>[Nolfi and Tani, 1999]</FONT></A></DT><DD CLASS="dd-thebibliography">
Nolfi, S. and Tani, J. (1999).
Extracting regularities in space and time through a cascade of
prediction networks: The case of a mobile robot navigating in a structured
environment.
<EM>Connection Science</EM>, 11(2):125–148.</DD><DT CLASS="dt-thebibliography"><A NAME="Nordin1998"><FONT COLOR=purple>[Nordin, 1998]</FONT></A></DT><DD CLASS="dd-thebibliography">
Nordin, P. (1998).
Evolution of a world model for a miniature robot using genetic
programming.
<EM>Robotics and Autonomous Systems</EM>, 25(1-2):105–116.</DD><DT CLASS="dt-thebibliography"><A NAME="Okura2003"><FONT COLOR=purple>[Okura et al., 2003]</FONT></A></DT><DD CLASS="dd-thebibliography">
Okura, M., Matsumoto, A., Ikeda, H., and Murase, K. (2003).
Artificial Evolution of FPGA that controls a Miniature Mobile Robot
Khepera.
<EM>Artificial Intelligence</EM>, pages 2521–2526.</DD><DT CLASS="dt-thebibliography"><A NAME="Parker2006"><FONT COLOR=purple>[Parker and Georgescu, 2006]</FONT></A></DT><DD CLASS="dd-thebibliography">
Parker, G. and Georgescu, R. (2006).
Using cyclic genetic algorithms to evolve multi-loop control
programs.
<EM>Mechatronics and Automation,</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Pasemann2001"><FONT COLOR=purple>[Pasemann et al., 2001]</FONT></A></DT><DD CLASS="dd-thebibliography">
Pasemann, F., Steinmetz, U., Hülse, M., and B (2001).
Evolving brain structures for robot control.
<EM>Bio-Inspired Applications of Connectionism</EM>, pages 410—-417.</DD><DT CLASS="dt-thebibliography"><A NAME="Pfeifer2003"><FONT COLOR=purple>[Pfeifer et al., 2003]</FONT></A></DT><DD CLASS="dd-thebibliography">
Pfeifer, R., Iida, F., and Bongard, J. (2003).
New robotics: design principles for intelligent systems.
<EM>Artificial life</EM>, 11(1-2):99–120.</DD><DT CLASS="dt-thebibliography"><A NAME="Pratihar2003"><FONT COLOR=purple>[Pratihar, 2003]</FONT></A></DT><DD CLASS="dd-thebibliography">
Pratihar, D. K. (2003).
Evolutionary robotics — A review.
<EM>Sadhana</EM>, 28(6):999–1009.</DD><DT CLASS="dt-thebibliography"><A NAME="Quinn2001"><FONT COLOR=purple>[Quinn et al., 2001]</FONT></A></DT><DD CLASS="dd-thebibliography">
Quinn, M., Smith, L., Mayley, G., and Husbands, P. (2001).
Evolving Team Behaviour for Real Robots.
In <EM>EPSRC/BBSRC International Workshop on Biologically-Inspired
Robotics: The Legacy of W. Grey Walter, WGW</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Rylatt2000"><FONT COLOR=purple>[Rylatt and Czarnecki, 2000]</FONT></A></DT><DD CLASS="dd-thebibliography">
Rylatt, R. M. and Czarnecki, C. A. (2000).
Embedding Connectionist Autonomous Agents in Time: The 'Road Sign
Problem'.
<EM>Neural Processing Letters</EM>, 12(2):145–158.</DD><DT CLASS="dt-thebibliography"><A NAME="Schultz1996"><FONT COLOR=purple>[Schultz et al., 1996]</FONT></A></DT><DD CLASS="dd-thebibliography">
Schultz, A., Grefenstette, J., and Adams, W. (1996).
Robo-shepherd: Learning complex robotic behaviors, Robotics and
Manufacturing: Recent Trends in Research and Application, Volume 6.
<EM>World</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Seok2000"><FONT COLOR=purple>[Seok et al., 2000]</FONT></A></DT><DD CLASS="dd-thebibliography">
Seok, H., Lee, K., and Zhang, B. (2000).
An on-line learning method for object-locating robots using genetic
programming on evolvable hardware.
<EM>Symposium on Artificial Life and Robotics</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Slocum2000"><FONT COLOR=purple>[Slocum and Downey, 2000]</FONT></A></DT><DD CLASS="dd-thebibliography">
Slocum, A. and Downey, D. C. (2000).
Further experiments in the evolution of minimally cognitive
behavior: From perceiving affordances to selective attention.
<EM>From animals to animats</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Sprinkhuizen-kuyper2000"><FONT COLOR=purple>[Sprinkhuizen-kuyper et al., 2000]</FONT></A></DT><DD CLASS="dd-thebibliography">
Sprinkhuizen-kuyper, I., Kortmann, R., and Postman, E. (2000).
Fitness functions for evolving box-pushing behaviour.
In <EM>Proceedings of the Twelfth Belgium–Netherlands Artificial
Intelligence Conference</EM>, pages 275—-282.</DD><DT CLASS="dt-thebibliography"><A NAME="tani1999learning"><FONT COLOR=purple>[Tani and Nolfi, 1999]</FONT></A></DT><DD CLASS="dd-thebibliography">
Tani, J. and Nolfi, S. (1999).
Learning to perceive the world as articulated: an approach for
hierarchical learning in sensory-motor systems.
<EM>Neural Networks</EM>, 12(7):1131–1141.</DD><DT CLASS="dt-thebibliography"><A NAME="Teo2005"><FONT COLOR=purple>[Teo and Abbass, 2005]</FONT></A></DT><DD CLASS="dd-thebibliography">
Teo, J. and Abbass, H. (2005).
Multiobjectivity and complexity in embodied cognition.
<EM>IEEE Transactions on Evolutionary Computation</EM>, 9(4):337–360.</DD><DT CLASS="dt-thebibliography"><A NAME="Thompson1995"><FONT COLOR=purple>[Thompson, 1995]</FONT></A></DT><DD CLASS="dd-thebibliography">
Thompson, A. (1995).
Evolving electronic robot controllers that exploit hardware
resources.
<EM>Advances in Artificial Life</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Tolman1948"><FONT COLOR=purple>[Tolman, 1948]</FONT></A></DT><DD CLASS="dd-thebibliography">
Tolman, E. C. (1948).
Cognitive maps in rats and men.
<EM>Psychological review</EM>, 55(4):189–208.</DD><DT CLASS="dt-thebibliography"><A NAME="Trianni2006"><FONT COLOR=purple>[Trianni and Dorigo, 2006]</FONT></A></DT><DD CLASS="dd-thebibliography">
Trianni, V. and Dorigo, M. (2006).
Self-organisation and communication in groups of simulated and
physical robots.
<EM>Biological cybernetics</EM>, 95(3):213–31.</DD><DT CLASS="dt-thebibliography"><A NAME="ulbricht1996"><FONT COLOR=purple>[Ulbricht, 1996]</FONT></A></DT><DD CLASS="dd-thebibliography">
Ulbricht, C. (1996).
Handling time-warped sequences with neural networks.
In <EM>From animals to animats</EM>, pages 180–192. The MIT Press.</DD><DT CLASS="dt-thebibliography"><A NAME="vickerstaff2005evolved"><FONT COLOR=purple>[Vickerstaff and Di Paolo, 2005a]</FONT></A></DT><DD CLASS="dd-thebibliography">
Vickerstaff, R. and Di Paolo, E. (2005a).
An evolved agent performing efficient path integration based homing
and search.
<EM>Advances in Artificial Life</EM>, pages 221–230.</DD><DT CLASS="dt-thebibliography"><A NAME="vickerstaff2005evolving"><FONT COLOR=purple>[Vickerstaff and Di Paolo, 2005b]</FONT></A></DT><DD CLASS="dd-thebibliography">
Vickerstaff, R. J. and Di Paolo, E. A. (2005b).
Evolving neural models of path integration.
<EM>Journal of Experimental Biology</EM>, 208(17):3349–3366.</DD><DT CLASS="dt-thebibliography"><A NAME="Walker2003"><FONT COLOR=purple>[Walker et al., 2003]</FONT></A></DT><DD CLASS="dd-thebibliography">
Walker, J., Garrett, S., and Wilson, M. S. (2003).
Evolving Controllers for Real Robots: A Survey of the Literature.
<EM>Adaptive Behavior</EM>, 11(3):179–203.</DD><DT CLASS="dt-thebibliography"><A NAME="Watson2002"><FONT COLOR=purple>[Watson, 2002]</FONT></A></DT><DD CLASS="dd-thebibliography">
Watson, R. (2002).
Embodied Evolution: Distributing an evolutionary algorithm in a
population of robots.
<EM>Robotics and Autonomous Systems</EM>, 39(1):1–18.</DD><DT CLASS="dt-thebibliography"><A NAME="Wolff2001"><FONT COLOR=purple>[Wolff and Nordin, 2001]</FONT></A></DT><DD CLASS="dd-thebibliography">
Wolff, K. and Nordin, P. (2001).
Evolution of efficient gait with an autonomous biped robot using
visual feedback.
<EM>-RAS International Conference on Humanoid Robots,</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Ziegler2001"><FONT COLOR=purple>[Ziegler and Banzhaf, 2001]</FONT></A></DT><DD CLASS="dd-thebibliography">
Ziegler, J. and Banzhaf, W. (2001).
Evolving control metabolisms for a robot.
<EM>Artificial life</EM>, 7(2):171–90.</DD><DT CLASS="dt-thebibliography"><A NAME="Ziemke1996"><FONT COLOR=purple>[Ziemke, 1996]</FONT></A></DT><DD CLASS="dd-thebibliography">
Ziemke, T. (1996).
Towards adaptive behaviour system integration using connectionist
infinite state automata.
In <EM>From animals to animats 4</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Ziemke2004"><FONT COLOR=purple>[Ziemke et al., 2004]</FONT></A></DT><DD CLASS="dd-thebibliography">
Ziemke, T., Bergfeldt, N., Buason, G., Susi, T., and Svensson, H. (2004).
Evolving cognitive scaffolding and environment adaptation: a new
research direction for evolutionary robotics.
<EM>Connection Science</EM>, 16(4):339–350.</DD><DT CLASS="dt-thebibliography"><A NAME="Ziemke2002"><FONT COLOR=purple>[Ziemke and Thieme, 2002]</FONT></A></DT><DD CLASS="dd-thebibliography">
Ziemke, T. and Thieme, M. (2002).
Neuromodulation of Reactive Sensorimotor Mappings as a Short-Term
Memory Mechanism in Delayed Response Tasks.
<EM>Adapt. Behav.</EM>, 10(3-4):185–199.</DD><DT CLASS="dt-thebibliography"><A NAME="Zufferey2002"><FONT COLOR=purple>[Zufferey et al., 2002]</FONT></A></DT><DD CLASS="dd-thebibliography">
Zufferey, J.-c., Floreano, D., Leeuwen, M. V., and Merenda, T. (2002).
Evolving Vision-Based Flying Robots.
<EM>Evolutionary Computation</EM>, pages 592–600.</DD><DT CLASS="dt-thebibliography"><A NAME="Zykov2004"><FONT COLOR=purple>[Zykov et al., 2004]</FONT></A></DT><DD CLASS="dd-thebibliography">
Zykov, V., Bongard, J., and Lipson, H. (2004).
Evolving Dynamic Gaits on a Physical Robot.
In <EM>Proceedings of Genetic and Evolutionary Computation
Conference, Late Breaking Paper, GECCO</EM>.</DD></DL><!--CUT END -->
<!--HTMLFOOT-->
<!--ENDHTML-->
<!--FOOTER-->

</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
<?include("footer.inc")?>
</body>
</HTML>