function fav(btn,recipeIndex){
	if(btn.className == "favoriteBtnOff"){
		btn.className = "favoriteBtnOn";
		$.ajax({
			type: 'GET',
			url: 'src/addToFavs.php',
			data: 'ID=' + encodeURIComponent(recipeIndex),
			success: function(data){
				if (data) {
					document.getElementById('ajoutOuRetraitFav').innerHTML = data;
				}
			}
		})

	}
	else
	{
		btn.className = "favoriteBtnOff";
		$.ajax({
			type: 'GET',
			url: 'src/removeFromFavs.php',
			data: 'ID=' + encodeURIComponent(recipeIndex),
			success: function(data){
				if (data) {
					document.getElementById('ajoutOuRetraitFav').innerHTML = data;
				}
			}
		})
	}
}