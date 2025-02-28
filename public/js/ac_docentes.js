document.addEventListener('DOMContentLoaded', function () {
    const docenteInput = document.getElementById('docente-autocomplete');
    const docenteList = document.getElementById('docente-list');
    
    docenteInput.addEventListener('keyup', function () {
        let query = docenteInput.value;
        
        if (query.length > 0) {  // Si la longitud del texto es mayor a 0 caracteres
            fetch(`/get-docentes?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    docenteList.innerHTML = ''; // Limpiar la lista antes de agregar resultados
                    if (data.length > 0) {
                        docenteList.classList.remove('d-none');
                        data.forEach(docente => {
                            let listItem = document.createElement('li');
                            listItem.classList.add('list-group-item');
                            listItem.textContent = docente.nombre_docente;
                            listItem.onclick = function () {
                                docenteInput.value = docente.nombre_docente;
                                docenteList.classList.add('d-none');
                            };
                            docenteList.appendChild(listItem);
                        });
                    } else {
                        docenteList.classList.add('d-none');
                    }
                });
        } else {
            docenteList.classList.add('d-none');
        }
    });
    
    document.addEventListener('click', function (e) {
        if (!docenteInput.contains(e.target)) {
            docenteList.classList.add('d-none');
        }
    });
});
