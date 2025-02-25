<h1><?php echo $titre;?></h1><br />
<?php
	if (isset($news)){
		echo $news->id_act;
		echo(" -- ");
		echo $news->intitule_act;
	}
	else {
		echo ("Pas d'actualité !");
	}
?>