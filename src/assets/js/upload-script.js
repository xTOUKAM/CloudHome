// On sélectionne tous les éléments requis
const dropArea = document.querySelector(".drag-area");
const dragText = dropArea.querySelector("header");
const button = dropArea.querySelector("button");
const input = dropArea.querySelector("input");

// On définit une action lorsque l'utilisateur clique sur le bouton
button.onclick = () => {
  input.click();
};

// On définit une action lorsque l'utilisateur sélectionne un fichier
input.addEventListener("change", function () {
  // On récupère tous les fichiers sélectionnés par l'utilisateur
  const files = this.files;
  dropArea.classList.add("active");
  showFiles(files);
  uploadFiles(files);
});

// Si l'utilisateur glisse un ou plusieurs fichiers sur la zone de drop
dropArea.addEventListener("dragover", (event) => {
  event.preventDefault();
  dropArea.classList.add("active");
  dragText.textContent = "Relâcher les fichiers ici";
});

// Si l'utilisateur quitte la zone de drop
dropArea.addEventListener("dragleave", () => {
  dropArea.classList.remove("active");
  dragText.textContent = "Glisser et déposer les fichiers ici";
});

// Si l'utilisateur dépose le ou les fichiers sur la zone de drop
dropArea.addEventListener("drop", (event) => {
  event.preventDefault();
  // On récupère tous les fichiers sélectionnés par l'utilisateur
  const files = event.dataTransfer.files;
  dropArea.classList.add("active");
  showFiles(files);
  uploadFiles(files);
});

// Affiche les fichiers sélectionnés
function showFiles(files) {
  for (let i = 0; i < files.length; i++) {
    const file = files[i];
    let fileType = file.type;
    let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
    if (validExtensions.includes(fileType)) {
      let fileReader = new FileReader();
      fileReader.onload = () => {
        showPopup("Fichier téléchargé avec succès");
      };
      fileReader.readAsDataURL(file);
    } else {
      showPopup("Format de fichier non valide");
    }
  }
}

// On définit une action lorsque l'utilisateur clique sur le bouton "Upload"
function showPopup(message) {
  const popupContainer = document.getElementById('popupContainer');
  const popupMessage = document.getElementById('popupMessage');
  popupMessage.textContent = message;
  popupContainer.style.display = 'flex';
  setTimeout(() => {
    popupContainer.style.display = 'none';
  }, 15000); // Disparaît après 2 secondes (ajuster la durée selon vos besoins)
}

// Sélection du bouton de fermeture et de la popup
const closeButton = document.getElementById("closeButton");
const popupContainer = document.getElementById("popupContainer");

// Fonction pour fermer la popup
function closePopup() {
  popupContainer.style.display = "none";
}

// Écouteur d'événement pour le clic sur le bouton de fermeture
closeButton.addEventListener("click", closePopup);

// Fonction pour faire disparaître la popup
function hidePopup() {
  const popup = document.querySelector('.popup-container');
  popup.classList.add('fade-out');
  setTimeout(() => {
    popup.style.display = 'none';
    popup.classList.remove('fade-out');
  }, 300); // Temps de la transition en millisecondes
}

// On définit une action lorsque l'utilisateur clique sur le bouton "Upload"
function uploadFiles(files) {
  for (let i = 0; i < files.length; i++) {
    const file = files[i];
    js_file_upload(file);
  }
}

// On définit une fonction file_browse
function file_browse() {
  document.getElementById("file").onchange = function () {
    // On récupère tous les fichiers sélectionnés par l'utilisateur
    const files = this.files;
    uploadFiles(files);
  };
}

// On définit une fonction js_file_upload
function js_file_upload(file) {
  if (file != undefined) {
    var form_data = new FormData();
    form_data.append("file", file);
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../../sql/post_upload.php", true);
    xhttp.onload = function (event) {
      if (xhttp.status == 200) {
        var response = event.target.responseText;
        // Traitez la réponse ici
      }
    };
    xhttp.send(form_data);
  }
}