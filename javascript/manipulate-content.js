


        let edit = document.getElementsByClassName('edit')[0];
        let userDataFields = document.getElementsByClassName('user-data-fields')[3];
        let saveButton = document.getElementsByClassName('save-button')[0];
        let links = document.getElementsByClassName('links')[1];
        
        
        
            document.getElementById('profile-header').textContent = 'Αυτό είναι το προφίλ μου!';
            edit.remove();
            userDataFields.remove();
            saveButton.remove();
            links.remove();

        
      let deleteUser = document.getElementById('delete-user');
      deleteUser.remove(); 

