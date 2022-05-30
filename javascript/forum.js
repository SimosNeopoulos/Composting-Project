function createTags(){
    var ul = document.getElementById("tag-list");
    var li = document.createElement("li");
    li.appendChild(document.createTextNode("test"));
    ul.appendChild(li);
}

let forumSearch = document.getElementById("forum-search");
let forumForm = document.getElementById("forum-form");

function forumSearchTextToTag(){
    forumSearch.setAttribute('name', 'search-tags');
    forumSearch.setAttribute('placeholder', 'Αναζήτηση ετικέτας');
    forumForm.setAttribute('action', '#');
}

function forumSearchTextToUser(){
    forumSearch.setAttribute('name', 'user-search');
    forumSearch.setAttribute('placeholder', 'Αναζήτηση χρήστη');
    forumForm.setAttribute('action', '../html/users-page.php');
}
