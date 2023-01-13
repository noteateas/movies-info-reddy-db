$(document).ready(function(){ 
	writeUsernameBlock();
	var location = window.location.href;

	if(location.indexOf('index.php')!=-1){
		$('.showMore').click(function(e){
			e.preventDefault();
			showMore($(this));
		});
		$('#user').hover(function(){
			$('#user ul li').children().css({'color':'white'});
		});
	}

	if(location.indexOf('reviews.php')!=-1){

		$('.showMore').click(function(e){
			e.preventDefault();
			showMore($(this));
		});
		$('#addReview').click(function(){
			var scrollTop = $(window).scrollTop();
			open('#addReviewBlock',scrollTop);
		});
		$('.formClose').click(function(){
			close('#signInBlock, #registerBlock, #addReviewBlock')
		})
		.hover(function(){
			$(this).css({'cursor': 'pointer'})
		})
	}

	if(location.indexOf('movies.php')!=-1){
		$('.movie').click(function(){
			writeInfo($(this).attr('data-id'));
		});
		topMoviesAjax();
		
		getMovies();
		getPhotos();
		/*$.when((getMovies(),getPhotos()).done(function(){
			document.getElementById('sortMovies').addEventListener('change', sortMovies);
		}));*/
	}

	if(location.indexOf('watchlist.php')!=-1){
		$('.removeFromWatchlist').click(function(){
			removeFromWatchlist($(this).attr('data-id'));
		});
		$('.watchlistPhoto').click(function(){
			writeInfo($(this).attr('data-id'));
		});
	}
	
	if(location.indexOf('controlPanel.php')!=-1){
		$('#insertMovie').click(function(){
			var scrollTop = $(window).scrollTop();
			open('#insertMovieBlock',scrollTop);
		});
		$('.close').click(function(){
			close('#insertMovieBlock');
			$('#errorsBlock').css({'display':'none'})
		});

		$('#updateMovie').click(function(){
			var scrollTop = $(window).scrollTop();
			open('#updateMovieBlock',scrollTop);
		});
		$('.close#updateMovieBlockClose').click(function(){
			close('#updateMovieBlock');
			$('#errorsBlock').css({'display':'none'})
		});

		$('#deleteMovie').click(function(){
			var scrollTop = $(window).scrollTop();
			open('#deleteMovieBlock',scrollTop);
		});
		$('.close').click(function(){
			close('#deleteMovieBlock');
			$('#errorsBlock').css({'display':'none'})
		});

		$('#insertMenuLink').click(function(){
			var scrollTop = $(window).scrollTop();
			open('#addMenuLinkBlock',scrollTop);
		});
		$('.close').click(function(){
			close('#addMenuLinkBlock');
			$('#errorsBlock').css({'display':'none'})
		});


		$('#deleteMenuLink').click(function(){
			var scrollTop = $(window).scrollTop();
			open('#deleteMenuLinkBlock',scrollTop);
		});
		$('.close').click(function(){
			close('#deleteMenuLinkBlock');
			$('#errorsBlock').css({'display':'none'})
		});


		$('#deleteUser').click(function(){
			var scrollTop = $(window).scrollTop();
			open('#deleteUserBlock',scrollTop);
		});
		$('.close').click(function(){
			close('#deleteUserBlock');
			$('#errorsBlock').css({'display':'none'})
		});

		/*$('#deleteReview').click(function(){
			var scrollTop = $(window).scrollTop();
			open('#deleteReviewBlock',scrollTop);
		});
		$('.close').click(function(){
			close('#deleteReviewBlock');
			$('#errorsBlock').css({'display':'none'})
		});*/

		
		$.when((getMovies(), getDirectors()).done(function(){
			var autocompleteEl = document.getElementsByClassName('autocomplete');
			for(var i=0; i< autocompleteEl.length; i++){
				if((autocompleteEl[i].classList[1])=='autocompleteMovies'){
					autocompleteEl[i].addEventListener('keyup',function(){
						 autocomplete('titleDelete',moviesDb,'title','idDeleteMovie');
					})
				}else if((autocompleteEl[i].classList[1])=='autocompleteDirectors'){
					autocompleteEl[i].addEventListener('keyup', function(){
						autocomplete('directorDelete',directorsDb,'fullname','idDeleteDirector');
					})
				}else if((autocompleteEl[i].classList[1])=='autocompleteMoviesUpdate'){
					autocompleteEl[i].addEventListener('keyup', function(){
						autocomplete('titleUpdate',moviesDb,'title','updateMovieId')
					})
				}
			}
		}));
	}


	$('.close').hover(function(){
		$(this).children().first().stop(true, true).animate({height: '21px'}, 300);
		$(this).children().last().stop(true, true).animate({height: '28px'}, 300);
	},function(){
		$(this).children().first().stop(true, true).animate({height: '27px'}, 300);
		$(this).children().last().stop(true, true).animate({height: '23px'}, 300);
	});
	if(document.getElementById('uploadProfilePhoto')){
		document.getElementById('uploadProfilePhoto').addEventListener('change',function(){uploadProfilePhoto(this,'logic/upload.php')});
	}
});

