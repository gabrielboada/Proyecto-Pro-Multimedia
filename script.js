
//controlar el sub menu de musica
    document.querySelectorAll(".genre-button").forEach(button => {
      button.addEventListener("click", function() {
        const genre = this.getAttribute("data-genre");

        // Enviar solicitud al servidor utilizando Fetch API con el parámetro del género
        fetch(`buscar_canciones.php?genre=${genre}`)
          .then(response => response.text())
          .then(data => {
            document.getElementById("resultado").innerHTML = data;
          });
      });
    });
    




//controlar el sub menu de mymedia

    document.addEventListener("DOMContentLoaded", function() {
      // Obtener referencia a los elementos del submenú
      const submenus = document.querySelectorAll(".submenu a");
    
      // Agregar un evento clic a cada elemento del submenú
      submenus.forEach(submenu => {
        submenu.addEventListener("click", function(event) {
          event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
    
          // Obtener el ID del submenú (corresponde a la tabla en la base de datos)
          const tabla = this.getAttribute("id");
    
          // Realizar una solicitud al servidor para obtener los favoritos del usuario
          fetch(`consultar_favoritos.php?tabla=${tabla}`)
            .then(response => response.text())
            .then(data => {
              // Mostrar los resultados en el div "misfavoritos"
              document.getElementById("misfavoritos").innerHTML = data;
            });
        });
      });
    });
    

















    // Función para abrir el popup con la imagen grande
    function openPopup(imgSrc) {
      const popup = document.querySelector('.popup');
      const popupImg = popup.querySelector('img');
      const downloadLink = popup.querySelector('.download-btn');

      popupImg.src = imgSrc;
      popup.style.display = 'block';

      // Establecer la URL del botón de descarga
      downloadLink.href = imgSrc;
    }

    // Función para cerrar el popup
    function closePopup() {
      const popup = document.querySelector('.popup');
      popup.style.display = 'none';
    }









    document.addEventListener("DOMContentLoaded", function () {
      // Obtener todos los elementos de audio
      const audioElements = document.querySelectorAll(".custom-audio");
  
      // Asignar un evento 'play' a cada elemento de audio
      audioElements.forEach((audio) => {
          audio.addEventListener("play", function () {
              // Detener todas las demás canciones y reiniciarlas
              audioElements.forEach((otherAudio) => {
                  if (otherAudio !== audio) {
                      otherAudio.pause();
                      otherAudio.currentTime = 0;
                  }
              });
          });
      });
  });


    


    

    
