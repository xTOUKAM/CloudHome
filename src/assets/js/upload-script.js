// On sélectionne tous les éléments requis
const dropArea = document.querySelector(".drag-area"),
  dragText = dropArea.querySelector("header"),
  button = dropArea.querySelector("button"),
  input = dropArea.querySelector("input");

let files = []; // Utiliser un tableau pour stocker les fichiers sélectionnés

// Si l'utilisateur clique sur le bouton, le click est aussi appliqué à l'input
button.onclick = () => {
  input.click();
};

input.addEventListener("change", function () {
  // On récupère les fichiers sélectionnés
  files = [...this.files];
  dropArea.classList.add("active");
});

// Si l'utilisateur glisse des fichiers sur la zone de drop
dropArea.addEventListener("dragover", (event) => {
    event.preventDefault(); // On empêche le comportement par défaut
    dropArea.classList.add("active");
    dragText.textContent = "Relâchez pour déposer les fichiers";
});

// Si l'utilisateur quitte la zone de drop
dropArea.addEventListener("dragleave", () => {
    dropArea.classList.remove("active");
    dragText.textContent = "Glissez et déposez les fichiers ici";
});

// Si l'utilisateur dépose des fichiers dans la zone de drop
dropArea.addEventListener("drop", (event) => {
    event.preventDefault(); // On empêche le comportement par défaut
    // On récupère les fichiers sélectionnés
    files = [...event.dataTransfer.files];
    dropArea.classList.add("active");
    js_file_upload(files);
});

// On créé la fonction pour uploader les fichiers
function upload_files(event) {
  event.preventDefault();
  for (let i = 0; i < files.length; i++) {
    js_file_upload(files[i]);
  }
}

// On créé la fonction js_file_upload
function js_file_upload(file) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "sql/post_upload.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let response = xhr.response;
                dropArea.innerHTML += response;
            }
        }
    }
    let formData = new FormData();
    formData.append("file", file);
    xhr.send(formData);
}

// On ajoute un événement au bouton pour uploader les fichiers
button.addEventListener("click", upload_files);