$(function(){
	$('.gogo').click(function(){
		const titre = $(this).attr('data-gogo');
		return(confirm('Confirmer la suppression de '+titre+' ?'));
	});
});


/*

	const tableau = document.querySelectorAll('.gogo');
	function confirmation(titre){
		return(confirm('Souhaitez-vous supprimer votre participation à "'+titre+'" ?'));
	}
	for(obj of tableau) {
		obj.addEventListener('click',function(){
			confirmation(this.getAttribute('data-gogo'));
		});

	}
	
*/

