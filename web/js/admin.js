document.addEventListener('DOMContentLoaded', function (e) {
   var buttonUpdate = document.getElementById('button_update');
   var buttonCancel = document.getElementById('button_cancel');
   var fileInput = document.getElementById('file_input');
   var newsPhoto = document.getElementById('news_photo');
   var uploadFileInput = document.getElementById('upload_file_input');

   buttonUpdate.onclick = function () {
      fileInput.style.display = 'block';
      newsPhoto.style.display = 'none';

      buttonCancel.style.display = 'block';
      this.style.display = 'none';

       uploadFileInput.setAttribute('value', 'yes');

       return false;
   };

   buttonCancel.onclick = function () {
      fileInput.style.display = 'none';
      newsPhoto.style.display = 'block';

      buttonUpdate.style.display = 'block';
      this.style.display = 'none';

       uploadFileInput.setAttribute('value', 'no');

       return false;
   }
});