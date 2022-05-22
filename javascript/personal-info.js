let flag = 0;

/**  update profile photo */
const image_upload = document.getElementById('image-upload');
let uploaded_image = "";

image_upload.addEventListener("change", function (){
    const reader = new FileReader();
    reader.addEventListener("load", () =>{
        uploaded_image = reader.result;
        document.getElementsByClassName('picture')[0].src= uploaded_image;
    })
    reader.readAsDataURL(this.files[0]);
})
//

let edit = document.getElementsByClassName('edit')[0];
let userDataFields = document.getElementsByClassName('user-data-fields')[3];
let saveButton = document.getElementsByClassName('save-button')[0];
let links = document.getElementsByClassName('links')[1];

if(flag){
    document.getElementById('profile-header').textContent = 'Αυτό είναι το προφίλ μου!';


    edit.remove();
    userDataFields.remove();
    saveButton.remove();
    links.remove();
}


function change() {
    flag=1;

}

if(flag){
    document.getElementById('profile-header').textContent = 'Αυτό είναι το προφίλ μου!';


    edit.remove();
    userDataFields.remove();
    saveButton.remove();
    links.remove();
}

