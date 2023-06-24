// darkMode.js

const darkModeToggle = document.getElementById('dark-mode-toggle');
const darkModeStyle = document.getElementById('dark-mode-style');

// Vérifie si le mode sombre est actif ou non
const isDarkModeActive = () => localStorage.getItem('darkModeActive') === 'true';

// Définit le mode sombre
const enableDarkMode = () => {
    darkModeStyle.innerHTML = `
        body {
            background-color: #333;
            color: #fff;
        }
        
        .tab {
            background-color: #444;
        }
        
        .footer {
            background-color: #444;
        }

        form {
            background-color: #444;
        }

        .container {
            background-color: #444;
        }

        .info-first {
            background-color: #444;
        }

        .info-first p {
            color: #fff;
        }

        .pagination a.current {
            background-color: #eee;
            color: #444;
        }

        .inp-form {
            background-color: #A3A3A3;
            color: #fff;
        }

        .inp-form::placeholder {
            color: #fff;
        }

        .drag-area .icon{
            color: #fff;
        }

        .drag-area header {
            color: #fff;
        }

        .drag-area span {
            color: #fff;
        }

        .drag-area {
            border: 2px dashed #fff;
        }

        .drag-area button {
            border: 1px solid #444;
            background-color: #444;
            color: #fff;
        }

        .popup {
            background-color: #444;
        }

        .popup p {
            color: #fff;
        }

        .popup-content {
            background-color: #444;
        }

        .popup-content h2 {
            color: #fff;
        }
    `;

    // Stocke l'état du mode sombre dans le localStorage
    localStorage.setItem('darkModeActive', 'true');
};

// Désactive le mode sombre
const disableDarkMode = () => {
    darkModeStyle.innerHTML = '';

    // Stocke l'état du mode sombre dans le localStorage
    localStorage.setItem('darkModeActive', 'false');
};

// Bascule entre le mode sombre et le mode normal
const toggleDarkMode = () => {
    if (isDarkModeActive()) {
        disableDarkMode();
    } else {
        enableDarkMode();
    }
};

// Vérifie l'état initial du mode sombre lors du chargement de chaque page
document.addEventListener('DOMContentLoaded', () => {
    if (isDarkModeActive()) {
        enableDarkMode();
    }
});

// Gère les clics sur le bouton de bascule du mode sombre
darkModeToggle.addEventListener('click', toggleDarkMode);
