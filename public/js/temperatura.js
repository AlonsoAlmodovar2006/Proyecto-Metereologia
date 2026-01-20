const paletaColoresTemp = { bg: 'rgba(255, 99, 132, 0.2)', border: 'rgba(255, 99, 132, 1)' }; // Color rojizo para temp

document.addEventListener("DOMContentLoaded", () => {
    const datosRaw = document.querySelector("#datos").innerHTML;
    const datosElement = JSON.parse(datosRaw);

    // 1. Extraer las horas para el eje X
    const horas = datosElement.map(row => {
        const fecha = new Date(row.fechaSistema); // Asegúrate que tu columna se llame fechaSistema
        return fecha.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
    });

    // 2. Llamar a la función que crea el gráfico
    // Usamos "temperatura" como ID del canvas y como nombre de la columna en la DB
    pintarGrafico(datosElement, "temperatura", horas, paletaColoresTemp);
});

function pintarGrafico(data, campo, etiquetas, colores) {
    new Chart(document.getElementById(campo), {
        type: 'line',
        data: {
            labels: etiquetas,
            datasets: [{
                label: 'Grados Celsius (°C)',
                data: data.map(row => row[campo]), // Mapea la columna 'temperatura' de tu DB
                backgroundColor: colores.bg,
                borderColor: colores.border,
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: { display: true, text: 'Evolución de la Temperatura', font: { size: 20 } }
            }
        }
    });
}