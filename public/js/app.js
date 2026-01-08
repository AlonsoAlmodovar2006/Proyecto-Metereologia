// (async function () {
//   const data = [
//     { year: 2010, count: 11 },
//     { year: 2011, count: 20 },
//     { year: 2012, count: 15 },
//     { year: 2013, count: 25 },
//     { year: 2014, count: 22 },
//     { year: 2015, count: 30 },
//     { year: 2016, count: 28 },
//   ];

//   new Chart(
//     document.getElementById('acquisitions'),
//     {
//       type: 'bar',
//       data: {
//         labels: data.map(row => row.year),
//         datasets: [
//           {
//             label: 'Acquisitions by year',
//             data: data.map(row => row.count)
//           }
//         ]
//       }
//     }
//   );
// })();

// const ctx = document.getElementById('tabla');

// new Chart(ctx, {
//   type: 'line',
//   data: {
//     labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
//     datasets: [{
//       label: '# of Votes',
//       data: [[10, 20], [15, null], [20, 10], [1, 2], [4, 2]],
//       borderWidth: 1
//     }]
//   },
//   options: {
//     scales: {
//       y: {
//         beginAtZero: true
//       }
//     }
//   }
// });
document.addEventListener("DOMContentLoaded", () => {
  const datos = JSON.parse(document.querySelector("#datos").innerHTML);

  // datos.foreach(element => element.fechaSistema = new Date(element.fechaSistema));
  console.log(datos);

  (async function () {
    const data = datos;

    new Chart(
      document.getElementById('acquisitions'),
      {
        type: 'bar',
        data: {
          labels: data.map(row => row.fechaSistema),
          datasets: [
            {
              label: 'Humedad',
              data: data.map(row => row.humedad)
            }
          ]
        }
      }
    );
  })();
});
