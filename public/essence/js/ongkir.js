function getOngkir() {
    const request = new Request(`${core.baseUrl}/ongkir/getongkir`, {
        method: "GET",
        headers: {
            Accept: "application/json",
        },
    });

    fetch(request)
        .then((response) => response.json())
        .then((response) => {
            const listEkspedisi = response.data;
            drawOptionOngkir(listEkspedisi);
        });
}

function drawOptionOngkir(listEkspedisi) {
    let htmlOption = `<option value="">- Pilih Ongkir -</option>`;
    listEkspedisi.forEach((ekspedisi) => {
        if (ekspedisi.length) {
            ekspedisi.forEach((element) => {
                const { name, costs } = element;

                costs.forEach((cost) => {
                    const service = cost.service;
                    const ongkir = cost.cost[0].value;
                    const estimasi = cost.cost[0].etd;

                    htmlOption += `<option value="${ongkir}" data-esitmasi="${estimasi}">${
                        name +
                        " - " +
                        service +
                        " - " +
                        core.formatRupiah(ongkir)
                    }</option>`;
                });
            });
        }
    });

    $("#ongkir").empty();
    $("#ongkir").append(htmlOption);
    $("#ongkir").niceSelect("update");
}

getOngkir();

$("#ongkir").on("change", function (e) {
    const ongkir = $(this).val();
    if (ongkir) {
        document.getElementById("spanongkir").innerHTML =
            core.formatRupiah(ongkir) + ",00";
        const subtotal = document.getElementById("subtotal").value;
        const grandTotal = parseFloat(subtotal) + parseFloat(ongkir);
        document.getElementById("spangrandtotal").innerHTML =
            core.formatRupiah(grandTotal) + ",00";
    }
});
