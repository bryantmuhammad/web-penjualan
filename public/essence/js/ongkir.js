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

                    htmlOption += `<option value="${ongkir}" data-pengiriman="${name} - ${service}" data-estimasi="${estimasi}">${
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
    const pengiriman = $("#ongkir option:selected").data("pengiriman");
    const estimasi = $("#ongkir option:selected").data("estimasi");

    if (ongkir) {
        document.getElementById("spanongkir").innerHTML =
            core.formatRupiah(ongkir) + ",00";
        const subtotal = document.getElementById("subtotal").value;
        const grandTotal = parseFloat(subtotal) + parseFloat(ongkir);
        document.getElementById("spangrandtotal").innerHTML =
            core.formatRupiah(grandTotal) + ",00";

        document.getElementById("estimasi").value = estimasi;
        document.getElementById("pengiriman").value = pengiriman;
    }
});

const buttonCheckout = document.getElementById("checkout");

buttonCheckout.addEventListener("click", async function (e) {
    e.preventDefault();
    const formData = new FormData(document.getElementById("formcheckout"));

    const ongkir = formData.get("ongkir");
    if (!ongkir) {
        core.showInfo("Pilih ongkir terlebih dahulu");
    }

    $("#loadMe").modal({
        backdrop: "static", //remove ability to close modal with click
        keyboard: false, //remove option to close with keyboard
        show: true, //Display loader!
    });

    const request = new Request(`${core.baseUrl}/penjualan/checkout`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": core.csrfToken,
            Accept: "application/json",
        },
        body: formData,
    });

    await fetch(request)
        .then((response) => response.json())
        .then((response) => {
            $("#loadMe").modal("hide");
            if (response.status_code == 500) {
                core.showInfo(response.message);
            }
            if (response.status_code == 200) {
                Swal.close();
                window.snap.pay(response.data.token, {
                    onSuccess: function (result) {
                        /* You may add your own implementation here */
                        alert("payment success!");
                        console.log(result);
                    },
                    onPending: function (result) {
                        /* You may add your own implementation here */

                        document.getElementById("grandtotal").value =
                            response.data.total;
                        document.getElementById("midtrans").value =
                            JSON.stringify(result);
                        document.getElementById("formcheckout").submit();
                    },
                    onError: function (result) {
                        /* You may add your own implementation here */
                        alert("payment failed!");
                        console.log(result);
                    },
                    onClose: function () {
                        /* You may add your own implementation here */
                        core.showInfo("Anda belum menyelesaikan pemabayaran");
                    },
                });
            }
        });
});
