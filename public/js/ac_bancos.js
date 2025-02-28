document.addEventListener("DOMContentLoaded", function () {
    fetch('/bancos')
        .then(response => response.json())
        .then(data => {
            let select = document.getElementById("banco-select");
            data.forEach(banco => {
                let option = document.createElement("option");
                option.value = banco.nombre_banco;
                option.textContent = banco.nombre_banco;
                select.appendChild(option);
            });
        })
        .catch(error => console.error("Error al cargar bancos:", error));
});
