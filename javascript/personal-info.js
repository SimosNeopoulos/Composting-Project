
let addFriend = document.getElementById('addFriend');
addFriend.remove();


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

    


