<h2><?php echo $titre; echo " "; echo $nb_compte->res; ?></h2>
<?php

	if (! empty($logins) && is_array($logins))
	{

		foreach ($logins as $pseudos)
		{
			echo "<br />";
			echo " -- ";
			echo $pseudos["pseudo_cpt"];
			echo " -- ";
			echo "<br />";
		}
	}
	else{
			echo("<h3>Aucun compte pour le moment</h3>");
	}
?>