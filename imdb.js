function openSignUpPage(){
    window.location.href="imdb_sign_up.php";
}

function loadMoviePage(idM) {              
    window.location.href="moviePageUser.php?uid="+idM;
}


function loadMoviePageAdmin(idM) {              
    window.location.href="moviePageAdmin.php?uid="+idM;
}


function searchByGenreAdmin(strGenre){
    window.location.href="pageAdminAfterSearch.php?regex="+strGenre+"&type=byGenre";
}


function searchByTitleAdmin(){
    window.location.href="pageAdminAfterSearch.php?regex="+document.getElementById("yourSearchInput").value+"&type=byTitle";
}


function searchByGenreUser(strGenre){
    window.location.href="pageUserAfterSearch.php?regex="+strGenre+"&type=byGenre";
}


function searchByTitleUser(){
    window.location.href="pageUserAfterSearch.php?regex="+document.getElementById("yourSearchInputUser").value+"&type=byTitle";
}


function openPageToAddMovie(){
    window.location.href="pageFormToAddMovie.php";
}

function loadPageAdmin(){
    window.location.href="pageAdmin.php";
}

function loadPageUser(){
    window.location.href="pageUser.php";
}