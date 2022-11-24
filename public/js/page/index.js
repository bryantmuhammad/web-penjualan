"use strict";

function formatRupiah(money) {
    return new Intl.NumberFormat(
        "id-ID",
        { style: "currency", currency: "IDR", minimumFractionDigits: 0 } // diletakkan dalam object
    ).format(money);
}

var ctx = document.getElementById("myChart").getContext("2d");

fetch(`${window.location.origin}/api/chartpenjualan`)
    .then((response) => response.json())
    .then((response) => {
        var myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: response.data.list_bulan,
                datasets: [
                    {
                        label: "Grafik Penjualan",
                        data: response.data.list_harga,
                        fill: false,
                        borderColor: "rgb(75, 192, 192)",
                        tension: 0.1,
                    },
                ],
            },
            options: {
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                callback: function (value, index, values) {
                                    return formatRupiah(value);
                                },
                            },
                        },
                    ],
                },
            },
        });
    });
