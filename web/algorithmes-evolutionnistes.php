<html lang="en">
<head>
<meta charset="utf-8">
<title>Algorithmes évolutionnistes</title>
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
<H1 CLASS="section"><!--SEC ANCHOR --> <A NAME="htoc1">1</A> Algorithmes évolutionnistes (AEs)</H1><!--SEC END --><P>
<A NAME="section:algo_evo"></A></P><P>Les Algorithmes Evolutionnistes (ou évolutionnaires) (<A HREF="#Eiben2003">Eiben and Smith, 2003</A>) sont des
méta-heuristiques stochastiques d'optimisation globale, s'inspirant de la
théorie de l'évolution.
La souplesse d'utilisation de ces algorithmes pour des
fonctions objectifs non régulières, à valeurs vectorielles, et définies
sur des espaces de recherche non standard (e.g. espaces de listes, de
graphes, ... ) permet leur utilisation pour des problèmes qui sont pour
le moment hors d'atteinte des méthodes plus classiques.</P><P>Un problème d'optimisation globale peut se formaliser de cette manière :
</P><TABLE CLASS="display dcenter"><TR VALIGN="middle"><TD CLASS="dcell">    Trouver  <I>x</I><SUP>*</SUP>  tel que  <I>f</I>(<I>x</I>*) &lt;= <I>f</I>(<I>x</I>), ∀ <I>x</I> ∈ <I>S</I>
</TD></TR>
</TABLE><P> 
avec <I>f</I> comme fonction objectif et <I>S</I> l'espace de recherche.</P><DIV CLASS="theorem"><B>Définition 1</B> <B>(Heuristique)</B>  <EM>
Une heuristique est un algorithme qui permet d'identifier au
moins une solution réalisable à un problème
d'optimisation, mais sans garantir que cette solution
soit optimale </EM><EM>(</EM><A HREF="#Michalewicz2004"><EM>Michalewicz, 2004</EM></A><EM>)</EM><EM>.
Elle permet d'aborder des problèmes ne pouvant être résolus par des techniques
de résolution exactes, en particulier les problèmes difficiles d'optimisation
combinatoire.
</EM></DIV><DIV CLASS="theorem"><B>Définition 2</B> <B>(Métaheuristique)</B>  <EM>
Une métaheuristique est une stratégie générale,
applicable à un grand nombre de problèmes, à partir
de laquelle on peut dériver une heuristique
pour un problème particulier.
</EM></DIV><BLOCKQUOTE CLASS="table"><DIV CLASS="center"><HR WIDTH="80%" SIZE=2></DIV> 
<DIV CLASS="caption"><TABLE CELLSPACING=6 CELLPADDING=0><TR><TD VALIGN=top ALIGN=left>Tableau 1.1: 
<A NAME="table:compar_evo_opti"></A>
Tableau comparatif des termes utilisés en optimisation 
et en évolution.</TD></TR>
</TABLE></DIV>
<DIV CLASS="center"> 
<FONT SIZE=2> </FONT><TABLE BORDER=1 CELLSPACING=0 CELLPADDING=1><TR><TD ALIGN=left NOWRAP><FONT SIZE=2> Algorithme évolutionniste</FONT></TD><TD ALIGN=left NOWRAP><FONT SIZE=2>Optimisation</FONT></TD></TR>
<TR><TD ALIGN=left NOWRAP><FONT SIZE=2> individus</FONT></TD><TD ALIGN=left NOWRAP><FONT SIZE=2>solutions candidates</FONT></TD></TR>
<TR><TD ALIGN=left NOWRAP><FONT SIZE=2> population</FONT></TD><TD ALIGN=left NOWRAP><FONT SIZE=2>ensemble de solutions candidates</FONT></TD></TR>
<TR><TD ALIGN=left NOWRAP><FONT SIZE=2> fonction de fitness</FONT></TD><TD ALIGN=left NOWRAP><FONT SIZE=2>fonction objectif</FONT></TD></TR>
<TR><TD ALIGN=left NOWRAP><FONT SIZE=2> génération</FONT></TD><TD ALIGN=left NOWRAP><FONT SIZE=2>itération</FONT></TD></TR>
</TABLE></DIV> 
<DIV CLASS="center"><HR WIDTH="80%" SIZE=2></DIV></BLOCKQUOTE><!--TOC subsection Inspiration-->
<H2 CLASS="subsection"><!--SEC ANCHOR --><A NAME="htoc3">1.1</A>  Inspiration</H2><!--SEC END --><P>
Apparue dans les années 30, la théorie synthétique de l'évolution (ou
néodarwinisme) (<A HREF="#mayr1942systematics">Mayr, 1942</A>) intègre à la théorie darwinienne (<A HREF="#Darwin1859">Darwin, 1859</A>), la théorie
de l'hérédité mendelienne (<A HREF="#mendel1865experiments">Mendel, 1865</A>) et la génétique des
populations (<A HREF="#haldane1932causes">Haldane, 1932</A>).</P><P>Elle donne une explication des mécanismes de
différenciation d'individus au sein d'une population ainsi que le principe
de transmission de caractéristiques d'individus à leur descendance. Les
caractéristiques d'un organisme sont en grande partie codées dans ses gènes,
une séquence d'ADN différente pour chaque individu. Les sources de cette
diversité sont des mutations pouvant apparaître dans ces gènes,
ainsi que des recombinaisons (brassages génétiques) se produisant lors de
la reproduction sexuée.</P><P>Les algorithmes évolutionnistes sont une abstraction du principe
évoqué précédemment pouvant se résumer de la manière suivante :</P><UL CLASS="itemize"><LI CLASS="li-itemize">
Il existe au sein de chaque espèce de nombreuses variations, chaque individu étant différent.
</LI><LI CLASS="li-itemize">Les ressources naturelles étant finies, il naît rapidement plus
d'être vivants que la nature ne peut en nourrir ; il en résulte une lutte
pour l'existence (<EM>struggle for life</EM>) entre chaque organisme.
</LI><LI CLASS="li-itemize">Les individus survivants possèdent des caractéristiques qui les
rendent plus aptes à survivre. Darwin baptise ce concept : sélection
naturelle.
</LI><LI CLASS="li-itemize">Les organismes survivants transmettent leurs avantages à leur
descendance. L'accumulation au cours des générations des petites
différences entre chaque branche généalogique crée de nouvelles espèces de
plus en plus aptes à survivre.
</LI></UL><!--TOC subsection Historique-->
<H2 CLASS="subsection"><!--SEC ANCHOR --><A NAME="htoc4">1.2</A>  Historique</H2><!--SEC END --><P>
Les algorithmes évolutionnistes (AE) ont des origines diverses : à la fin des années 1950, certains
mécanismes d'évolution naturelle sont simulés via des
programmes
informatiques (<A HREF="#Fraser1957">Fraser, 1957</A>). Une solution fonctionnelle fut
proposée par John Holland en 1975, sous le nom d'algorithme
génétique (<A HREF="#Holland1975">Holland, 1975</A>) dans le but de modéliser ces mécanismes.
Ils ont été utilisés comme optimiseurs par (<A HREF="#DeJong1975">De Jong, 1975</A>) et popularisés
par Goldberg (<A HREF="#Goldberg1989">Goldberg, 1989</A>). 
Les stratégies d'évolution sont apparues en 1965 (<A HREF="#Rechenberg1965">Rechenberg, 1965</A>,<A HREF="#Rechenberg1973">Rechenberg, 1973</A>,<A HREF="#Schwefel1981">Schwefel, 1981</A>),
les programmes évolutionnistes datent du début des années
1960 (<A HREF="#Fogel1962">Fogel, 1962</A>,<A HREF="#Fogel1991a">Fogel, 1991</A>), alors que la programmation génétique est apparue plus récemment (<A HREF="#Cramer1985">Cramer, 1985</A>,<A HREF="#Koza1992">Koza, 1992</A>).
Ces différents AEs ont aujourd'hui en grande partie fusionné, car, comme l'a démontré (<A HREF="#Michalewicz1994">Michalewicz, 1994</A>),
le principe de ces algorithmes peut s'appliquer à toute représentation.</P><!--TOC paragraph Domaines d'application-->
<H4 CLASS="paragraph"><!--SEC ANCHOR -->Domaines d'application</H4><!--SEC END --><P>
Le champ d'application des algorithmes évolutionnistes couvre, de nos
jours, un spectre très large : d'applications réelles complexes
comme le contrôle du flux de <EM>pipelines</EM> de
gaz, le <EM>design</EM> de profils d'ailes d'avion, le routage aérien, la conception d'antennes
(<A HREF="#Hornby2011">Hornby et al., 2011</A>,<A HREF="#Lohn2004">Lohn et al., 2004</A>) et la conception de filtres électroniques
(<A HREF="#Koza2003">Koza et al., 2003</A>), à des problèmes plus théoriques et combinatoires, comme en
théorie des jeux et en modélisation économique ou financière (<A HREF="#coello2004applications">Coello and Lamont, 2004</A>).</P><!--TOC subsection Principes-->
<H2 CLASS="subsection"><!--SEC ANCHOR --><A NAME="htoc5">1.3</A>  Principes</H2><!--SEC END --><P>Les AEs empruntent un vocabulaire quelque peu
différent des méthodes d'optimisation classiques (cf.
tableau <A HREF="#table:compar_evo_opti">1.1</A> pour un comparatif des termes).</P><P>Avant de décrire les différents principes de ces algorithmes, il semble
nécessaire de définir quelques notions.</P><DIV CLASS="theorem"><B>Définition 3</B> <B>(génotype)</B>  <EM>
Le </EM>génotype<EM> correspond à la partie d'un individu (parent) transmise
lors de la création d'un nouvel individu (enfant) et sur laquelle agissent
directement les opérateurs de mutation et de croisement. 
</EM></DIV><DIV CLASS="theorem"><B>Définition 4</B> <B>(phénotype)</B>  <EM>
Le </EM>phénotype<EM> est généré à partir du génotype et correspond aux
caractères observables et testables de l'individu. 
</EM></DIV><DIV CLASS="theorem"><B>Définition 5</B> <B>(fitness)</B>  <EM>
La fonction d'adaptation, souvent appelée “fitness” fournit une évaluation
de la performance des individus et a une influence sur la sélection et la
reproduction des individus.
</EM></DIV><DIV CLASS="theorem"><B>Définition 6</B> <B>(population)</B>  <EM>
La </EM>population<EM> est l'ensemble des solutions potentielles, chacune
définie par un génotype et un phénotype.</EM></DIV><DIV CLASS="theorem"><B>Définition 7</B> <B>(croisement)</B>  <EM>
Le </EM>croisement<EM> est un opérateur permettant de générer un nouveau
génotype par combinaison de </EM><EM><I>n</I>&gt;1</EM><EM> génotypes parents. 
</EM></DIV><DIV CLASS="theorem"><B>Définition 8</B> <B>(mutation)</B>  <EM>
La </EM>mutation<EM> est un opérateur permettant de générer un nouvel individu
à partir d'un individu parent dont certaines parties ont été modifiées
aléatoirement.
</EM></DIV><BLOCKQUOTE CLASS="figure"><DIV CLASS="center"><DIV CLASS="center"><HR WIDTH="80%" SIZE=2></DIV>
<IMG SRC="img/schema_EA_mutation_cross.png">
<DIV CLASS="caption"><TABLE CELLSPACING=6 CELLPADDING=0><TR><TD VALIGN=top ALIGN=left>Figure 1.1: Illustration des opérateurs de mutation et de croisement utilisés
dans un algorithme évolutionniste, ainsi que des phénomènes biologiques dont
ils sont inspirés.</TD></TR>
</TABLE></DIV>
<A NAME="fig:crossover_mutation"></A>
<DIV CLASS="center"><HR WIDTH="80%" SIZE=2></DIV></DIV></BLOCKQUOTE><P>Tous les AEs présentent les points communs
suivants : ils manipulent une population d'individus, un individu peut subir
des modifications aléatoires, un processus de sélection permet de déterminer
quels individus conserver et quels individus rejeter.</P><P>Un individu se caractérise par son génotype qui peut avoir différentes
représentations : "binaire" (<I>G</I> = 0, 1<SUP><I>N</I></SUP>) , "réelle" (<I>G</I> = [0, 1]<SUP><I>N</I></SUP> ou
ℝ<SUP><I>N</I></SUP>), ou sous forme de graphe.
C'est dans cet
espace génotypique que sont appliqués les différents opérateurs
de variabilité : les mécanismes de recombinaisons et de mutations. </P><P>Les algorithmes évolutionnistes utilisent principalement la mutation
ponctuelle comme illustré sur la figure <A HREF="#fig:crossover_mutation">1.1</A>. Par
exemple, en supposant que le génotype
soit une chaîne de bits, on peut définir pour chaque bit une probabilité
d'inversion : le génotype de l'individu muté peut alors différer de celui de
l'individu original de plusieurs bits. </P><P>L'opérateur de croisement dépend essentiellement du codage
utilisé. Certains travaux semblent indiquer que l'utilisation d'un opérateur
de croisement rend l'algorithme plus efficace vis-à-vis de
l'optimisation (<A HREF="#Jansen1999">Jansen and Wegener, 1999</A>), mais il demeure parfois difficile de
définir un opérateur de croisement qui ait un sens pour le codage utilisé, 
par exemple dans le cas d'évolution de
graphes (<A HREF="#Eiben1998">Eiben and Schippers, 1998</A>,<A HREF="#Stanley2002">Stanley and Miikkulainen, 2002</A>). Certains travaux se
limitent à ne définir que des opérateurs de mutation
(e.g. (<A HREF="#Back1991">Bäck et al., 1991</A>,<A HREF="#2011ACLI2061">Mouret and Doncieux, 2012</A>)).</P><P>Le génotype est ensuite décodé en phénotype afin d'être évalué.
Par exemple, un graphe, représentant le génotype, peut être
converti en un réseau de neurones, représentant le phénotype.</P><BLOCKQUOTE CLASS="figure"><DIV CLASS="center"><DIV CLASS="center"><HR WIDTH="80%" SIZE=2></DIV>
<IMG SRC="img/er_schema.png">
<DIV CLASS="caption"><TABLE CELLSPACING=6 CELLPADDING=0><TR><TD VALIGN=top ALIGN=left>Figure 1.2: <A NAME="fig:art_evolution_mono"></A> Principe général d'un algorithme évolutionniste. (a) Une
population de solutions candidates est générée aléatoirement ; (b) on obtient
une population (c) la performance (la fitness) de chaque solution est
évaluée ; (d) les solutions sont classées en fonction de leur fitness ; (f)
les solutions les mieux classées sont sélectionnées pour générer une
descendance par croisement puis mutation ; (e) la population parente est
détruite ; le cycle recommence en (b). (g) Après n générations, une population
de solutions a été trouvée.</TD></TR>
</TABLE></DIV> 
<DIV CLASS="center"><HR WIDTH="80%" SIZE=2></DIV></DIV></BLOCKQUOTE><P>Voici le pseudo-code général d'un algorithme évolutionniste (cf. figure <A HREF="#fig:art_evolution_mono">1.2</A> pour un schéma récapitulatif) :
</P><PRE>
construction et évaluation d'une <B> population initiale</B> ;
Jusqu'à atteindre un <B> critère d'arrêt</B> :
  <B> sélection</B> d'une partie de la population,
  <B> reproduction</B> des individus sélectionnés,
  <B> mutation</B> de la descendance,
  <B> évaluation</B> du degré d'adaptation de chaque individu,
  <B> remplacement</B> de la population initiale par une nouvelle population.
