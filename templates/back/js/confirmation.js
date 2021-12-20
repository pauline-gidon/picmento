$(function(){
	$('.gogo').click(function(){
		const titre = $(this).attr('data-gogo');
		return(confirm('Confirmer la suppression de '+titre+' ?'));
	});
});



