document.addEventListener("DOMContentLoaded", () => {
  cargarDatosUltimas24horas();
});

function cargarDatosUltimas24horas() {
  const datosElement = document.querySelector("#datos");
  if (!datosElement) {
    console.log("Error al obtener los datos");
    return;
  }

  const datos = JSON.parse(datosElement.innerHTML);

  if (!datos || datos.length === 0) {
    console.log("Error al obtener los datos");
    return;
  }

  const ultimo = datos[datos.length - 1];

  document.querySelector('#current-temp').innerText = `${ultimo.temperatura}°C`;
  document.querySelector('#current-humidity').innerText = `${ultimo.humedad}%`;
  document.querySelector('#current-pressure').innerText = `${ultimo.presion} hPa`;
  document.querySelector('#current-wind').innerText = `${ultimo.viento} km/h`;
  document.querySelector('#current-rain').innerText = `${ultimo.lluvia ?? 0} mm`;

  const fechaUltimo = new Date(ultimo.fechaSistema);
  document.querySelector('#last-update').innerText = fechaUltimo.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
}