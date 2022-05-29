function createTags(){
    var ul = document.getElementById("tag-list");
    var li = document.createElement("li");
    li.appendChild(document.createTextNode("test"));
    ul.appendChild(li);
}