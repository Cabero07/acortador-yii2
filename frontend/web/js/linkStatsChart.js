$(document).ready(function () {
    const ctx = document.getElementById('linkStatsChart').getContext('2d');
    let currentWeekStart = moment().startOf('isoWeek'); // Inicio de la semana actual

    // Procesar datos de stats provenientes de PHP
    const processData = (stats) => {
        const dataByDay = {};
        stats.forEach((stat) => {
            const day = moment(stat.day).format('YYYY-MM-DD');
            if (!dataByDay[day]) {
                dataByDay[day] = [];
            }
            dataByDay[day].push({
                link: stat.link_url,
                clicks: parseInt(stat.total_clicks),
            });
        });
        return dataByDay;
    };

    const dataByDay = processData(stats);

    // Generar datos para la gráfica
    const getChartData = (startOfWeek) => {
        const labels = [];
        const data = [];
        for (let i = 0; i < 7; i++) {
            const day = moment(startOfWeek).add(i, 'days').format('YYYY-MM-DD');
            labels.push(moment(day).format('DD/MM/YYYY'));
            const totalClicks = dataByDay[day]
                ? dataByDay[day].reduce((sum, item) => sum + item.clicks, 0)
                : 0;
            data.push(totalClicks);
        }
        return { labels, data };
    };

    // Actualizar la tabla de detalles
    const updateDetailsTable = (startOfWeek) => {
        const tableBody = $('#detailsTableBody');
        tableBody.empty();

        for (let i = 0; i < 7; i++) {
            const day = moment(startOfWeek).add(i, 'days').format('YYYY-MM-DD');
            if (dataByDay[day]) {
                dataByDay[day].forEach((item) => {
                    const row = `
                        <tr>
                            <td class="text-center">${moment(day).format('DD/MM/YYYY')}</td>
                            <td>
                                <a href="${item.link}" target="_blank" class="text-decoration-none">
                                    <i class="fas fa-link"></i> ${item.link}
                                </a>
                            </td>
                            <td class="text-center fw-bold">${item.clicks}</td>
                        </tr>
                    `;
                    tableBody.append(row);
                });
            }
        }
    };

    // Crear la gráfica
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [
                {
                    label: 'Visitas por Día',
                    data: [],
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: true,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Días',
                    },
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Visitas',
                    },
                },
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: (context) => `Visitas: ${context.raw}`,
                    },
                },
            },
        },
    });

    const updateChart = (startOfWeek) => {
        const { labels, data } = getChartData(startOfWeek);
        chart.data.labels = labels;
        chart.data.datasets[0].data = data;
        chart.update();
    };

    const updateWeekLabel = (startOfWeek) => {
        const endOfWeek = moment(startOfWeek).add(6, 'days');
        $('#currentWeek').text(
            `${moment(startOfWeek).format('DD/MM/YYYY')} - ${endOfWeek.format('DD/MM/YYYY')}`
        );
    };

    // Inicializar la gráfica
    updateChart(currentWeekStart);
    updateWeekLabel(currentWeekStart);
    updateDetailsTable(currentWeekStart);

    // Manejar botones de navegación
    $('#prevWeek').click(() => {
        currentWeekStart = moment(currentWeekStart).subtract(1, 'weeks');
        updateChart(currentWeekStart);
        updateWeekLabel(currentWeekStart);
        updateDetailsTable(currentWeekStart);
        $('#nextWeek').prop('disabled', currentWeekStart.isSameOrAfter(moment().startOf('isoWeek')));
    });

    $('#nextWeek').click(() => {
        if (currentWeekStart.isBefore(moment().startOf('isoWeek'))) {
            currentWeekStart = moment(currentWeekStart).add(1, 'weeks');
            updateChart(currentWeekStart);
            updateWeekLabel(currentWeekStart);
            updateDetailsTable(currentWeekStart);
        }
        $('#nextWeek').prop('disabled', currentWeekStart.isSameOrAfter(moment().startOf('isoWeek')));
    });
});