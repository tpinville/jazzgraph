<html lang="en">
<head>
<meta charset="utf-8">
<title>Apprentissage par renforcement</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/these.css" rel="stylesheet">
  <link href="css/cv.css" rel="stylesheet">		
</HEAD>
<BODY >

<?include("menu.html")?>

		<div class="platform">



	      	
	      	<div class="main">  	
          <h2>Apprentissage par renforcement</h2>
<!--CUT DEF section 1 --><P>L'apprentissage par renforcement tient son inspiration des travaux sur
le conditionnement opérant (<A HREF="#Skinner1953">Skinner, 1953</A>) et de l'apprentissage
par essais et erreurs (<A HREF="#Thorndike1998">Thorndike, 1998</A>). 
Cette méthode s'est développée au sein de l'intelligence artificielle avec
notamment les travaux de (<A HREF="#Sutton1996a">Sutton, 1996</A>). 
Le problème étudié par ce domaine est 
celui d'un agent placé dans un environnement, qui doit apprendre à
sélectionner ses décisions en
fonction de sa situation et à partir d'un signal de récompense (ou de
punition).
L'environnement est décrit par un ensemble de paramètres composant l'état
courant du système. L'agent sélectionne ses actions parmi un ensemble fini
d'actions possibles. 
Cet agent sélectionne une seule action (puis l'exécute) pour chaque étape.
L'action représente donc la décision de l'agent à chaque pas de temps.
D'autre part, une fonction de récompense associe un nombre
réel à chaque couple état/action possible dans le système. 
Cette fonction 
quantifie l'état courant du système et spécifie l'objectif à maximiser par
l'agent. </P><P>L'apprentissage par renforcement est souvent modélisé par un Processus Décisionnel de
Markov (MDP) (<A HREF="#Puterman1994">Puterman, 1994</A>).
Les MDPs sont un cadre mathématique permettant de modéliser et de résoudre des
problèmes de décision dans les environnements stochastiques. À partir de ce
cadre, deux problèmes peuvent être définis. Le premier est un problème de
planification. Dans ce cas, la dynamique du
système, ou fonction de transition, et la fonction de récompense associée sont
supposées être connues à l'avance. À partir de ces fonctions, le problème
consiste alors à trouver une politique optimale maximisant la récompense
obtenue sur le long terme. Le deuxième problème est un problème d'apprentissage
par renforcement (<A HREF="#Sutton1998">Sutton et Barto, 1998</A>). Dans ce cas, la fonction de
transition et la fonction de récompense sont inconnues et l'agent doit construire sa politique par
essais-erreurs.</P><P>Les concepts principaux sont résumés ci-dessous :
</P><UL CLASS="itemize"><LI CLASS="li-itemize">
un ensemble d'états discrets <I>S</I> qui correspond
aux situations possibles de l'agent dans l'environnement. 
Un état peut être décrit par la position du robot et/ou les valeurs de ses
capteurs. D'autres valeurs peuvent être intégrées comme une variable interne
pouvant servir de mémoire ; 
</LI><LI CLASS="li-itemize">un ensemble d'actions <I>A</I>, qui encode les décisions possibles d'un robot dans chaque état.
Ces actions pouvant être de bas niveau comme le contrôle en vitesse des
roues du robot, ou de plus haut niveau comme l'exécution d'un module
impliquant un ensemble d'actions (ex. attraper un objet) ;
</LI><LI CLASS="li-itemize">Une fonction de transition <I>p</I> : <I>S</I> × <I>A</I> × <I>S</I> →
ℝ<SUP>+</SUP> qui définit la probabilité conditionnelle <I>p</I>(<I>s</I>′|<I>s</I>,<I>a</I>)
d'arriver à l'état <I>s</I>′ en sélectionnant l'action <I>a</I> dans
l'état <I>s</I>. Une transition est le passage d'un état courant du système à un
nouvel état au pas de temps suivant. Elle est définie par l'action
sélectionnée par l'agent et par la fonction de transition décrivant la
dynamique du système ;
</LI><LI CLASS="li-itemize">une fonction de récompense qui associe un nombre réel à chaque couple état/action possible dans le système.
</LI></UL><P>L'objectif d'un apprentissage par renforcement est de trouver une politique (une stratégie) qui 
associe à un ensemble d'états un ensemble d'actions 
</P><TABLE CLASS="display dcenter"><TR VALIGN="middle"><TD CLASS="dcell">Π : <I>S</I> → <I>A</I></TD></TR>
</TABLE><P>
qui lui permette de maximiser la quantité de récompenses.</P><!--TOC paragraph Applications-->
<H5 CLASS="paragraph"><!--SEC ANCHOR -->Applications</H5><!--SEC END --><P>Cette approche a montré son efficacité sur des problèmes discrets markovien
(<A HREF="#Sutton1998">Sutton et Barto, 1998</A>),
elle comporte néanmoins certaines limitations :
</P><UL CLASS="itemize"><LI CLASS="li-itemize">
<EM>curse of dimensionality</EM> :
le nombre d'états possibles du système croît exponentiellement avec le nombre
de variables décrivant l'état. Cette propriété est appelée par
(<A HREF="#Bellman1957">Bellman, 1957</A>) <EM>the curse of dimensionality</EM> ("la malédiction de la
dimensionalité"). Cette caractéristique rend les MDPs inadaptés pour les
grands problèmes. Différentes représentations et techniques ont été proposées
afin de représenter de façon compacte les fonctions de transition et de
récompense (<A HREF="#Peng1996">Peng et Williams, 1996</A>,<A HREF="#Wiering1997">Wiering et Schmidhuber, 1998</A>,<A HREF="#Li2006">Li et al., 2006</A>,<A HREF="#Boutilier1999">Boutilier, 1999</A>,<A HREF="#Degris2006">Degris et al., 2006</A>,<A HREF="#Sutton2000">Sutton et al., 2000</A>).
</LI><LI CLASS="li-itemize">l'apprentissage par renforcement dans un monde continu :
le cas d'un espace d'états continu se rencontre
couramment. Les données telles que la position, la distance ou la vitesse d'un
agent s'expriment plus souvent par des données réelles qu'entières. Dans ce
cas, la recherche d'une politique optimale pose des problèmes importants (voir (<A HREF="#Stulp2012">Stulp et Sigaud, 2012</A>) pour un résumé des dernières avancées dans le domaine);
</LI><LI CLASS="li-itemize">apprentissage par renforcement dans un cadre non-markovien :
lorsque les perceptions immédiates de l'agent ne lui permettent pas de
connaître l'état complet du système qu'il forme avec son environnement, les
agents sont placés dans un environnement qui n'est plus considéré comme
markovien. Ce cas est fréquent dans un environnement ouvert. Or,
apprendre par renforcement quand l'environnement perçu par l'agent ne respecte
pas l'hypothèse de Markov demeure un problème largement
ouvert. Les Processus Décisionnels de Markov Partiellement Observables (POMDP)
(<A HREF="#kaelbling1998planning">Kaelbling et al., 1998</A>,<A HREF="#dutech2000solving">Dutech, 2000</A>) sont une des solutions
proposées dans le cas où les agents
n'ont qu'une connaissance et une perception imparfaites de leur environnement.
</LI></UL><!--TOC section Références-->
<H1 CLASS="section"><!--SEC ANCHOR -->Références</H1><!--SEC END --><DL CLASS="thebibliography"><DT CLASS="dt-thebibliography">
<A NAME="Bellman1957"><FONT COLOR=purple>[Bellman, 1957]</FONT></A></DT><DD CLASS="dd-thebibliography">
Bellman, R. (1957).
<EM>Dynamic Programming</EM>.
Princeton University Press, Princeton, NJ, USA.</DD><DT CLASS="dt-thebibliography"><A NAME="Boutilier1999"><FONT COLOR=purple>[Boutilier, 1999]</FONT></A></DT><DD CLASS="dd-thebibliography">
Boutilier, C. (1999).
Sequential Optimality and Coordination in Multiagent Systems.
In <EM>International Joint Conference on Artificial Intelligence</EM>,
volume 1 of <EM>Proceedings of Sixteenth International Joint Conference on
Artificial Intelligence</EM>, pages 478–485. LAWRENCE ERLBAUM ASSOCIATES LTD,
Morgan Kaufmann Publishers.</DD><DT CLASS="dt-thebibliography"><A NAME="Degris2006"><FONT COLOR=purple>[Degris et al., 2006]</FONT></A></DT><DD CLASS="dd-thebibliography">
Degris, T., Sigaud, O., et Wuillemin, P.-H. (2006).
Learning the structure of Factored Markov Decision Processes in
reinforcement learning problems.
In <EM>Proceedings of the 23rd international conference on Machine
learning</EM>, ICML '06, pages 257–264, New York, NY, USA. ACM.</DD><DT CLASS="dt-thebibliography"><A NAME="dutech2000solving"><FONT COLOR=purple>[Dutech, 2000]</FONT></A></DT><DD CLASS="dd-thebibliography">
Dutech, A. (2000).
Solving POMDPs using selected past events.
<EM>European Conference on Artificial Intelligence</EM>, 3:s4.</DD><DT CLASS="dt-thebibliography"><A NAME="kaelbling1998planning"><FONT COLOR=purple>[Kaelbling et al., 1998]</FONT></A></DT><DD CLASS="dd-thebibliography">
Kaelbling, L. P., Littman, M. L., et Cassandra, A. R. (1998).
Planning and acting in partially observable stochastic domains.
<EM>Artificial Intelligence</EM>, 101(1-2):99–134.</DD><DT CLASS="dt-thebibliography"><A NAME="Li2006"><FONT COLOR=purple>[Li et al., 2006]</FONT></A></DT><DD CLASS="dd-thebibliography">
Li, L., Walsh, T. J., et Littman, M. L. (2006).
Towards a Unified Theory of State Abstraction for MDPs.</DD><DT CLASS="dt-thebibliography"><A NAME="Peng1996"><FONT COLOR=purple>[Peng et Williams, 1996]</FONT></A></DT><DD CLASS="dd-thebibliography">
Peng, J. et Williams, R. J. (1996).
Incremental multi-step Q-learning.
<EM>Mach. Learn.</EM>, 22(1-3):283–290.</DD><DT CLASS="dt-thebibliography"><A NAME="Puterman1994"><FONT COLOR=purple>[Puterman, 1994]</FONT></A></DT><DD CLASS="dd-thebibliography">
Puterman, M. L. (1994).
<EM>Markov Decision Processes: Discrete Stochastic Dynamic
Programming</EM>.
John Wiley &amp; Sons, Inc., New York, NY, USA, 1st edition.</DD><DT CLASS="dt-thebibliography"><A NAME="Skinner1953"><FONT COLOR=purple>[Skinner, 1953]</FONT></A></DT><DD CLASS="dd-thebibliography">
Skinner, B. (1953).
Science and human behavior.</DD><DT CLASS="dt-thebibliography"><A NAME="Stulp2012"><FONT COLOR=purple>[Stulp et Sigaud, 2012]</FONT></A></DT><DD CLASS="dd-thebibliography">
Stulp, F. et Sigaud, O. (2012).
Path integral policy improvement with covariance matrix adaptation.
In <EM>Proceedings of the 29th International Conference on Machine
Learning (ICML)</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Sutton1998"><FONT COLOR=purple>[Sutton et Barto, 1998]</FONT></A></DT><DD CLASS="dd-thebibliography">
Sutton, R. et Barto, A. (1998).
<EM>Reinforcement learning: An introduction</EM>.
Cambridge Univ Press.</DD><DT CLASS="dt-thebibliography"><A NAME="Sutton1996a"><FONT COLOR=purple>[Sutton, 1996]</FONT></A></DT><DD CLASS="dd-thebibliography">
Sutton, R. S. (1996).
Generalization in reinforcement learning: Successful examples using
sparse coarse coding.
<EM>Advances in neural information processing systems</EM>, pages
1038–1044.</DD><DT CLASS="dt-thebibliography"><A NAME="Sutton2000"><FONT COLOR=purple>[Sutton et al., 2000]</FONT></A></DT><DD CLASS="dd-thebibliography">
Sutton, R. S., Mcallester, D., Singh, S., et Mansour, Y. (2000).
Policy gradient methods for reinforcement learning with function
approximation.</DD><DT CLASS="dt-thebibliography"><A NAME="Thorndike1998"><FONT COLOR=purple>[Thorndike, 1998]</FONT></A></DT><DD CLASS="dd-thebibliography">
Thorndike, E. (1998).
Animal Intelligence.
<EM>American Psychology</EM>, 53(10):1125–1127.</DD><DT CLASS="dt-thebibliography"><A NAME="Wiering1997"><FONT COLOR=purple>[Wiering et Schmidhuber, 1998]</FONT></A></DT><DD CLASS="dd-thebibliography">
Wiering, M. et Schmidhuber, J. (1998).
HQ-learning.
<EM>Adapt. Behav.</EM>, 6(2):219–246.</DD></DL><!--CUT END -->
<!--HTMLFOOT-->
<!--ENDHTML-->
<!--FOOTER-->
</div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
<?include("footer.inc")?>
</body>
</HTML>
