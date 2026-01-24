const paletaColores = [
    { bg: 'rgba(54, 162, 235, 0.2)', border: 'rgba(54, 162, 235, 1)' },   // Azul
    { bg: 'rgba(255, 99, 132, 0.2)', border: 'rgba(255, 99, 132, 1)' },   // Rojo
    { bg: 'rgba(75, 192, 192, 0.2)', border: 'rgba(75, 192, 192, 1)' },   // Verde
    { bg: 'rgba(255, 206, 86, 0.2)', border: 'rgba(255, 206, 86, 1)' },   // Amarillo
    { bg: 'rgba(153, 102, 255, 0.2)', border: 'rgba(153, 102, 255, 1)' }, // Morado
    { bg: 'rgba(255, 159, 64, 0.2)', border: 'rgba(255, 159, 64, 1)' },    // Naranja
    { bg: 'rgba(201, 203, 207, 0.2)', border: 'rgba(201, 203, 207, 1)' }   // Gris
];

document.addEventListener("DOMContentLoaded", () => {
    cargarTemperatura();
});

(() => {
    'use strict'

    const forms = document.querySelectorAll('.needs-validation')

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()

function cargarTemperatura() {
    const datosElement = JSON.parse(document.querySelector("#datos").innerHTML);

    const horas = datosElement.map(row => {
        const fecha = new Date(row.fechaSistema);
        return fecha.toLocaleTimeString('es-ES', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        });
    });

    crearGrafico(datosElement, "temperatura", horas, paletaColores);
}
function crearGrafico(data, element, horas, colors) {
    const tituloFormateado = element.charAt(0).toUpperCase() + element.slice(1);

    new Chart(
        document.getElementById(element),
        {
            type: 'line',
            data: {
                labels: horas,
                datasets: [
                    {
                        label: `${tituloFormateado}`,
                        data: data.map(row => row[element]),
                        backgroundColor: colors.bg,
                        borderColor: colors.border,
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                
            }
        }
    );
}