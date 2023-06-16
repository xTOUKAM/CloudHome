// darkMode.js

const darkModeToggle = document.getElementById('dark-mode-toggle');
const darkModeStyle = document.getElementById('dark-mode-style');

// Vérifie si le mode sombre est actif ou non
const isDarkModeActive = () => darkModeStyle.innerHTML.length > 0;

// Définit le mode sombre
const enableDarkMode = () => {
    darkModeStyle.innerHTML = `
        body {
            background-color: #333;
            color: #fff;
        }
        
        .tab{
            background-color: #444;
        }
        
        .footer {
            background-color: #444;
        }

        form {
            background-color: #444;
        }
        
        .inp-form {
            background-color: #eee;
        }

        .container {
            background-color: #444;
        }
    `;
};

// Désactive le mode sombre
const disableDarkMode = () => {
    darkModeStyle.innerHTML = '';
};

// Bascule entre le mode sombre et le mode normal
const toggleDarkMode = () => {
    if (isDarkModeActive()) {
        disableDarkMode();
    } else {
        enableDarkMode();
    }
};

// Gère les clics sur le bouton de bascule du mode sombre
darkModeToggle.addEventListener('click', toggleDarkMode);