function getMovies(){
	return $.ajax({
		url: "logic/getMovies.php",
		type: 'POST',
		data: {
			movies : 1
		},
		dataType: "json",
		success: function(data,status,xhr){
			if(xhr.status==200){
				moviesDb = data;
			}
		},
		error(xhr,status,error){
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
}
function getDirectors(){
	return $.ajax({
		url: "logic/getDirectors.php",
		type: 'POST',
		data: {
			directors : 1
		},
		dataType: "json",
		success: function(data,status,xhr){
			if(xhr.status==200){
				directorsDb = data;
			}
		},
		error(xhr,status,error){
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
}
function getPhotos(){
	return $.ajax({
		url: "logic/getMoviePhotos.php",
		method: 'POST',
		data: {
			moviePhotos : 1
		},
		dataType: "json",
		success: function(data,status,xhr){
			if(xhr.status==200){
				moviePhotos = data;
			}
		},
		error(xhr,status,error){
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
}

function autocomplete(input,elementsDatabase,name,hiddenInput){
	var input = document.getElementById(input);
	var inputValue = input.value;

	if((inputValue=="")||(inputValue==" ")||(inputValue=="\n")){
		var autocompleteBlock = input.nextElementSibling;
		autocompleteBlock.innerHTML = "";
		autocompleteBlock.style.display = 'none';
		document.getElementById(hiddenInput).removeAttribute('value');
	} else{
		var inputValue = inputValue.toLowerCase();
		var block = '';
		for(element of elementsDatabase){
			var nameOfDbEl = (element[name]).toLowerCase(); 

			if(nameOfDbEl.startsWith(inputValue)){
				var id = element.id;
				block += `<p data-id=${id} class="autocompleteOptions">`+capitalize(nameOfDbEl)+`</p>`;
			}
		}
		var autocompleteBlock = input.nextElementSibling;
		if(block!=""){
			autocompleteBlock.style.display = 'flex';
			autocompleteBlock.innerHTML = block;
		} else{
			autocompleteBlock.style.display = 'none';
		}
		

		$('.autocompleteOptions').click(function(){
			var clicked = this;
			input.value = this.innerHTML;
			var id = this.dataset.id;
			autocompleteBlock.innerHTML = "";
			autocompleteBlock.style.display = 'none';
			document.getElementById(hiddenInput).value = id;
		})
	}
}

function writeUsernameBlock(){
	$('#user').hover(function(){
		$('#userNav').css({'display':'flex', 'flex-direction':'column'});
	},
	function(){
		$('#userNav').css({'display':'none'});
	})
}
function close(block){
	$(block).css({'visibility': 'hidden', 'width': '0%', 'height':'0%', 'top':'0%'})
	$('body').css({'overflow':'visible'})
}
function open(block, offset){
	$(block)
	.css({'visibility': 'visible', 'top':offset})
	.animate({'width':'100%', 'height': '100vh'}, 400)
	$('body').css({'overflow':'hidden'})
}
function slider(photos, holder, folder){
	let block = '';
	let brojac=-1;
	for(element of photos){
		block += `
			<div class="indexSliderMovie">
				<img src="assets/img/`+folder+`/${element.photo.source}" alt="${element.photo.source}"/>
			</div>
		`
	}
	automaticSlider()
	function automaticSlider(){
		document.getElementById(holder).innerHTML = block;
		var slidePhotos = document.getElementsByClassName('indexSliderMovie');
		brojac++;
		for(i=0; i<slidePhotos.length; i++){
			slidePhotos[i].classList.add('displayNone');
		}
		if(brojac==slidePhotos.length){brojac=0;}
		slidePhotos[brojac].classList.add('displayBlock');
		setTimeout(automaticSlider, 4000);
	}
}


function proveraRegister(){
	var errors=[];
	document.getElementById('registerErrorsBlock').innerHTML = '';
	var regexFullName = /^[A-Z][a-z]{2,20}(\s[A-Z][a-z]{2,20})+$/,
		regexUser = /^(?=.*[A-z])(?!\s)[A-z\d.?-]{3,25}$/,
		regexEmail = /^([A-z][A-z0-9-._]{2,35})\@([A-z]{3,10}\.[a-z]{2,5}(.[a-z]{2,5})?)$/,
		regexPassword = /^(?=.*[a-z])(?=.*\d)(?=.*[A-Z]).{3,30}$/;

	var fullName = document.getElementById("fullName"),
		username = document.getElementById("usernameRegister"),
		email = document.getElementById("emailRegister"),
		password = document.getElementById("passwordRegister"),
		passwordConfirm = document.getElementById("passwordConfirm");

	var fullNameValue = document.getElementById("fullName").value.trim(),
		usernameValue = document.getElementById("usernameRegister").value.trim(),
		emailValue = document.getElementById("emailRegister").value.trim(),
		passwordValue = document.getElementById("passwordRegister").value,
		passwordConfirmValue = document.getElementById("passwordConfirm").value;

	valid= true;
	if(!(regexFullName.test(fullNameValue))){
		fullName.style.borderBottom = "2px solid #cf2525";
		valid = false;
		errors.push('<div class="error"	><p>Name at least two capitalized words, space in between.</p></div>')
	} else{
		fullName.style.borderBottom = "2px solid black";
	}
	
	if(!(regexUser.test(usernameValue))){
		username.style.borderBottom = "2px solid #cf2525";
		errors.push('<div class="error"	><p>Username between 3 and 25 characters.</p></div>')
		valid = false;
	} else{
		username.style.borderBottom = "2px solid black";
	}

	if(!(regexEmail.test(emailValue))){
		errors.push('<div class="error"	><p>Regular email shape.</p></div>')
		email.style.borderBottom = "2px solid #cf2525";
		valid = false;
	} else{
		email.style.borderBottom = "2px solid black";
	}

	if(!(regexPassword.test(passwordValue))){
		errors.push('<div class="error"	><p>Pass one uppercase,lowercase letter and number</p></div>')
		password.style.borderBottom = "2px solid #cf2525";
		valid = false;
	} else{
		password.style.borderBottom = "2px solid black";
	}

	if((passwordValue!=passwordConfirmValue)||(passwordConfirmValue=="")){
		errors.push('<div class="error"	><p>Passwords must match.</p></div>')
		passwordConfirm.style.borderBottom = "2px solid #cf2525";
		valid = false;
	} else{
		passwordConfirm.style.borderBottom = "2px solid black";
	}

	for(element of errors){
		document.getElementById('registerErrorsBlock').innerHTML += element;
	}
	return valid;
}
function proveraSignIn(){
	var errors=[];
	document.getElementById('signInErrorsBlock').innerHTML = '';
	valid= true;
	var username = document.getElementById("usernameSignIn"),
		password = document.getElementById("passwordSignIn");
	var usernameValue = document.getElementById("usernameSignIn").value.trim(),
		passwordValue = document.getElementById("passwordSignIn").value.trim();
	var dugmeSignIn = document.getElementById('dugmeSignIn');
	var regexUser = /^(?=.*[A-z])(?!\s)[A-z\d.?-]{3,25}$/,
		regexPassword = /^(?=.*[a-z])(?=.*\d)(?=.*[A-Z]).{3,30}$/;

	if(!(regexUser.test(usernameValue))){
		username.style.borderBottom = "2px solid #cf2525";
		errors.push('<div class="error"	><p>Username between 3 and 25 characters.</p></div>')
		valid = false;
	} else{
		username.style.borderBottom = "2px solid black";
	}
	if(!(regexPassword.test(passwordValue))){
		password.style.borderBottom = "2px solid #cf2525";
		errors.push('<div class="error"><p>Password one uppercase and lowercase letter and a number.</p></div>')
		valid = false;
	} else{
		password.style.borderBottom = "2px solid black";
	}
	
	
	for(element of errors){
		document.getElementById('signInErrorsBlock').innerHTML += element;
	}
	return valid;
}
function proveraSurvey(){
	document.getElementById('surveyError').innerHTML = "";
	valid= true;
	var errors = [];
	var answer = document.getElementById("answer2");

	var answerValue = answer.value.trim();
	var checked = ($('input[name=watchRadio]:checked').length);

	var regexAnswer = /^.{5,120}$/;

	if(!(regexAnswer.test(answerValue))){
		answer.style.borderBottom = "2px solid #cf2525";
		errors.push('<div class="error"><p>Answer length between 5 and 120 characters.</p></div>')
		valid = false;
	} else{
		answer.style.borderBottom = "2px solid black";
	}
	if(!checked){
		errors.push('<div class="error"><p>One radio button answer must be chosen.</p></div>');
		valid=false;
	}
	
	if(errors){
		for(i=0; i<errors.length; i++){
			document.getElementById('surveyError').innerHTML += errors[i];
		}
	}
	
	return valid;
}
function proveraContact(){
	document.getElementById('contactError').innerHTML = "";
	valid= true;
	var errors = [];

	var name = document.getElementById("fullNameContact");
	var subject = document.getElementById("subjectContact");
	var message = document.getElementById("messageContact");

	var nameValue = name.value ;
	var subjectValue = subject.value;
	var messageValue = message.value;
	console.log(messageValue)

	var regexFullName = /^[A-Z][a-z]{2,20}(\s[A-Z][a-z]{2,20})+$/;
	var regexSubject = /^[\w\d]{1,30}$/;
	var regexMessage = /^.{5,250}$/;

	if(!(regexFullName.test(nameValue))){
		name.style.borderBottom = "2px solid #cf2525";
		errors.push('<div class="error"><p>Name in invalid format.</p></div>')
		valid = false;
	} else{
		name.style.borderBottom = "2px solid black";
	}
	if(!(regexSubject.test(subjectValue))){
		subject.style.borderBottom = "2px solid #cf2525";
		errors.push('<div class="error"><p>Subject in invalid format.</p></div>')
		valid = false;
	} else{
		subject.style.borderBottom = "2px solid black";
	}
	if(!(regexMessage.test(messageValue))){
		message.style.borderBottom = "2px solid #cf2525";
		errors.push('<div class="error"><p>Message min 5 and max 250 characters.</p></div>')
		valid = false;
	} else{
		message.style.borderBottom = "2px solid black";
	}
	
	
	if(errors){
		for(i=0; i<errors.length; i++){
			document.getElementById('contactError').innerHTML += errors[i];
		}
	}
	
	return valid;
}

function showMore(obj){
	if(obj.prev().css('display')!='inline'){
		obj.prev().show(110)
		obj[0].textContent='see less'
	}
	else{
		obj.prev().hide(110)
		obj[0].textContent='...see more'
	}
}
function reviewProvera(){
	valid = true;
	
	var movieList = document.getElementById("movieSelect"),
		reviewText = document.getElementById("reviewText");
	var movieListValue = movieList.value,
		reviewTextValue = reviewText.value.trim();
	//var dugmeSubmit = document.getElementById('submitReview');

	var regexText = /^.{1,1500}$/;

	if(!(regexText.test(reviewTextValue))){
		reviewText.style.border = "2px solid #cf2525";
		valid = false;
	} else{
		reviewText.style.border = "2px solid #383838";
	}
	if(movieListValue==0){
		movieList.style.borderBottom = "2px solid #cf2525";
		valid = false;
	} else{
		movieList.style.borderBottom = "2px solid #383838";
	}

	return valid;
}
function writeTopReviewers(reviewers){
	let block = "";
	for(element of reviewers){
		block +=
			`<div class="userIcon">
				<img src="assets/img/users/${element.profilePhoto.source}" alt="${element.profilePhoto.alt}"/>
				<div>
					<h5>${element.username}</h5>
					<p>${element.reviews}&nbsp;reviews</p>
				</div>
			</div>`
	}
	document.getElementById('topReviewersBlock').innerHTML = block;
}


function topMoviesAjax(){
	getObj('topMovies.json',function(data){
		slider(data,"topMoviesBlock","movies")
	});
}


function getObj(file, func){
	$.ajax({
		url: "assets/data/"+file,
		method: "POST",
		type: "json",
		success: func,
		error(xhr,status,error){
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
}
function sortMovies(){
	var movies = moviesDb;
	var clicked = this.value;

	if(clicked == "newest"){
		movies.sort((a,b) => b.year - a.year);
		writeMovies(movies);
	}
	if(clicked=="oldest"){
		movies.sort((a,b) => a.year-b.year);
		writeMovies(movies);
	}
	if(clicked=="0"){
		movies.sort((a,b) => a.id - b.id);
		writeMovies(movies);
	}
}
function writeMovies(movies){
	let block = '';
	for(element of movies){
		var movieId = element.id;
		for(photo of moviePhotos){
			if(photo.movie_id==movieId){
				var src=photo.src;
				var alt=photo.alt;
			}
		}
		block+= `<div class='movie' data-id='${movieId}'>
					<img src='assets/img/movies/${src}' alt='${alt}'/>
				</div>`
		}
	document.getElementById('moviesBlock').innerHTML = block+
	`<div class='pagination'>
		<a href='movies.php?page=1'>1</a>
		<a href='movies.php?page=2'>2</a>
	</div>`;

	
			
}
function filterMovies(){
	var clicked = this.value;
	getObj("movies.json",function(data){
		movies=data;
		if(clicked=='0'){
			writeMovies(movies)
		}
		else{
			movies = movies.filter(function(mov){
			for(genre of mov.genres){
				if(genre==clicked)
					return true;
				}
			})
			writeMovies(movies);
		}
	})
}
function writeInfo(id){
	$.ajax({
		url: 'movieInfo.php',
		type: 'POST',
		data: {
			info: 1,
			id: id
		},
		success: function(data){
			document.getElementById('infoBlock').innerHTML= data;
			var scrollTop = $(window).scrollTop();
			open('#infoBlock',scrollTop);
			$('.signIn').click(function(){
				open('#signInBlock',0)
			})
			$('#infoClose').click(function(){
				close('#infoBlock');
			})
			.hover(function(){
				$(this).children().first().stop(true, true).animate({height: '21px'}, 300);
				$(this).children().last().stop(true, true).animate({height: '28px'}, 300);
			},function(){
				$(this).children().first().stop(true, true).animate({height: '27px'}, 300);
				$(this).children().last().stop(true, true).animate({height: '23px'}, 300);
			});
			$('#addToWatchlist').click(function(){
				addToWatchlist(id);
			});
		},
		error(xhr,status,error){
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
}


function addToWatchlist(id){
	var movieId = id;
	$.ajax({
		url: 'logic/addToWatchlist.php',
		type: 'POST',
		data: {
			id: movieId
		},
		success: function(data){
			console.log(data)
			if(data=='success'){
				alert('Added');
			} else if(data=='failed'){
				alert('Not added. Try again.')
			}
			else if(data=='already in watchlist'){
				alert('already in watchlist');
			}
		},
		error(xhr,status,error){
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
}
function removeFromWatchlist(id){
	var movieId = id;
	$.ajax({
		url: 'logic/removeFromWatchlist.php',
		type: 'POST',
		data: {
			id: movieId
		},
		success: function(data){
			if(data=='success'){
				location.reload();
			} else if(data=='failed'){
				alert('Not deleted. Try again.')
			}
		},
		error(xhr,status,error){
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
}
function uploadProfilePhoto(uploadInput,destination){
	if(uploadInput.value){
		var file = uploadInput.files[0];
		var fileName = file.name;
		var fileType = file.type;
		var fileSize = file.size;

		var fileData = new FormData();
		fileData.append('uploadProfilePhoto',file);

		if(fileSize<2002000){
			if((fileType.indexOf('png')!=-1)||(fileType.indexOf('jpg')!=-1)||(fileType.indexOf('jpeg')!=-1)){
				$.ajax({
					url: destination,
					type: 'POST',
					data: fileData,
					contentType: false,
					cache: false,
					processData: false,
					success: function(data){
						console.log(data)
						if(data=='type'){
							alert('Image extension has to be jpg, jpeg or png.');
						} else if(data=='size'){
							alert('Image has to be smaller than 2MB.');
						}
						location.reload();
					},
					error(xhr,status,error){
						console.log(xhr);
						console.log(status);
						console.log(error);
					}
				});
			} else{
				alert('Image extension has to be jpg, jpeg or png.')
			}
		} else{
			alert('Image has to be smaller than 2MB.')
		}
	}
}
function proveraEditMovie(title,year,length,synopsis,photo,genreList){
		var valid = true;
		var errors = [];

		var title = document.getElementById(title),
			year = document.getElementById(year),
			length = document.getElementById(length),
			synopsis = document.getElementById(synopsis),
			photo = document.getElementById(photo),
			genreList = document.getElementById(genreList);

		var titleValue = title.value,
			yearValue = year.value,
			lengthValue = length.value,
			synopsisValue = synopsis.value,
			genreListValue = genreList.value;

		var regexTitle = /^[A-z0-9\s\!\?\.\,\:\=\+\-\'\"\*]{1,100}$/,
			regexYear = /^([1][8-9][0-9]{2})|([2][0-9]{3})$/,
			regexLength = /^[0-9]{1,3}$/,
			regexSynopsis = /^.{10,600}$/;


		if(!(regexTitle.test(titleValue))){
			title.style.borderBottom = "2px solid #cf2525";
			errors.push('<div class="error"><p>Title not in right format.</p></div>');
			valid = false;
		} else{
			title.style.borderBottom = "2px solid #383838";
		}
		if(!(regexYear.test(yearValue))){
			year.style.borderBottom = "2px solid #cf2525";
			errors.push('<div class="error"><p>Year format YYYY.</p></div>');
			valid = false;
		} else{
			year.style.borderBottom = "2px solid #383838";
		}
		if(!(regexLength.test(lengthValue))){
			length.style.borderBottom = "2px solid #cf2525";
			errors.push('<div class="error"><p>Length in minutes, format mmm.</p></div>');
			valid = false;
		} else{
			length.style.borderBottom = "2px solid #383838";
		}
		if(!(regexSynopsis.test(synopsisValue))){
			synopsis.style.border = "2px solid #cf2525";
			errors.push('<div class="error"><p>Maximum length 600 characters.</p></div>');
			valid = false;
		} else{
			synopsis.style.border = "2px solid #383838";
		}
		if(genreListValue==0){
			genreList.style.borderBottom = "2px solid #cf2525";
			errors.push('<div class="error"><p>Genre must be chosen.</p></div>')
			valid = false;
		} else{
			genreList.style.borderBottom = "2px solid #383838";
		}
		if(photo.value){
			var file = photo.files[0];
			var fileName = file.name;
			var fileType = file.type;
			var fileSize = file.size;


			if(fileSize<2002000){
				if((fileType.indexOf('png')!=-1)||(fileType.indexOf('jpg')!=-1)||(fileType.indexOf('jpeg')!=-1)){
					photo.style.borderBottom = "2px solid #383838";
				} else{
					valid=false;
					errors.push('<div class="error"><p>Image extension has to be jpg, jpeg or png.</p></div>')
					photo.style.borderBottom = "2px solid #cf2525";
				}
			} else{
				valid=false;
				errors.push('<div class="error"><p>Image has to be smaller than 2MB.</p></div>')
				photo.style.borderBottom = "2px solid #cf2525";
			}
		} else{
			errors.push('<div class="error"><p>Photo must be chosen</p></div>')
			valid=false;
			photo.style.borderBottom = "2px solid #cf2525";
		}
		if(errors.length>0){
			block = '';
			for(element of errors){
				block += element;
			}

			document.getElementById('errorsBlockInsert').innerHTML = block;
			document.getElementById('errorsBlockInsert').style.display = 'block'; 
		}

		return valid;
}
function proveraDeleteMovie(){
	var valid = true;
	var errors = [];
	document.getElementById('errorsBlockDelete').innerHTML = '';
	document.getElementById('errorsBlockDelete').style.display = 'block'; 


	var movie = document.getElementById('movieSelect');
	var movieId = movie.options[movie.selectedIndex].value;

	var	directorDelete = document.getElementById('directorDelete');
	var directorId = document.getElementById('idDeleteDirector').value;
	
	if(movieId==0){
		errors.push('<div class="error"><p>Movie has to be chosen.</p></div>');
		valid = false;
	}
	if(directorId == 0){
		errors.push('<div class="error"><p>Director has to be chosen.</p></div>');
		valid = false;
	}

	if(errors.length > 0){
		block = '';
		for(element of errors){
			block += element;
		}
		document.getElementById('errorsBlockDelete').innerHTML = block;
	}


	return valid;
}
function proveraUpdateMovie(){
	var valid = true;
		var errors = [];

		var title = document.getElementById('titleUpdate'),
			year = document.getElementById('yearUpdate'),
			length = document.getElementById('lengthUpdate'),
			synopsis = document.getElementById('synopsisUpdate'),
			genreList = document.getElementById('genreListUpdate');

		var titleValue = title.value,
			yearValue = year.value,
			lengthValue = length.value,
			synopsisValue = synopsis.value,
			genreListValue = genreList.value;

		var regexTitle = /^[A-z0-9\s\!\?\.\,\:\=\+\-\'\"\*]{1,100}$/,
			regexYear = /^([1][8-9][0-9]{2})|([2][0-9]{3})$/,
			regexLength = /^[0-9]{1,3}$/,
			regexSynopsis = /^.{10,600}$/;


		if(!(regexTitle.test(titleValue))){
			title.style.borderBottom = "2px solid #cf2525";
			errors.push('<div class="error"><p>Title not in right format.</p></div>');
			valid = false;
		} else{
			title.style.borderBottom = "2px solid #383838";
		}
		if(!(regexYear.test(yearValue))){
			year.style.borderBottom = "2px solid #cf2525";
			errors.push('<div class="error"><p>Year format YYYY.</p></div>');
			valid = false;
		} else{
			year.style.borderBottom = "2px solid #383838";
		}
		if(!(regexLength.test(lengthValue))){
			length.style.borderBottom = "2px solid #cf2525";
			errors.push('<div class="error"><p>Length in minutes, format mmm.</p></div>');
			valid = false;
		} else{
			length.style.borderBottom = "2px solid #383838";
		}
		if(!(regexSynopsis.test(synopsisValue))){
			synopsis.style.border = "2px solid #cf2525";
			errors.push('<div class="error"><p>Maximum length 600 characters.</p></div>');
			valid = false;
		} else{
			synopsis.style.border = "2px solid #383838";
		}
		if(genreListValue==0){
			genreList.style.borderBottom = "2px solid #cf2525";
			errors.push('<div class="error"><p>Genre must be chosen.</p></div>')
			valid = false;
		} else{
			genreList.style.borderBottom = "2px solid #383838";
		}


		if(errors.length>0){
			block = '';
			for(element of errors){
				block += element;
			}

			document.getElementById('errorsBlockUpdate').innerHTML = block;
			document.getElementById('errorsBlockUpdate').style.display = 'block'; 
		}

		return valid;
}
function proveraAddMenuLink(){
	var valid = true;
	var errors = [];
	document.getElementById('errorsBlockMenuLink').innerHTML = '';
	var regexTitle = /^[A-z0-9\s\.\,\-\'\"\*\/\:]{1,100}$/;
	var regexLevel = /^[\d]{1,3}$/;


	var parentSelect = document.getElementById('menuSelect');
	var parentId = parentSelect.options[parentSelect.selectedIndex].value;

	var typeSelect = document.getElementById('typeSelect');
	var type = typeSelect.options[typeSelect.selectedIndex].value;

	var name = document.getElementById('nameMenu');
	var link = document.getElementById('linkMenu');
	var level = document.getElementById('levelMenu');

	var nameValue = name.value;
	var linkValue = link.value;
	var levelValue = level.value;

	if(!(regexTitle.test(nameValue))){
		name.style.borderBottom = "2px solid #cf2525";
		errors.push('<div class="error"><p>Name length min 1 and max 100.</p></div>');
		valid = false;
	} else{
		name.style.borderBottom = "2px solid #383838";
	}
	if(!(regexTitle.test(linkValue))){
		link.style.borderBottom = "2px solid #cf2525";
		errors.push('<div class="error"><p>Link length min 1 and max 100.</p></div>');
		valid = false;
	} else{
		link.style.borderBottom = "2px solid #383838";
	}
	if(!(regexLevel.test(levelValue))){
		level.style.borderBottom = "2px solid #cf2525";
		errors.push('<div class="error"><p>Level can contain only numbers.</p></div>');
		valid = false;
	} else{
		level.style.borderBottom = "2px solid #383838";
	}
	if(type==0){
		typeSelect.style.borderBottom = "2px solid #cf2525";
		errors.push('<div class="error"><p>Type has to be chosen.</p></div>');
		valid = false;
	} else{
		typeSelect.style.borderBottom = "2px solid #383838";
	}

	console.log(nameValue)
	console.log(linkValue)
	console.log(levelValue)
	console.log(type)
	console.log(parentId)
	for(element of errors){
		document.getElementById('errorsBlockMenuLink').innerHTML += element;
	}

	return valid;
}
function proveraDeleteMenuLink(){
	var valid = true;
	var errors = [];
	document.getElementById('errorsBlockDeleteMenuLink').innerHTML = '';

	var menu = document.getElementById('menuDelSelect');
	var menuId = menu.options[menu.selectedIndex].value;


	if(menuId==0){
		menu.style.borderBottom = "2px solid #cf2525";
		errors.push('<div class="error"><p>Menu link has to be chosen.</p></div>');
		valid = false;
	} else{
		menu.style.borderBottom = "2px solid #383838";
	}

	for(element of errors){
		document.getElementById('errorsBlockDeleteMenuLink').innerHTML += element;
	}

	return valid;
}
function proveraDeleteUser(){
	var valid = true;
	var errors = [];
	document.getElementById('errorsBlockDeleteUser').innerHTML = '';

	var user = document.getElementById('userSelect');
	var userId = user.options[user.selectedIndex].value;


	if(userId==0){
		user.style.borderBottom = "2px solid #cf2525";
		errors.push('<div class="error"><p>User has to be chosen.</p></div>');
		valid = false;
	} else{
		user.style.borderBottom = "2px solid #383838";
	}

	for(element of errors){
		document.getElementById('errorsBlockDeleteUser').innerHTML += element;
	}

	return valid;
}
/*function proveraDeleteReview(){
	var valid = true;
	var errors = [];
	

	return false;
}*/
function capitalize(string) 
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}
//use this for sorting with only the movies shown
/*let movies = document.getElementsByClassName('movie');
	let moviesId = [];
	for(element of movies){
		moviesId.push($(element).attr('data-id'))
	}*/