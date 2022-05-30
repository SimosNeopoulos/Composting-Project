function createTags(){
    var ul = document.getElementById("tag-list");
    var li = document.createElement("li");
    li.appendChild(document.createTextNode("test"));
    ul.appendChild(li);
}

function forumSearchTextToTag(){
    document.getElementsByClassName('searchForum')[0].textContent = 'Αναζήτηση ετικέτας';
}

function forumSearchTextToUser(){
    document.getElementsByClassName('searchForum')[0].textContent = 'Αναζήτηση χρήστη';
}
