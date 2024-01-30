window.addEventListener("load", function () {
    const documento1 = document.getElementById("documento1");

    const abrirPDF = document.getElementById("abrirPDF");

    abrirPDF.onclick = function (ev) {
        ev.preventDefault();

        if (documento1.files.length === 1 && (documento1.files[0].type === "application/pdf" || documento1.files[0].type === "image/jpeg")) {

            var modal = document.createElement("div");
            modal.style.position = "fixed";
            modal.style.left = 0;
            modal.style.top = 0;
            modal.style.width = "100%";
            modal.style.height = "100%";
            modal.style.backgroundColor = "rgba(0,0,0,0.5)";
            modal.style.zIndex = 99;
            document.body.appendChild(modal);

            var visualizador = document.createElement("div");
            visualizador.style.position = "fixed";
            visualizador.style.left = "15%";
            visualizador.style.top = "15%";
            visualizador.style.width = "70%";
            visualizador.style.height = "70%";
            visualizador.style.backgroundColor = "White";
            visualizador.style.zIndex = 100;
            document.body.appendChild(visualizador);

            var contenido;
            if (documento1.files[0].type === "application/pdf") {
                contenido = document.createElement("iframe");
            } else { // Imagen JPG
                contenido = new Image();
            }
            contenido.style.width = "100%";
            contenido.style.height = "100%";
            contenido.src = URL.createObjectURL(documento1.files[0]);
            visualizador.appendChild(contenido);

            var closer = document.createElement("span");
            closer.innerHTML = "X";
            closer.style.padding = "5px";
            closer.style.position = "fixed";
            closer.style.backgroundColor = "White";
            closer.style.top = 0;
            closer.style.right = 0;
            closer.style.zIndex = 101;
            document.body.appendChild(closer);

            closer.onclick = function () {
                document.body.removeChild(modal);
                document.body.removeChild(visualizador);
                document.body.removeChild(closer);
            }
        }
    }
});
