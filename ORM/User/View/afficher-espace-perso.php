<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();
?>

<div class="wrap container fc fw">
	<nav id="secondaire" class="xlg-4 s-12">
		<ul>
		<fieldset>
			<legend>Compte personnel</legend>

			<li>
				<i class="fas fa-user"></i>
				<a href="modifier-profil" title="Actualiser mon profil">Profil</a>
			</li>
			<li>
				<i class="fas fa-unlock-alt"></i>
				<a href="modifier-mdp" title="Modifier mon mot de passe">Mot de passe</a>
			</li>
			<li>
				<i class="fas fa-camera-retro"></i>
				<a href="modifier-avatar" title="Modifier mon avatar">Avatar</a>
			</li>
			<li>
				<i class="fas fa-trash"></i>
				<a href="supprimer-compte" title="Supprimer mon compte">Supprimer compte</a>
			</li>
		</fieldset>
        <?php if($_SESSION["auth"]["statut"] > 2): ?>
		<fieldset>
			<legend>Espace super admin</legend>
			<li>
				<i class="fas fa-exclamation-triangle"></i>
				<a href="gerer-signalement" title="Gérer les signalements">Signalements</a>
            </li>
			<li>
				<i class="fas fa-users-cog"></i>
				<a href="gerer-users" title="Gérer les utilisateurs">Utilisateurs</a>
            </li>
		</fieldset>
		<?php endif; ?>
        </ul>
	</nav>
</div>