</PRE><!--TOC paragraph Sélection-->
<H4 CLASS="paragraph"><!--SEC ANCHOR -->Sélection</H4><!--SEC END --><P>
L'un des points clés d'un algorithme évolutionniste se situe dans le compromis
entre explorer l'espace de recherche, afin d'éviter de stagner dans un optimum
local, et exploiter les meilleurs individus obtenus, afin d'atteindre de
meilleures valeurs aux alentours. 
Trop d'exploitation entraîne une convergence vers un optimum local, ou
convergence prématurée, alors que trop d'exploration entraîne la non-convergence de l'algorithme.</P><P>Différentes méthodes de sélection des individus existent selon les algorithmes :
</P><UL CLASS="itemize"><LI CLASS="li-itemize">
La sélection par tournoi (<A HREF="#Brindle1981">Brindle, 1981</A>,<A HREF="#Miller1995">Miller and Goldberg, 1995</A>) : consiste
à effectuer un nombre arbitraire de tournois entre n individus (<I>n</I> ≥ 2) et
de choisir le ou les plus performants. Plus n augmente, plus ce type de
sélection induit une pression importante, étant donné que le tournoi a plus de
chance d'impliquer les individus de la population ayant les plus hautes
valeurs de fitness.
</LI><LI CLASS="li-itemize">La sélection par roulette (<A HREF="#Baker1987">Baker, 1987</A>): donne à chaque individu une
probabilité d'être sélectionnée proportionnelle à sa performance. 
</LI><LI CLASS="li-itemize">La sélection par rang : dans ce cas, la population est d'abord triée
par fitness. Chaque individu se voit associé un rang en fonction
de sa position. La sélection se fait ensuite de même manière que par
roulette, mais les proportions sont en relation avec le rang plutôt qu'avec
la valeur de l'évaluation. 
</LI></UL><!--TOC paragraph Remplacement-->
<H4 CLASS="paragraph"><!--SEC ANCHOR -->Remplacement</H4><!--SEC END --><P>
Certains parents sont remplacés par
certains des enfants en fonction de leurs performances respectives. Les
stratégies d'évolution (ES) n'utilisent que le remplacement,
et non la sélection, pour biaiser la recherche. Dans les ES, le remplacement
est déterministe et peut prendre deux formes, notées (µ,λ)-ES et 
(µ+λ)-ES.
Dans le remplacement (µ,λ)-ES, les µ meilleurs individus parmi
les λ enfants constituent la population suivante <I>P</I><SUP><I>t</I>+1</SUP> . <I>P</I><SUP><I>t</I></SUP> n'est
pas conservée. Il est
ainsi possible que le meilleur individu de la population <I>t</I> + 1 soit moins bon
que le meilleur individu de la population <I>t</I>. 
Le remplacement (µ+λ)-ES construit <I>P</I><SUP><I>t</I>+1</SUP> en gardant les µ meilleurs individus
de <I>P</I><SUP><I>t</I></SUP> et des λ enfants. Ainsi, si les meilleurs individus de <I>P</I><SUP><I>t</I></SUP>
restent compétitifs par rapport aux enfants, ils seront conservés (c'est la
propriété d'"élitisme").</P><P>Il existe de nombreux algorithmes évolutionnistes efficaces, comme la
stratégie d'évolution avec adaptation de matrice de covariance (CMA-ES)
(<A HREF="#Hansen2001">Hansen and Ostermeier, 2001</A>,<A HREF="#Hansen03">Hansen and Koumoutsakos, 2003</A>) qui a été reconnue comme étant une des méthodes les
plus performantes dans le cadre d'optimisation continue <EM>black box</EM> (<A HREF="#Hansen2010">Hansen et al., 2010</A>).</P><P>Cependant, de nombreux problèmes ne peuvent être réduits à un seul objectif.
Prenons le cas d'un aspirateur autonome.
Celui-ci doit posséder une grande capacité
d'aspiration, une bonne autonomie lui permettant d'explorer efficacement
différentes pièces, tout en ayant un prix d'achat raisonnable. Cela
nécessite d'optimiser plusieurs objectifs simultanément pouvant être
contradictoires. Il y a donc plusieurs compromis plutôt qu'une solution
optimale unique. 
</P><!--TOC subsection Algorithmes multi-objectifs-->
<H2 CLASS="subsection"><!--SEC ANCHOR --><A NAME="htoc6">1.4</A>  Algorithmes multi-objectifs</H2><!--SEC END --><P>
<A NAME="part:multiobj"></A> </P><P>(<A HREF="#Pareto1897">Pareto, 1897</A>) a formulé le concept suivant : dans un problème
multiobjectif, il existe un équilibre tel que l'on ne peut pas améliorer un
critère sans détériorer au moins un des autres critères.
Cet équilibre a été défini comme l'optimum de Pareto.</P><DIV CLASS="theorem"><B>Définition 9</B> <B>(dominance de Pareto)</B>  <EM> Une solution </EM><EM><I>x</I></EM><SUB><EM>1</EM></SUB><EM> est dite dominante par rapport à la solution
</EM><EM><I>x</I></EM><SUB><EM>2</EM></SUB><EM> si les conditions 1 et 2 sont vraies :
</EM><OL CLASS="enumerate" type=1><LI CLASS="li-enumerate"><EM>
</EM><EM>la solution </EM><EM><I>x</I></EM><SUB><EM>1</EM></SUB><EM> n'est pas plus mauvaise que </EM><EM><I>x</I></EM><SUB><EM>2</EM></SUB><EM> sur tous les objectifs ;
</EM></LI><LI CLASS="li-enumerate"><EM>la solution </EM><EM><I>x</I></EM><SUB><EM>1</EM></SUB><EM> est strictement meilleure que </EM><EM><I>x</I></EM><SUB><EM>2</EM></SUB><EM> pour au moins un objectif.
</EM></LI></OL><EM>
</EM></DIV><P>Un point <I>x</I><SUB><I>i</I></SUB> est dit Pareto-optimal s'il n'est dominé par aucun autre point.</P><DIV CLASS="theorem"><B>Définition 10</B> <B>(Front de Pareto)</B>  <EM> Le front de Pareto est l'ensemble des solutions non dominées
de l'espace de recherche.
</EM></DIV><P>
Un front de Pareto est représenté sur la figure <A HREF="#fig:front_pareto">1.3</A>.</P><BLOCKQUOTE CLASS="figure"><DIV CLASS="center"><DIV CLASS="center"><HR WIDTH="80%" SIZE=2></DIV>
<IMG width=400 SRC="img/front_pareto.png">
<DIV CLASS="caption"><TABLE CELLSPACING=6 CELLPADDING=0><TR><TD VALIGN=top ALIGN=left>Figure 1.3: Sur la figure suivante, on cherche à minimiser les deux objectifs
f1 et f2. Les solutions non dominées sont les points situés sur le front de
Pareto, indiqué en rouge. Le point C n'est pas sur le front de Pareto parce
qu'il est dominé par les points A et B (graphique issu de Wikipedia).</TD></TR>
</TABLE></DIV>
<A NAME="fig:front_pareto"></A>
<DIV CLASS="center"><HR WIDTH="80%" SIZE=2></DIV></DIV></BLOCKQUOTE><P>Nous pouvons distinguer 3 grandes classes de méthodes pour résoudre un problème multiobjectif :
</P><UL CLASS="itemize"><LI CLASS="li-itemize">
les méthodes agrégées;
</LI><LI CLASS="li-itemize">les méthodes non-agrégées non basées sur l'optimum de Pareto;
</LI><LI CLASS="li-itemize">les méthodes basées sur l'optimum de Pareto.
</LI></UL><!--TOC subsubsection Les méthodes agrégées-->
<H3 CLASS="subsubsection"><!--SEC ANCHOR -->1.4.1  Les méthodes agrégées</H3><!--SEC END --><P>
Dans cette classe de méthodes, les différents objectifs sont regroupés en un seul pour être optimisés.</P><!--TOC subparagraph Somme pondérée-->
<H5 CLASS="subparagraph"><!--SEC ANCHOR -->Somme pondérée</H5><!--SEC END --><P>
Cette méthode consiste à additionner tous les objectifs en leur affectant 
un coefficient de poids. Ce coefficient représente l'importance
relative que le décideur attribue à l'objectif.</P><TABLE CLASS="display dcenter"><TR VALIGN="middle"><TD CLASS="dcell">   <I>minimise</I></TD><TD CLASS="dcell"><TABLE CLASS="display"><TR><TD CLASS="dcell" ALIGN="center"><I>k</I></TD></TR>
<TR><TD CLASS="dcell" ALIGN="center"><FONT SIZE=6>∑</FONT></TD></TR>
<TR><TD CLASS="dcell" ALIGN="center"><I>i</I>=1</TD></TR>
</TABLE></TD><TD CLASS="dcell"> <I>w</I><SUB><I>i</I></SUB><I>f</I><SUB><I>i</I></SUB>(<I>x</I>)  avec  <I>w</I><SUB><I>i</I></SUB> ≤ 0
</TD></TR>
</TABLE><P>avec <I>w</I><SUB><I>i</I></SUB> représentant le poids affecté au critère <I>i</I> et ∑<SUB><I>i</I>=1</SUB><SUP><I>k</I></SUP> <I>w</I><SUB><I>i</I></SUB> = 1.</P><P>Cette méthode peut, en faisant varier les valeurs du vecteur poids <I>w</I>,
retrouver l'ensemble de solutions supportées si le domaine réalisable est
convexe.
Cependant, elle ne permet pas de trouver les solutions enfermées dans une
concavité (les solutions non supportées). Les résultats obtenus avec de
telles méthodes dépendent fortement des paramètres choisis pour le vecteur de
poids <I>w</I>. Les poids <I>w</I><SUB><I>i</I></SUB> doivent également être choisis en fonction des
préférences associées aux objectifs, ce qui est une tâche délicate. Une
approche généralement utilisée consiste à répéter l'exécution de l'algorithme
avec des vecteurs poids différents.</P><P>(<A HREF="#jin2001dynamic">Jin et al., 2001</A>) ont proposé une agrégation dynamique des 
poids et (<A HREF="#kim2006adaptive">Kim and De Weck, 2006</A>) ont présenté une méthode de 
somme pondérée adaptative.
</P><!--TOC subparagraph Goal programming-->
<H5 CLASS="subparagraph"><!--SEC ANCHOR -->Goal programming</H5><!--SEC END --><P>
Dans cette méthode, le décideur fixe un but <I>T</I><SUB><I>i</I></SUB> à atteindre pour chaque objectif <I>f</I><SUB><I>i</I></SUB> (<A HREF="#Charnes1961">Charnes and Cooper, 1961</A>). Ces
valeurs sont ajoutées au problème comme des contraintes. La nouvelle fonction
objectif est modifiée de façon à minimiser la somme des écarts entre les
résultats et les buts à atteindre.</P><TABLE CLASS="display dcenter"><TR VALIGN="middle"><TD CLASS="dcell">   <I>min</I></TD><TD CLASS="dcell"><TABLE CLASS="display"><TR><TD CLASS="dcell" ALIGN="center"><I>k</I></TD></TR>
<TR><TD CLASS="dcell" ALIGN="center"><FONT SIZE=6>∑</FONT></TD></TR>
<TR><TD CLASS="dcell" ALIGN="center"><I>i</I>=1</TD></TR>
</TABLE></TD><TD CLASS="dcell"> |<I>f</I><SUB><I>i</I></SUB>(<I>x</I>)−<I>T</I><SUB><I>i</I></SUB>|  avec  <I>x</I> ∈ <I>F</I>
</TD></TR>
</TABLE><P><I>T</I><SUB><I>i</I></SUB> représente la valeur à atteindre pour le <I>i</I><SUP><I>eme</I></SUP> objectif.</P><!--TOC subparagraph Le min-max-->
<H5 CLASS="subparagraph"><!--SEC ANCHOR -->Le min-max</H5><!--SEC END --><P> 
Il minimise le maximum de l'écart relatif entre un objectif et
son but associé par le décideur (<A HREF="#Coello1995">Coello et al., 1995</A>).</P><TABLE CLASS="display dcenter"><TR VALIGN="middle"><TD CLASS="dcell">   min max<SUB><I>i</I></SUB> </TD><TD CLASS="dcell">⎛<BR>
⎜<BR>
⎜<BR>
⎝</TD><TD CLASS="dcell"><TABLE CLASS="display"><TR><TD CLASS="dcell" ALIGN="center"><I>f</I><SUB><I>i</I></SUB>(<I>x</I>)−<I>T</I><SUB><I>i</I></SUB></TD></TR>
<TR><TD CLASS="hbar"></TD></TR>
<TR><TD CLASS="dcell" ALIGN="center"><I>T</I><SUB><I>i</I></SUB></TD></TR>
</TABLE></TD><TD CLASS="dcell"> </TD><TD CLASS="dcell">⎞<BR>
⎟<BR>
⎟<BR>
⎠</TD><TD CLASS="dcell"> avec  <I>i</I>, …, <I>k</I>
</TD></TR>
</TABLE><P>avec <I>T</I><SUB><I>i</I></SUB> le but à atteindre pour le <I>i</I><SUP><I>eme</I></SUP> objectif.
avec <I>w</I><SUB><I>i</I></SUB> le poids à un objectif.</P><!--TOC subparagraph Atteindre un point-cible-->
<H5 CLASS="subparagraph"><!--SEC ANCHOR -->Atteindre un point-cible</H5><!--SEC END --><P>
Dans cette
approche (<A HREF="#Charnes1957">Charnes and Cooper, 1957</A>,<A HREF="#Ijiri1965">Ijiri, 1965</A>,<A HREF="#Duckstein1981">Duckstein, 1981</A>)
le décideur spécifie l'ensemble des buts <I>T</I><SUB><I>i</I></SUB> qu'il souhaite atteindre et
les poids associés <I>w</I><SUB><I>i</I></SUB>. La solution
optimale est trouvée en résolvant le problème suivant : </P><TABLE CLASS="display dcenter"><TR VALIGN="middle"><TD CLASS="dcell">     minimiser  α  tel que  <I>T</I><SUB><I>i</I></SUB> + α.<I>w</I><SUB><I>i</I></SUB> &gt;= <I>f</I><SUB><I>i</I></SUB>(<I>x</I>)
</TD></TR>
</TABLE><P>Les objectifs <I>T</I><SUB><I>i</I></SUB> représentent le point de départ de la recherche dans
l'espace et les poids <I>w</I><SUB><I>i</I></SUB>
indiquent la direction de recherche dans l'espace.</P><!--TOC subparagraph La méthode par ε-contraintes-->
<H5 CLASS="subparagraph"><!--SEC ANCHOR -->La méthode par ε-contraintes</H5><!--SEC END --><P>Méthode basée sur la minimisation d'un objectif <I>f</I><SUB><I>i</I></SUB> en considérant
que les autres objectifs <I>f</I><SUB><I>j</I></SUB> avec <I>j</I> ≠ <I>i</I> doivent être inférieurs à une
valeur ε<SUB><I>j</I></SUB>. En général, l'objectif choisi est celui que le
décideur souhaite optimiser en priorité.</P><TABLE CLASS="display dcenter"><TR VALIGN="middle"><TD CLASS="dcell">     minimiser  <I>f</I><SUB><I>i</I></SUB>(<I>x</I>)  avec  <I>f</I><SUB><I>j</I></SUB>(<I>x</I>) ≤ ε<SUB><I>j</I></SUB>, ∀ <I>j</I> ≠ <I>i</I>
</TD></TR>
</TABLE><P>
De cette manière, un problème simple objectif sous contraintes peut être résolu. Le décideur peut
ensuite réitérer ce processus sur un objectif différent jusqu'à ce qu'il trouve une solution
satisfaisante.</P><!--TOC subparagraph Critiques-->
<H5 CLASS="subparagraph"><!--SEC ANCHOR -->Critiques</H5><!--SEC END --><P>
Il existe plusieurs inconvénients quant à l'utilisation de méthodes agrégées : la difficulté
de déterminer les différents paramètres; elles nécessitent de
nombreuses connaissances a priori, notamment lors de l'affectation d'un
coefficient de poids à chaque objectif; il est de plus nécessaire d'effectuer
de nombreux tests pour déterminer l'influence de chaque objectif.</P><!--TOC subsubsection Méthodes non-agrégées et non Pareto-->
<H3 CLASS="subsubsection"><!--SEC ANCHOR -->1.4.2  Méthodes non-agrégées et non Pareto</H3><!--SEC END --><!--TOC subparagraph Vector Evaluated Genetic Algorithm (VEGA) -->
<H5 CLASS="subparagraph"><!--SEC ANCHOR -->Vector Evaluated Genetic Algorithm (VEGA) </H5><!--SEC END --><P>
Première extension d'un algorithme génétique simple pour la résolution d'un problème multiobjectif (<A HREF="#Schaffer1984">Schaffer, 1984</A>).
La différence avec un algorithme génétique simple se situe au niveau de la sélection.
Pour <I>k</I> objectifs et une population de <I>n</I> individus, une
sélection de <I>n</I>/<I>k</I> individus est effectuée pour chaque objectif. 
<I>k</I> sous-populations seront créées contenant chacune les <I>n</I>/<I>k</I> meilleurs
individus pour un objectif particulier. Les <I>k</I> sous-populations sont ensuite
mélangées afin d'obtenir une nouvelle population de taille <I>n</I>.</P><!--TOC subparagraph La méthode lexicographique-->
<H5 CLASS="subparagraph"><!--SEC ANCHOR -->La méthode lexicographique</H5><!--SEC END --><P>(<A HREF="#Fourman1985">Fourman, 1985</A>)
Les objectifs sont préalablement rangés par ordre
d'importance par le décideur (<A HREF="#Fourman1985">Fourman, 1985</A>). 
L'optimum est ensuite obtenu en minimisant tout
d'abord la fonction objectif la plus importante puis la deuxième et ainsi de suite.</P><!--TOC subsubsection Les méthodes basées sur l'optimum de Pareto-->
<H3 CLASS="subsubsection"><!--SEC ANCHOR -->1.4.3  Les méthodes basées sur l'optimum de Pareto</H3><!--SEC END --><P>La première utilisation de la dominance au sens de Pareto remonte à (<A HREF="#Goldberg1989">Goldberg, 1989</A>) 
pour résoudre des problèmes proposés par (<A HREF="#Schaffer1984">Schaffer, 1984</A>).</P><DIV CLASS="theorem"><B>Définition 11</B> <B>(Convergence)</B>  <EM>
La convergence permet de mesurer à quelle distance les solutions trouvées sont du vrai front de Pareto.
</EM></DIV><DIV CLASS="theorem"><B>Définition 12</B> <B>(Dispersion)</B>  <EM>
La distribution indique comment les solutions sont bien réparties sur le vrai font de Pareto (ou son approximation).
</EM></DIV><P>Résoudre un problème multi-objectifs consiste à converger le plus rapidement
possible vers le front de Pareto (convergence), tout en gardant une
bonne distribution des solutions sur le front de Pareto (dispersion).</P><!--TOC paragraph Méthodes de première génération-->
<H4 CLASS="paragraph"><!--SEC ANCHOR -->Méthodes de première génération</H4><!--SEC END --><!--TOC subparagraph Multiple Objective Genetic Algorithm (MOGA)-->
<H5 CLASS="subparagraph"><!--SEC ANCHOR -->Multiple Objective Genetic Algorithm (MOGA)</H5><!--SEC END --><P>
Dans cette méthode (<A HREF="#Fonseca1993">Fonseca and Fleming, 1993</A>), chaque individu de la population est
rangé en fonction du nombre d'individus qui le dominent. Par la suite une
fonction de notation permet de prendre en compte le rang de l'individu et le
nombre d'individus ayant le même rang. Les individus non dominés sont de rang
1. L'évaluation de la fitness de chaque individu s'effectue en calculant le
rang de l'individu puis en affectant la fitness de chaque individu par
application d'une fonction de changement d'échelle sur la valeur de son rang. 
Cette fonction est en général linéaire. </P><P>L'utilisation de la sélection par rang a tendance à répartir la population
autour d'un même optimum ce qui n'est pas satisfaisant.
Pour éviter cette dérive, les auteurs
utilisent une fonction de partage. L'objectif est de répartir la population
sur l'ensemble du front de Pareto.</P><P>La technique de partage agit sur l'espace des objectifs. Cela suppose que deux
actions qui ont le même résultat dans l'espace des objectifs ne pourront pas
être présentes dans la population. Cette méthode obtient des solutions de
bonne qualité et son implémentation est facile. Cependant les performances
dépendent de la valeur du paramètre utilisé dans la technique de partage.</P><!--TOC subparagraph Non dominated Sorting Genetic Algorithm (NSGA)-->
<H5 CLASS="subparagraph"><!--SEC ANCHOR -->Non dominated Sorting Genetic Algorithm (NSGA)</H5><!--SEC END --><P>
Dans NSGA (<A HREF="#Srinivas1994">Srinivas and Deb, 1994</A>), le calcul de la fitness s'effectue en séparant la population
en plusieurs groupes en fonction du degré de domination
au sens de Pareto de chaque individu. L'algorithme se
déroule ensuite comme un algorithme génétique
classique. La sélection est basée sur le reste stochastique mais peut être utilisée
avec d'autres heuristiques de sélection (tournoi, roulette pipée, etc.).</P><!--TOC subparagraph Niched Pareto Genetic Algorithm (NPGA)-->
<H5 CLASS="subparagraph"><!--SEC ANCHOR -->Niched Pareto Genetic Algorithm (NPGA)</H5><!--SEC END --><P>
Cette méthode (<A HREF="#Horn1994">Horn et al., 1994</A>) utilise un tournoi basé sur
la notion de dominance de Pareto. 
La comparaison se fait sur deux
individus pris au hasard avec une sous-population de
petite taille également choisie au hasard. Si un seul de ces
deux individus domine la sous-population, il est alors
positionné dans la population suivante. Dans les autres
cas, une fonction de sharing est appliquée pour
sélectionner l'individu.</P><!--TOC subparagraph Synthèse-->
<H5 CLASS="subparagraph"><!--SEC ANCHOR -->Synthèse</H5><!--SEC END --><P>
Du fait de la non-conservation des individus Pareto-optimaux
de génération en génération dans ces méthodes dites non-élitistes,
la convergence vers le front de Pareto est lente.
De plus, elles maintiennent difficilement de la diversité sur ce front de
Pareto.
Pour contrecarrer ces limitations, des méthodes dites "élitistes" se sont
développées.
</P><!--TOC paragraph Méthodes élitistes-->
<H4 CLASS="paragraph"><!--SEC ANCHOR -->Méthodes élitistes</H4><!--SEC END --><!--TOC subparagraph Strength Pareto Evolutionary Algorithm (SPEA II)-->
<H5 CLASS="subparagraph"><!--SEC ANCHOR -->Strength Pareto Evolutionary Algorithm (SPEA II)</H5><!--SEC END --><P>
Cette méthode (<A HREF="#Zitzler2001">Zitzler et al., 2001</A>) utilise le concept de Pareto pour comparer les solutions.
Une des caractéristiques de SPEA II est de maintenir un ensemble de solutions
Pareto-optimales dans une archive. La fitness de chaque individu est calculée
en fonction des solutions stockées dans celle-ci. De plus, toutes les solutions
de l'archive participent à la sélection. Afin de maintenir une taille
d'archive raisonnable, une méthode de clustering est utilisée visant à garder
seulement les solutions les plus représentatives.
Une nouvelle méthode de niche, basée sur Pareto, est utilisée afin de préserver la
diversité. L'avantage essentiel est qu'elle n'exige pas de réglage de paramètres de sharing.</P><!--TOC subparagraph Pareto Archived Evolution Strategy (PAES)-->
<H5 CLASS="subparagraph"><!--SEC ANCHOR -->Pareto Archived Evolution Strategy (PAES)</H5><!--SEC END --><P>
L'algorithme PAES (<A HREF="#Knowles2000">Knowles and Corne, 2000</A>) est inspiré d'une stratégie
d'évolution (1+1) (<A HREF="#Rechenberg1973">Rechenberg, 1973</A>). Il n'est pas basé sur une population
et n'utilise qu'un seul individu à la fois pour la
recherche des solutions. Une population annexe de taille déterminée est
utilisée afin de permettre de stocker les solutions temporairement
Pareto-optimales.
Si une nouvelle solution est non-dominée par un membre de l'archive, il est
inclus dans l'archive, supprimant à cette occasion tous les membres qu'il
domine. Si l'archive excède une taille maximum, l'acceptation d'une nouvelle
solution est décidée par une mesure de densité basée sur une division en grille de l'espace des objectifs.</P><!--TOC subparagraph Pareto Envelope based Selection Algorithm (PESA)-->
<H5 CLASS="subparagraph"><!--SEC ANCHOR -->Pareto Envelope based Selection Algorithm (PESA)</H5><!--SEC END --><P>PESA (<A HREF="#Corne2000">Corne et al., 2000</A>)
utilise une petite population interne et une population externe plus large.
Une division en grille de l'espace des phénotypes est utilisée 
pour maintenir une diversité (application d'une mesure de densité)
durant le processus.
De plus, cette mesure de densité est utilisée pour permettre
à des solutions d'être retenues dans une archive 
externe de la même manière que dans PAES (<A HREF="#Knowles2000">Knowles and Corne, 2000</A>).
La différence entre PESA et PESA-II (<A HREF="#Corne2001">Corne et al., 2001</A>), se situe 
au niveau de la sélection. La sélection se fait d'abord sur 
une zone. Un individu est ensuite sélectionné dans cette zone.
Le but de cette approche étant de réduire le coût computationnel associé
au classement de Pareto.</P><!--TOC subparagraph Non-dominated Sorting Genetic Algorithm II (NSGA-II) -->
<H5 CLASS="subparagraph"><!--SEC ANCHOR -->Non-dominated Sorting Genetic Algorithm II (NSGA-II) </H5><!--SEC END --><P>
<A NAME="part:nsga2"></A></P><P>Outre la volonté d'assurer une bonne convergence vers le front de Pareto, ainsi
qu'une bonne dispersion des solutions dans l'espace des objectifs, l'objectif de NSGA II (<A HREF="#Deb2002">Deb et al., 2002</A>) est de proposer un algorithme d'optimisation multi-objectifs rapide.
</P><P>Une des caractéristiques de NSGA-II est d'introduire un classement des
individus en plusieurs fronts successifs suivant la relation de dominance et de
proposer également de sélectionner les
solutions en fonction d'un critère de performance et de la densité de
solutions dans leur voisinage.</P><P>À l'initialisation de l'algorithme, on génère une population de départ taille
<I>M</I>.</P><P>Pour chaque génération de l'algorithme, les opérations suivantes sont effectuées :</P><UL CLASS="itemize"><LI CLASS="li-itemize">
Grouper la population parent <I>P</I><SUB><I>t</I></SUB> et enfant <I>Q</I><SUB><I>t</I></SUB> de la génération
précédente, chacune de taille <I>M</I>, en une population <I>R</I><SUB><I>t</I></SUB>=<I>P</I><SUB><I>t</I></SUB> ∪ <I>Q</I><SUB><I>t</I></SUB>.
Réaliser un rangement de la population <I>R</I><SUB><I>t</I></SUB> par fronts <FONT COLOR=red><I>F</I></FONT><SUB><I>i</I></SUB>
successifs avec <I>i</I>=0 le front de Pareto.</LI><LI CLASS="li-itemize">Définir une nouvelle population parente pour la génération suivante
<I>P</I><SUB><I>t</I>+1</SUB>=∅ et un indice <I>i</I>=0 définissant le front de Pareto
actif. Tant que |<I>P</I><SUB><I>t</I>+1</SUB>|+|<FONT COLOR=red><I>F</I></FONT><SUB><I>i</I></SUB>|&lt;<I>M</I>, réaliser
<I>P</I><SUB><I>t</I>+1</SUB>=<I>P</I><SUB><I>t</I>+1</SUB>∪ <FONT COLOR=red><I>F</I></FONT><SUB><I>i</I></SUB> et <I>i</I>=<I>i</I>+1.</LI><LI CLASS="li-itemize">Utiliser la procédure de classement par densité de peuplement (voir
ci-dessous) au sein du front <FONT COLOR=red><I>F</I></FONT><SUB><I>i</I></SUB> et inclure les <I>M</I>−|<I>P</I><SUB><I>t</I>+1</SUB>|
solutions les plus isolées à <I>P</I><SUB><I>t</I>+1</SUB>. On a désormais |<I>P</I><SUB><I>t</I>+1</SUB>|=<I>M</I>. </LI><LI CLASS="li-itemize">Générer par sélection par tournoi, mutation et croisement, la population
fille <I>Q</I><SUB><I>t</I>+1</SUB> de taille <I>M</I> à partir de <I>P</I><SUB><I>t</I>+1</SUB>.</LI></UL><P>La procédure de classement est illustrée par la figure <A HREF="#fig:select_nsga2">1.4</A> et
l'algorithme de calcul de la distance de densité est fourni ci-dessous. 
</P><BLOCKQUOTE CLASS="figure"><DIV CLASS="center"><DIV CLASS="center"><HR WIDTH="80%" SIZE=2></DIV>
<IMG SRC="img/select_nsga2.png">
<DIV CLASS="caption"><TABLE CELLSPACING=6 CELLPADDING=0><TR><TD VALIGN=top ALIGN=left>Figure 1.4: schéma expliquant le processus de sélection de NSGA-II. 
Le classement de la population se fait par fronts successifs et en fonction
de la distance d'un
individu à ses plus proches voisins sur un même front. Lors de la sélection,
on conserve les meilleurs fronts et, lorsque la sélection se fait parmi les
individus d'un même front, on sélectionne ceux qui sont les plus isolés sur
le front.</TD></TR>
</TABLE></DIV>
<A NAME="fig:select_nsga2"></A>
<DIV CLASS="center"><HR WIDTH="80%" SIZE=2></DIV></DIV></BLOCKQUOTE><PRE CLASS="verbatim">l=|I|
pour chaque i de F:
  définir I[i]=0
pour chaque objectif m de M:
  classer F par rapport à l'objectif m
  définir la distance des extrémités du front (i=0 et i=l) à la valeur max
  pour i = 1 à l-1:
    I[i]=I[i]+(Vm[i+1]-Vm[i-1])
</PRE><P>avec <I>i</I> un individu du front de Pareto <I>F</I>, <I>I</I>[<I>i</I>] la mesure de densité pour
l'individu <I>i</I> et <I>Vm</I>[<I>i</I>] correspond à la valeur de l'objectif <I>m</I> pour le
point <I>i</I>. </P><P>Le processus de sélection par distance au sein d'un même front permet de
favoriser les individus les plus éloignés les uns des autres tant qu'ils
appartiennent à un même front. L'objectif est d'obtenir, à la convergence de
l'algorithme, la quasi totalité de la population sur un seul front : le front
des solutions Pareto optimales accessibles du problème. Une fois cette
situation atteinte, la sélection se fait uniquement en fonction de la distance
entre solutions, en vue de couvrir au mieux ce front.</P><P>Finalement, la sélection des individus pour la création d'une population fille
<I>Q</I><SUB><I>t</I>+1</SUB> à partir de la population <I>P</I><SUB><I>t</I>+1</SUB> se fait en utilisant un opérateur
de tournoi basé sur la distance (“Crowded Tournament Selection Operator”)
fourni dans la définition <A HREF="#def:ctso">13</A>. Cet opérateur est appliqué entre
n individus tirés au hasard dans la population <I>P</I><SUB><I>t</I>+1</SUB>.</P><DIV CLASS="theorem"><B>Définition 13</B>  <A NAME="def:ctso"></A><EM>
Un individu </EM><EM><I>i</I></EM><EM> gagne un tournoi contre un individu </EM><EM><I>j</I></EM><EM> si et seulement si une
des deux conditions suivantes est vraie:</EM><UL CLASS="itemize"><LI CLASS="li-itemize"><EM>
</EM><EM><I>i</I></EM><EM> a un meilleur rang que </EM><EM><I>j</I></EM><EM> (l'indice du front de Pareto de </EM><EM><I>i</I></EM><EM>
est inférieur à celui de </EM><EM><I>j</I></EM><EM>).</EM></LI><LI CLASS="li-itemize"><EM>Si </EM><EM><I>i</I></EM><EM> et </EM><EM><I>j</I></EM><EM> appartiennent au même front mais si </EM><EM><I>i</I></EM><EM> est plus isolé
que </EM><EM><I>j</I></EM><EM> sur le front de Pareto (sa mesure de distance est plus grande).</EM></LI></UL></DIV><P>L'implémentation de l'algorithme, proposée initialement par Deb, a une
complexité en <I>O</I>(<I>MN</I><SUP>2</SUP>). Une implémentation de l'algorithme utilisant des
arbres binaires pour le classement des solutions par fronts (<A HREF="#Jensen2003">Jensen, 2003</A>)
permet de réduire
cette complexité à <I>O</I>(<I>Nlog</I><SUP><I>M</I>−1</SUP><I>N</I>), mais son implémentation est délicate si le
nombre d'objectifs est supérieur à 2.</P><!--TOC subparagraph ε-Multiobjective Evolutionary Algorithm, (ε-MOEA)-->
<H5 CLASS="subparagraph"><!--SEC ANCHOR -->ε-Multiobjective Evolutionary Algorithm, (ε-MOEA)</H5><!--SEC END --><P>L'ε-MOEA (<A HREF="#Laumanns2002">Laumanns et al., 2002</A>,<A HREF="#Deb2005">Deb et al., 2005</A>) repose sur une version modifiée de la
relation de dominance :
l'ε-dominance (<A HREF="#Laumanns2002">Laumanns et al., 2002</A>,<A HREF="#Grosan2004">Grocsan and Oltean, 2004</A>,<A HREF="#Deb2005">Deb et al., 2005</A>).
Soit ε un vecteur quelconque de <I>n</I> réels strictement
positifs, <I>n</I> étant
le nombre d'objectifs optimisés, on dit que la solution <I>x</I><SUB>1</SUB>
ε-domine la solution <I>x</I><SUB>2</SUB> si :</P><TABLE CLASS="display dcenter"><TR VALIGN="middle"><TD CLASS="dcell"><TABLE CLASS="display"><TR VALIGN="middle"><TD CLASS="dcell">⎧<BR>
⎪<BR>
⎨<BR>
⎪<BR>
⎩</TD><TD CLASS="dcell"><TABLE CELLSPACING=6 CELLPADDING=0><TR><TD ALIGN=center NOWRAP>      ∀ <I>i</I> ∈ [1, <I>n</I>], <I>f</I><SUB><I>i</I></SUB>(<I>x</I><SUB>1</SUB>) + ε<SUB><I>i</I></SUB> ≥ <I>f</I><SUB><I>i</I></SUB>(<I>x</I><SUB>2</SUB>)</TD></TR>
<TR><TD ALIGN=center NOWRAP>      ∃ <I>i</I> ∈ [1, <I>n</I>], <I>f</I><SUB><I>i</I></SUB>(<I>x</I><SUB>1</SUB>) + ε<SUB><I>i</I></SUB> &gt; <I>f</I><SUB><I>i</I></SUB>(<I>x</I><SUB>2</SUB>)</TD></TR>
<TR><TD ALIGN=center NOWRAP>    </TD></TR>
</TABLE></TD></TR>
</TABLE></TD></TR>
</TABLE><P>Avec l'ε-dominance, une solution domine toutes les solutions qui ne sont
pas suffisamment meilleures qu'elle, sur au moins un objectif, c'est-à-dire si
la différence sur un objectif ne dépasse pas la valeur ε<SUB><I>i</I></SUB>
correspondante. 
A noter que le front de Pareto ε-approché défini par la relation
d'ε-dominance n'est pas unique.</P><P>La relation d'ε-dominance possède de bonnes propriétés théoriques
(voir par exemple (<A HREF="#Laumanns2002">Laumanns et al., 2002</A>)). Elle assure notamment une
bonne convergence et une bonne dispersion des solutions du front de Pareto
ε-approché vis-à-vis du front de Pareto “exact” défini par la
relation de dominance. Le front de Pareto ε-approché a également
une taille bornée en fonction des valeurs d'ε utilisées.</P><P>L'algorithme ε-MOEA (<A HREF="#Laumanns2002">Laumanns et al., 2002</A>,<A HREF="#Deb2005">Deb et al., 2005</A>)
utilise cette relation d'ε-dominance en plus de la relation de
dominance classique. Il repose sur deux ensembles d'individus, une population
et une archive contenant les solutions non-dominées trouvées. A chaque étape,
deux parents sont sélectionnés, un dans la population et un dans l'archive, et
sont utilisés pour générer deux enfants.
Ces nouveaux individus sont ensuite intégrés à la population selon la relation
classique de dominance et ajoutés à l'archive selon la relation
d'ε-dominance. L'idée principale est d'assurer une bonne dispersion
des solutions non-dominées dans l'espace des
objectifs, en ne gardant que quelques solutions représentatives le long du
front dans l'archive. Suivant les valeurs ε<SUB><I>i</I></SUB> fixées pour chaque
objectif, l'utilisateur peut ainsi intégrer de l'information dans le processus
d'optimisation en indiquant l'écart sur chaque objectif à partir duquel deux
solutions seront effectivement différentes de son point de
vue (<A HREF="#Laumanns2002">Laumanns et al., 2002</A>).</P><P>L'algorithme ε-MOEA permet ainsi d'obtenir de bonnes performances
en termes de convergence et de dispersion des solutions tout en ayant un coût
computationnel moins élevé que SPEA et NSGA-II. Néanmoins, le choix des valeurs
ε<SUB><I>i</I></SUB> a une influence évidente sur
l'approximation finale du front de Pareto. D'autre part, la densité de
solutions peut également être variable le long du front et l'utilisation d'une
constante ε<SUB><I>i</I></SUB> par objectif risque d'entraîner un
sous-échantillonnage de certaines zones par rapport à
d'autres.</P><!--TOC subsubsection Algorithmes utilisant l'indicateur d'hypervolume-->
<H3 CLASS="subsubsection"><!--SEC ANCHOR -->1.4.4  Algorithmes utilisant l'indicateur d'hypervolume</H3><!--SEC END --><P>
<A NAME="section:hypervolume"></A></P><P>L'hypervolume (<A HREF="#Zitzler1999">Zitzler and Thiele, 1999</A>,<A HREF="#Knowles2002">Knowles, 2002</A>) est un indicateur permettant de
mesurer et comparer la qualité des solutions finales dans des algorithmes à
base de population.
Cet indicateur représente le volume d'espace à <I>N</I> dimensions dominé par une
ou plusieurs solutions à un problème à <I>N</I> objectifs (voir figure
<A HREF="#fig:hypervolume">1.5</A>). 
Il est calculé relativement à un point arbitraire facilement accessible et
dominé. L'hypervolume couvert entre ce point et les points positionnés sur
le front
de Pareto de l'expérience représente l'hypervolume de ces solutions. 
L'ajout d'une solution non-dominée
au front ajoute automatiquement de l'espace à l'hypervolume de ce front. 
L'indicateur d'hypervolume a été originellement proposé et employé
comme mesure de performance pour comparer différents MOEA (<A HREF="#Zitzler1999">Zitzler and Thiele, 1999</A>).
Il a par la suite été intégré dans le processus
d'optimisation (<A HREF="#Knowles2002">Knowles, 2002</A>). Dans ce cas, il décrivait une stratégie pour
maintenir une archive séparée et bornée de solutions dominées basées sur cet
indicateur.</P><P>L'hypervolume est le seul indicateur connu
pour être strictement monotone en ce qui concerne
la dominance de Pareto : à chaque fois 
qu'une approximation du front de Pareto domine entièrement
un autre, alors la valeur de l'indicateur d'hypervolume sera plus grand (<A HREF="#Bader2011">Bader and Zitzler, 2011</A>).
</P><BLOCKQUOTE CLASS="figure"><DIV CLASS="center"><DIV CLASS="center"><HR WIDTH="80%" SIZE=2></DIV>
<IMG SRC="img/hypervolume.png">
<DIV CLASS="caption"><TABLE CELLSPACING=6 CELLPADDING=0><TR><TD VALIGN=top ALIGN=left>Figure 1.5: illustration du concept d'hypervolume: l'hypervolume, représenté ici
pour 2 objectifs correspond à la surface dominée par les solutions 1 et
2 par rapport au point de référence <I>Z</I><SUB><I>ref</I></SUB>. L'ajout de solutions, si
elles sont non dominées (3 et 4) augmente la surface de l'hypervolume.</TD></TR>
</TABLE></DIV><P><A NAME="fig:hypervolume"></A>
</P><DIV CLASS="center"><HR WIDTH="80%" SIZE=2></DIV></DIV></BLOCKQUOTE><P>De nombreux MOEA intègrent l'indicateur d'hypervolume durant le processus d'optimisation. 
Parmi eux nous pouvons noter :
ESP (<A HREF="#Huband2003">Huband et al., 2003</A>), IBEA (<A HREF="#Zitzler2004">Zitzler and Künzli, 2004</A>) (en combinaison avec
l'indicateur ε), SIBEA (<A HREF="#Brockhoff2007">Brockhoff and Zitzler, 2007</A>), SMS-EMOA (<A HREF="#Beume2007">Beume et al., 2007</A>)
ou HypE (<A HREF="#Bader2011">Bader and Zitzler, 2011</A>).</P><P>Une version mutli-objectifs de CMA-ES, MO-CMA-ES (<A HREF="#Igel2007">Igel et al., 2007</A>) a été développée. Le principe est le suivant :
une population d'individus, qui adaptent leur stratégie
de recherche comme dans CMA-ES, est maintenue. 
Pour la sélection, Les individus sont triés en fonction de leur niveau de non-dominance reprenant le même principe que dans NSGA-II.
Afin de classer les individus qui ont le même niveau de dominance, 
deux critères sont considérés : la distance par densité de peuplement et
l'hypervolume ajouté par l'individu.</P><P>La limitation liée
Différentes implémentations ont été proposées pour tenter 
de réduire ce coût computationnel comme (<A HREF="#Fonseca2006">Fonseca et al., 2006</A>) basée sur
une méthode "<EM>dimension-sweep</EM>" avec une complexité de <I>O</I>(<I>N</I><SUP><I>n</I>−2</SUP>log<I>N</I>), (<A HREF="#Beume2006">Beume and Rudolph, 2006</A>) <I>O</I>(<I>N</I> log<I>N</I> + <I>N</I><SUP><I>n</I>/2</SUP>), ou 
encore (<A HREF="#Yang2007">Yang and Ding, 2007</A>) qui décrit un algorithme avec une complexité
de <I>O</I>((<I>n</I>/2)<SUP><I>N</I></SUP>).</P><P>D'autres méthodes ont été envisagées, comme automatiquement réduire le nombre
d'objectifs (<A HREF="#Brockhoff2007">Brockhoff and Zitzler, 2007</A>) ou approximer les valeurs de l'indicateur
d'hypervolume en utilisant des méthodes de Monte Carlo (<A HREF="#Everson2002">Everson and Fieldsend, 2002</A>,<A HREF="#Bader2011">Bader and Zitzler, 2011</A>).
L'idée principale dans le deuxième cas repose sur le
fait que ce ne sont pas les valeurs de l'indicateur d'hypervolume qui sont
importantes, mais plutôt le classement induit par cet indicateur.</P>

<H1 CLASS="chapter"><!--SEC ANCHOR -->Références</H1><!--SEC END --><DL CLASS="thebibliography"><DT CLASS="dt-thebibliography">
<A NAME="Back1991"><FONT COLOR=purple>[Bäck et al., 1991]</FONT></A></DT><DD CLASS="dd-thebibliography">
Bäck, T., Hoffmeister, F., and Schwefel, H. P. (1991).
A survey of evolution strategies.
<EM>Proceedings of the 4th International Conference on Genetic
ALgorithms and their Applications</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Bader2011"><FONT COLOR=purple>[Bader and Zitzler, 2011]</FONT></A></DT><DD CLASS="dd-thebibliography">
Bader, J. and Zitzler, E. (2011).
HypE: An algorithm for fast hypervolume-based many-objective
optimization.
<EM>Evolutionary Computation</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Baker1987"><FONT COLOR=purple>[Baker, 1987]</FONT></A></DT><DD CLASS="dd-thebibliography">
Baker, J. E. (1987).
Reducing bias and inefficiency in the selection algorithm.
In <EM>Proceedings of the Second International Conference on Genetic
Algorithms on Genetic algorithms and their application</EM>, pages 14–21,
Hillsdale, NJ, USA. L. Erlbaum Associates Inc.</DD><DT CLASS="dt-thebibliography"><A NAME="bekele2007multi"><FONT COLOR=purple>[Bekele and Nicklow, 2007]</FONT></A></DT><DD CLASS="dd-thebibliography">
Bekele, E. G. and Nicklow, J. W. (2007).
Multi-objective automatic calibration of SWAT using NSGA-II.
<EM>Journal of Hydrology</EM>, 341(3-4):165–176.</DD><DT CLASS="dt-thebibliography"><A NAME="Beume2007"><FONT COLOR=purple>[Beume et al., 2007]</FONT></A></DT><DD CLASS="dd-thebibliography">
Beume, N., Naujoks, B., and Emmerich, M. (2007).
SMS-EMOA: Multiobjective selection based on dominated hypervolume.
<EM>European Journal of Operational Research</EM>, 181(3):1653–1669.</DD><DT CLASS="dt-thebibliography"><A NAME="Beume2006"><FONT COLOR=purple>[Beume and Rudolph, 2006]</FONT></A></DT><DD CLASS="dd-thebibliography">
Beume, N. and Rudolph, G. (2006).
Faster S-Metric Calculation by Considering Dominated Hypervolume as
Klee's Measure Problem.
In <EM>Proceedings of the Second IASTED Conference on Computational
Intelligence (CI 2006)</EM>, pages 231—-236.</DD><DT CLASS="dt-thebibliography"><A NAME="Brindle1981"><FONT COLOR=purple>[Brindle, 1981]</FONT></A></DT><DD CLASS="dd-thebibliography">
Brindle, A. (1981).
<EM>Genetic algorithms for function optimization</EM>.
PhD thesis, University of Alberta, Department of Computer Science.</DD><DT CLASS="dt-thebibliography"><A NAME="Brockhoff2007"><FONT COLOR=purple>[Brockhoff and Zitzler, 2007]</FONT></A></DT><DD CLASS="dd-thebibliography">
Brockhoff, D. and Zitzler, E. (2007).
Improving hypervolume-based multiobjective evolutionary algorithms
by using objective reduction methods.
<EM>Evolutionary Computation, 2007. CEC</EM>, pages 2086–2093.</DD><DT CLASS="dt-thebibliography"><A NAME="Charnes1957"><FONT COLOR=purple>[Charnes and Cooper, 1957]</FONT></A></DT><DD CLASS="dd-thebibliography">
Charnes, A. and Cooper, W. W. (1957).
Management models and industrial applications of linear
programming.
<EM>Management Science</EM>, 4(1):38–91.</DD><DT CLASS="dt-thebibliography"><A NAME="Charnes1961"><FONT COLOR=purple>[Charnes and Cooper, 1961]</FONT></A></DT><DD CLASS="dd-thebibliography">
Charnes, A. and Cooper, W. W. (1961).
<EM>Management Models and Industrial Applications of Linear
Programming, vol. 1</EM>.
John Wiley, New York, New York, USA.</DD><DT CLASS="dt-thebibliography"><A NAME="coello2006evolutionary"><FONT COLOR=purple>[Coello, 2006]</FONT></A></DT><DD CLASS="dd-thebibliography">
Coello, C. A. (2006).
Evolutionary multi-objective optimization: a historical view of the
field.
<EM>Computational Intelligence Magazine, IEEE</EM>, 1(1):28–36.</DD><DT CLASS="dt-thebibliography"><A NAME="Coello1995"><FONT COLOR=purple>[Coello et al., 1995]</FONT></A></DT><DD CLASS="dd-thebibliography">
Coello, C. A., Christiansen, A. D., and Aguirre, A. H. (1995).
Multiobjective Design Optimization of Counterweight Balancing of a
Robot Arm using Genetic Algorithms.
In <EM>Proceedings of the Seventh International Conference on Tools
with Artificial Intelligence</EM>, TAI '95, pages 20—-23, Washington, DC, USA.
IEEE Computer Society.</DD><DT CLASS="dt-thebibliography"><A NAME="coello2004applications"><FONT COLOR=purple>[Coello and Lamont, 2004]</FONT></A></DT><DD CLASS="dd-thebibliography">
Coello, C. A. and Lamont, G. B. (2004).
<EM>Applications of multi-objective evolutionary algorithms</EM>,
volume 1.
World Scientific Publishing Company Incorporated.</DD><DT CLASS="dt-thebibliography"><A NAME="Corne2001"><FONT COLOR=purple>[Corne et al., 2001]</FONT></A></DT><DD CLASS="dd-thebibliography">
Corne, D., Jerram, N. R., Knowles, J. D., Oates, M. J., and J, M. (2001).
PESA-II: Region-based Selection in Evolutionary Multiobjective
Optimization.
In <EM>Proceedings of the Genetic and Evolutionary Computation
Conference (GECCO'2001</EM>, pages 283–290. Morgan Kaufmann Publishers.</DD><DT CLASS="dt-thebibliography"><A NAME="Corne2000"><FONT COLOR=purple>[Corne et al., 2000]</FONT></A></DT><DD CLASS="dd-thebibliography">
Corne, D. W., Knowles, J. D., and Oates, M. J. (2000).
The Pareto Envelope-Based Selection Algorithm for Multi-objective
Optimisation.
In <EM>Proceedings of the 6th International Conference on Parallel
Problem Solving from Nature</EM>, PPSN VI, pages 839–848, London, UK, UK.
Springer-Verlag.</DD><DT CLASS="dt-thebibliography"><A NAME="Cramer1985"><FONT COLOR=purple>[Cramer, 1985]</FONT></A></DT><DD CLASS="dd-thebibliography">
Cramer, N. L. (1985).
A Representation for the Adaptive Generation of Simple Sequential
Programs.
In <EM>Proceedings of the 1st International Conference on Genetic
Algorithms</EM>, pages 183–187, Hillsdale, NJ, USA. L. Erlbaum Associates Inc.</DD><DT CLASS="dt-thebibliography"><A NAME="Darwin1859"><FONT COLOR=purple>[Darwin, 1859]</FONT></A></DT><DD CLASS="dd-thebibliography">
Darwin, C. (1859).
<EM>Origin of Species</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="DeJong1975"><FONT COLOR=purple>[De Jong, 1975]</FONT></A></DT><DD CLASS="dd-thebibliography">
De Jong, K. A. (1975).
<EM>An analysis of the behavior of a class of genetic adaptive
systems.</EM>
PhD thesis, Ann Arbor, MI, USA.</DD><DT CLASS="dt-thebibliography"><A NAME="Deb2005"><FONT COLOR=purple>[Deb et al., 2005]</FONT></A></DT><DD CLASS="dd-thebibliography">
Deb, K., Mohan, M., and Mishra, S. (2005).
Evaluating the ε-domination based multi-objective
evolutionary algorithm for a quick computation of pareto-optimal solutions.
<EM>Evolutionary Computation</EM>, 13(4):501–525.</DD><DT CLASS="dt-thebibliography"><A NAME="Deb2002"><FONT COLOR=purple>[Deb et al., 2002]</FONT></A></DT><DD CLASS="dd-thebibliography">
Deb, K., Pratap, A., Agarwal, S., and Meyarivan, T. (2002).
A fast and elitist multiobjective genetic algorithm : NSGA-II.
<EM>Evolutionary Computation, IEEE Transactions on</EM>, 6(2):182–197.</DD><DT CLASS="dt-thebibliography"><A NAME="Duckstein1981"><FONT COLOR=purple>[Duckstein, 1981]</FONT></A></DT><DD CLASS="dd-thebibliography">
Duckstein, L. (1981).
Multiobjective optimization in structural design: The model choice
problem.
Technical report, DTIC Document.</DD><DT CLASS="dt-thebibliography"><A NAME="Eiben1998"><FONT COLOR=purple>[Eiben and Schippers, 1998]</FONT></A></DT><DD CLASS="dd-thebibliography">
Eiben, A. E. and Schippers, C. A. (1998).
On evolutionary exploration and exploitation.
<EM>Fundamenta Informaticae</EM>, 35(1):35–50.</DD><DT CLASS="dt-thebibliography"><A NAME="Eiben2003"><FONT COLOR=purple>[Eiben and Smith, 2003]</FONT></A></DT><DD CLASS="dd-thebibliography">
Eiben, A. E. and Smith, J. E. (2003).
<EM>Introduction to evolutionary computing</EM>.
Springer.</DD><DT CLASS="dt-thebibliography"><A NAME="Everson2002"><FONT COLOR=purple>[Everson and Fieldsend, 2002]</FONT></A></DT><DD CLASS="dd-thebibliography">
Everson, R. and Fieldsend, J. (2002).
Full elite sets for multi-objective optimisation.
<EM>Adaptive Computing in</EM>, (Acdm):1–12.</DD><DT CLASS="dt-thebibliography"><A NAME="Fogel1991a"><FONT COLOR=purple>[Fogel, 1991]</FONT></A></DT><DD CLASS="dd-thebibliography">
Fogel, D. B. (1991).
<EM>System Identification through Simulated Evolution: A Machine
Learning Approach to Modeling</EM>.
Ginn Press.</DD><DT CLASS="dt-thebibliography"><A NAME="Fogel1962"><FONT COLOR=purple>[Fogel, 1962]</FONT></A></DT><DD CLASS="dd-thebibliography">
Fogel, L. J. (1962).
Autonomous automata.
<EM>Industrial Research</EM>, 4:14–19.</DD><DT CLASS="dt-thebibliography"><A NAME="Fonseca1993"><FONT COLOR=purple>[Fonseca and Fleming, 1993]</FONT></A></DT><DD CLASS="dd-thebibliography">
Fonseca, C. M. and Fleming, P. J. (1993).
Genetic Algorithms for Multiobjective Optimization: Formulation :
Discussion and Generalization.
In <EM>Proceedings of the 5th International Conference on Genetic
Algorithms</EM>, pages 416–423, San Francisco, CA, USA. Morgan Kaufmann
Publishers Inc.</DD><DT CLASS="dt-thebibliography"><A NAME="Fonseca2006"><FONT COLOR=purple>[Fonseca et al., 2006]</FONT></A></DT><DD CLASS="dd-thebibliography">
Fonseca, C. M., Paquete, L., and López-Ibáñez, M. (2006).
An Improved Dimension-Sweep Algorithm for the Hypervolume
Indicator.
In <EM>Congress on Evolutionary Computation (CEC 2006)</EM>, pages 1157
—-1163.</DD><DT CLASS="dt-thebibliography"><A NAME="Fourman1985"><FONT COLOR=purple>[Fourman, 1985]</FONT></A></DT><DD CLASS="dd-thebibliography">
Fourman, M. P. (1985).
Compaction of Symbolic Layout Using Genetic Algorithms.
In <EM>Proceedings of the 1st International Conference on Genetic
Algorithms</EM>, pages 141–153, Hillsdale, NJ, USA. L. Erlbaum Associates Inc.</DD><DT CLASS="dt-thebibliography"><A NAME="Fraser1957"><FONT COLOR=purple>[Fraser, 1957]</FONT></A></DT><DD CLASS="dd-thebibliography">
Fraser, A. S. (1957).
Simulation of Genetic Systems by Automatic Digital Computers. I.
Introduction.
<EM>Australian Journal of Biological Sciences</EM>, 10:484–491.</DD><DT CLASS="dt-thebibliography"><A NAME="Goldberg1989"><FONT COLOR=purple>[Goldberg, 1989]</FONT></A></DT><DD CLASS="dd-thebibliography">
Goldberg, D. E. (1989).
<EM>Genetic Algorithms in Search, Optimization, and Machine
Learning</EM>.
Addison-Wesley.</DD><DT CLASS="dt-thebibliography"><A NAME="Grosan2004"><FONT COLOR=purple>[Grocsan and Oltean, 2004]</FONT></A></DT><DD CLASS="dd-thebibliography">
Gro\csan, C. and Oltean, M. (2004).
Improving the performance of evolutionary algorithms for the
multiobjective 0/1 knapsack probl em using \varepsilon-dominance.
<EM>Computational Science-ICCS 2004</EM>, pages 674–677.</DD><DT CLASS="dt-thebibliography"><A NAME="haldane1932causes"><FONT COLOR=purple>[Haldane, 1932]</FONT></A></DT><DD CLASS="dd-thebibliography">
Haldane, J. B. S. (1932).
The causes of evolution.</DD><DT CLASS="dt-thebibliography"><A NAME="Hansen2010"><FONT COLOR=purple>[Hansen et al., 2010]</FONT></A></DT><DD CLASS="dd-thebibliography">
Hansen, N., Auger, A., Finck, S., and Ros, R. (2010).
Real-parameter black-box optimization benchmarking 2010:
Experimental setup.</DD><DT CLASS="dt-thebibliography"><A NAME="Hansen03"><FONT COLOR=purple>[Hansen and Koumoutsakos, 2003]</FONT></A></DT><DD CLASS="dd-thebibliography">
Hansen, N. and Koumoutsakos, P. (2003).
Reducing the Time Complexity of the Derandomized Evolution Strategy
with Covariance Matrix Adaptation (CMA-ES).
<EM>Evolutionary Computation</EM>, 11:1–18.</DD><DT CLASS="dt-thebibliography"><A NAME="Hansen2001"><FONT COLOR=purple>[Hansen and Ostermeier, 2001]</FONT></A></DT><DD CLASS="dd-thebibliography">
Hansen, N. and Ostermeier, a. (2001).
Completely derandomized self-adaptation in evolution strategies.
<EM>Evolutionary computation</EM>, 9(2):159–95.</DD><DT CLASS="dt-thebibliography"><A NAME="Holland1975"><FONT COLOR=purple>[Holland, 1975]</FONT></A></DT><DD CLASS="dd-thebibliography">
Holland, J. H. (1975).
<EM>Adaptation in Natural and Artificial Systems</EM>, volume Ann
Arbor.
University of Michigan Press.</DD><DT CLASS="dt-thebibliography"><A NAME="Horn1994"><FONT COLOR=purple>[Horn et al., 1994]</FONT></A></DT><DD CLASS="dd-thebibliography">
Horn, J., Nafpliotis, N., and Goldberg, D. (1994).
A niched Pareto genetic algorithm for multiobjective optmization.
In <EM>First IEEE Conference on Evolutionary Computation, IEEE World
Congress on Computational Intelligence, Volume 1</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Hornby2011"><FONT COLOR=purple>[Hornby et al., 2011]</FONT></A></DT><DD CLASS="dd-thebibliography">
Hornby, G. S., Lohn, J., and Linden, D. S. (2011).
Computer-automated evolution of an x-band antenna for nasa's space
technology 5 mission.
<EM>Evolutionary Computation</EM>, (x).</DD><DT CLASS="dt-thebibliography"><A NAME="Huband2003"><FONT COLOR=purple>[Huband et al., 2003]</FONT></A></DT><DD CLASS="dd-thebibliography">
Huband, S., Hingston, P., and While, L. (2003).
An evolution strategy with probabilistic mutation for
multi-objective optimisation.
<EM>Evolutionary</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Igel2007"><FONT COLOR=purple>[Igel et al., 2007]</FONT></A></DT><DD CLASS="dd-thebibliography">
Igel, C., Hansen, N., and Roth, S. (2007).
Covariance matrix adaptation for multi-objective optimization.
<EM>Evolutionary computation</EM>, 15(1):1–28.</DD><DT CLASS="dt-thebibliography"><A NAME="Ijiri1965"><FONT COLOR=purple>[Ijiri, 1965]</FONT></A></DT><DD CLASS="dd-thebibliography">
Ijiri, Y. (1965).
<EM>Management goals and accounting for control</EM>.
North-Holland Publishing Company.</DD><DT CLASS="dt-thebibliography"><A NAME="Jansen1999"><FONT COLOR=purple>[Jansen and Wegener, 1999]</FONT></A></DT><DD CLASS="dd-thebibliography">
Jansen, T. and Wegener, I. (1999).
On the analysis of evolutionary algorithms - a proof that crossover
really can help.
<EM>Algorithms-ESA'99</EM>, page 700.</DD><DT CLASS="dt-thebibliography"><A NAME="Jensen2003"><FONT COLOR=purple>[Jensen, 2003]</FONT></A></DT><DD CLASS="dd-thebibliography">
Jensen, M. (2003).
Reducing the run-time complexity of multiobjective EAs: The NSGA-II
and other algorithms.
<EM>Evolutionary Computation, IEEE Transactions on</EM>, 7(5):503–515.</DD><DT CLASS="dt-thebibliography"><A NAME="jin2001dynamic"><FONT COLOR=purple>[Jin et al., 2001]</FONT></A></DT><DD CLASS="dd-thebibliography">
Jin, Y., Olhofer, M., and Sendhoff, B. (2001).
Dynamic weighted aggregation for evolutionary multi-objective
optimization: Why does it work and how.
In <EM>Proceedings of the Genetic and Evolutionary Computation
Conference (GECCO'2001)</EM>, pages 1042–1049.</DD><DT CLASS="dt-thebibliography"><A NAME="kim2006adaptive"><FONT COLOR=purple>[Kim and De Weck, 2006]</FONT></A></DT><DD CLASS="dd-thebibliography">
Kim, I. Y. and De Weck, O. L. (2006).
Adaptive weighted sum method for multiobjective optimization: a new
method for Pareto front generation.
<EM>Structural and Multidisciplinary Optimization</EM>, 31(2):105–116.</DD><DT CLASS="dt-thebibliography"><A NAME="Knowles2002"><FONT COLOR=purple>[Knowles, 2002]</FONT></A></DT><DD CLASS="dd-thebibliography">
Knowles, J. D. (2002).
<EM>Local-search and hybrid evolutionary algorithms for Pareto
optimization</EM>.
PhD thesis.</DD><DT CLASS="dt-thebibliography"><A NAME="Knowles2000"><FONT COLOR=purple>[Knowles and Corne, 2000]</FONT></A></DT><DD CLASS="dd-thebibliography">
Knowles, J. D. and Corne, D. (2000).
Approximating the Nondominated Front Using the Pareto Archived
Evolution Strategy.
<EM>Evolutionary computation</EM>, 8:149—-172.</DD><DT CLASS="dt-thebibliography"><A NAME="Koza1992"><FONT COLOR=purple>[Koza, 1992]</FONT></A></DT><DD CLASS="dd-thebibliography">
Koza, J. R. (1992).
<EM>Genetic Programming: On the Programming of Computers by Means
of Natural Selection</EM>, volume 229.
MIT Press.</DD><DT CLASS="dt-thebibliography"><A NAME="Koza2003"><FONT COLOR=purple>[Koza et al., 2003]</FONT></A></DT><DD CLASS="dd-thebibliography">
Koza, J. R., Keane, M. A., Streeter, M. J., Mydlowec, W., Yu, J., and Lanza, G.
(2003).
<EM>Genetic programming IV: Routine human-competitive machine
intelligence</EM>.
Springer.</DD><DT CLASS="dt-thebibliography"><A NAME="lahanas2003hybrid"><FONT COLOR=purple>[Lahanas et al., 2003]</FONT></A></DT><DD CLASS="dd-thebibliography">
Lahanas, M., Baltas, D., and Zamboglou, N. (2003).
A hybrid evolutionary algorithm for multi-objective anatomy-based
dose optimization in high-dose-rate brachytherapy.
<EM>Physics in medicine and biology</EM>, 48:399.</DD><DT CLASS="dt-thebibliography"><A NAME="lahanas2004inverse"><FONT COLOR=purple>[Lahanas et al., 2004]</FONT></A></DT><DD CLASS="dd-thebibliography">
Lahanas, M., Karouzakis, K., Giannouli, S., Mould, R., and Baltas, D. (2004).
Inverse planning in brachytherapy: Radium to high dose rate 192
iridium afterloading.
<EM>Nowotwory Journal of Oncology</EM>, 54(6):547–554.</DD><DT CLASS="dt-thebibliography"><A NAME="Laumanns2002"><FONT COLOR=purple>[Laumanns et al., 2002]</FONT></A></DT><DD CLASS="dd-thebibliography">
Laumanns, M., Thiele, L., Deb, K., and Zitzler, E. (2002).
Combining convergence and diversity in evolutionary multiobjective
optimization.
<EM>Evolutionary computation</EM>, 10(3):263–82.</DD><DT CLASS="dt-thebibliography"><A NAME="Lohn2004"><FONT COLOR=purple>[Lohn et al., 2004]</FONT></A></DT><DD CLASS="dd-thebibliography">
Lohn, J. D., Hornby, G. S., and Linden, D. S. (2004).
An evolved antenna for deployment on nasa's space technology 5
mission.
In <EM>Genetic Programming Theory and Practice Workshop</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="mayr1942systematics"><FONT COLOR=purple>[Mayr, 1942]</FONT></A></DT><DD CLASS="dd-thebibliography">
Mayr, E. (1942).
<EM>Systematics and the origin of species, from the viewpoint of a
zoologist</EM>.
Harvard Univ Pr.</DD><DT CLASS="dt-thebibliography"><A NAME="mendel1865experiments"><FONT COLOR=purple>[Mendel, 1865]</FONT></A></DT><DD CLASS="dd-thebibliography">
Mendel, G. (1865).
Experiments in plant hybridization (1865).
In <EM>Read at the meetings of February 8th, and March 8th</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Michalewicz1994"><FONT COLOR=purple>[Michalewicz, 1994]</FONT></A></DT><DD CLASS="dd-thebibliography">
Michalewicz, Z. (1994).
<EM>Genetic Algorithms Plus Data Structures Equals Evolution
Programs</EM>.
Springer-Verlag New York, Inc., Secaucus, NJ, USA, 2nd edition.</DD><DT CLASS="dt-thebibliography"><A NAME="Michalewicz2004"><FONT COLOR=purple>[Michalewicz, 2004]</FONT></A></DT><DD CLASS="dd-thebibliography">
Michalewicz, Z. (2004).
<EM>How to solve it: modern heuristics</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Miller1995"><FONT COLOR=purple>[Miller and Goldberg, 1995]</FONT></A></DT><DD CLASS="dd-thebibliography">
Miller, B. L. and Goldberg, D. E. (1995).
Genetic Algorithms, Tournament Selection, and the Effects of Noise.
<EM>Evolutionary Computation</EM>, 4:113—-131.</DD><DT CLASS="dt-thebibliography"><A NAME="2011ACLI2061"><FONT COLOR=purple>[Mouret and Doncieux, 2012]</FONT></A></DT><DD CLASS="dd-thebibliography">
Mouret, J.-B. and Doncieux, S. (2012).
Encouraging Behavioral Diversity in Evolutionary Robotics: an
Empirical Study.
<EM>Evolutionary Computation</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="nandasana2003applications"><FONT COLOR=purple>[Nandasana et al., 2003]</FONT></A></DT><DD CLASS="dd-thebibliography">
Nandasana, A. D., Ray, A. K., and Gupta, S. K. (2003).
Applications of the non-dominated sorting genetic algorithm (NSGA)
in chemical reaction engineering.
<EM>International Journal of Chemical Reactor Engineering</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Pareto1897"><FONT COLOR=purple>[Pareto, 1897]</FONT></A></DT><DD CLASS="dd-thebibliography">
Pareto, V. (1897).
<EM>Cours d'Economie Politique</EM>, volume 2.
F. Rouge &amp; Cie., Lausanne, Switzerland.</DD><DT CLASS="dt-thebibliography"><A NAME="ray2004applications"><FONT COLOR=purple>[Ray, 2004]</FONT></A></DT><DD CLASS="dd-thebibliography">
Ray, T. (2004).
Applications of multi-objective evolutionary algorithms in
engineering design.
<EM>Applications of multi-objective evolutionary algorithms</EM>, 1:29.</DD><DT CLASS="dt-thebibliography"><A NAME="Rechenberg1965"><FONT COLOR=purple>[Rechenberg, 1965]</FONT></A></DT><DD CLASS="dd-thebibliography">
Rechenberg, I. (1965).
Cybernetic solution path of an experimental problem.
In <EM>Royal Aircraft Establishment Translation No. 1122, B. F.
Toms, Trans.</EM> Ministry of Aviation, Royal Aircraft Establishment, Farnborough
Hants.</DD><DT CLASS="dt-thebibliography"><A NAME="Rechenberg1973"><FONT COLOR=purple>[Rechenberg, 1973]</FONT></A></DT><DD CLASS="dd-thebibliography">
Rechenberg, I. (1973).
<EM>Evolutionsstrategie – Optimierung technisher Systeme nach
Prinzipien der biologischen Evolution</EM>.
Frommann-Holzboog, Stuttgart, GER.</DD><DT CLASS="dt-thebibliography"><A NAME="reed2007using"><FONT COLOR=purple>[Reed et al., 2007]</FONT></A></DT><DD CLASS="dd-thebibliography">
Reed, P., Kollat, J. B., and Devireddy, V. K. (2007).
Using interactive archives in evolutionary multiobjective
optimization: A case study for long-term groundwater monitoring design.
<EM>Environmental Modelling &amp; Software</EM>, 22(5):683–692.</DD><DT CLASS="dt-thebibliography"><A NAME="Schaffer1984"><FONT COLOR=purple>[Schaffer, 1984]</FONT></A></DT><DD CLASS="dd-thebibliography">
Schaffer, J. D. (1984).
<EM>Some experiments in machine learning using vector evaluated
genetic algorithms</EM>.
PhD thesis, Vanderbilt University.</DD><DT CLASS="dt-thebibliography"><A NAME="Schwefel1981"><FONT COLOR=purple>[Schwefel, 1981]</FONT></A></DT><DD CLASS="dd-thebibliography">
Schwefel, H.-P. (1981).
<EM>Numerical Optimization of Computer Models</EM>.
John Wiley &amp; Sons, Inc., New York, NY, USA.</DD><DT CLASS="dt-thebibliography"><A NAME="Srinivas1994"><FONT COLOR=purple>[Srinivas and Deb, 1994]</FONT></A></DT><DD CLASS="dd-thebibliography">
Srinivas, N. and Deb, K. (1994).
Muiltiobjective Optimization Using Nondominated Sorting in Genetic
Algorithms.
<EM>Evolutionary Computation</EM>, 2(3):221–248.</DD><DT CLASS="dt-thebibliography"><A NAME="Stanley2002"><FONT COLOR=purple>[Stanley and Miikkulainen, 2002]</FONT></A></DT><DD CLASS="dd-thebibliography">
Stanley, K. O. and Miikkulainen, R. (2002).
Evolving neural networks through augmenting topologies.
<EM>Evolutionary Computation</EM>, 10(2):99–127.</DD><DT CLASS="dt-thebibliography"><A NAME="Wagner2007"><FONT COLOR=purple>[Wagner et al., 2007]</FONT></A></DT><DD CLASS="dd-thebibliography">
Wagner, T., Beume, N., and Naujoks, B. (2007).
Pareto-, aggregation-, and indicator-based methods in many-objective
optimization.
In <EM>Proceedings of the 4th international conference on
Evolutionary multi-criterion optimization</EM>, EMO'07, pages 742–756, Berlin,
Heidelberg. Springer-Verlag.</DD><DT CLASS="dt-thebibliography"><A NAME="Yang2007"><FONT COLOR=purple>[Yang and Ding, 2007]</FONT></A></DT><DD CLASS="dd-thebibliography">
Yang, Q. and Ding, S. (2007).
Novel algorithm to calculate hypervolume indicator of Pareto
approximation set.
<EM>ICIC 2007</EM>.</DD><DT CLASS="dt-thebibliography"><A NAME="Zitzler2004"><FONT COLOR=purple>[Zitzler and Künzli, 2004]</FONT></A></DT><DD CLASS="dd-thebibliography">
Zitzler, E. and Künzli, S. (2004).
Indicator-based selection in multiobjective search.
<EM>Parallel Problem Solving from Nature-PPSN VIII</EM>, (i):1–11.</DD><DT CLASS="dt-thebibliography"><A NAME="Zitzler2001"><FONT COLOR=purple>[Zitzler et al., 2001]</FONT></A></DT><DD CLASS="dd-thebibliography">
Zitzler, E., Laumanns, M., and Thiele, L. (2001).
SPEA2: Improving the Strength Pareto Evolutionary Algorithm.
<EM>Computer Engineering</EM>, TIK-Report(103):1–21.</DD><DT CLASS="dt-thebibliography"><A NAME="Zitzler1999"><FONT COLOR=purple>[Zitzler and Thiele, 1999]</FONT></A></DT><DD CLASS="dd-thebibliography">
Zitzler, E. and Thiele, L. (1999).
Multiobjective evolutionary algorithms: A comparative case study and
the strength pareto approach.
<EM>Evolutionary Computation, IEEE</EM>, 3(4):257–271.</DD></DL><!--CUT END -->
<!--HTMLFOOT-->
<!--ENDHTML-->
<!--FOOTER-->
</div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
<?include("footer.inc")?>
</body>
</HTML>
