const buttonAddProduk = document.getElementById("add-produk");

buttonAddProduk.addEventListener("click", function (e) {
    e.preventDefault();
    const produk = document.getElementById("id_produk");
    if (produk.value) {
        drawTable(produk);
    }
});

function drawTable(produk) {
    const tbdoy = document.getElementById("masukProduk");
    const idProduk = produk.value;
    const namaProduk = produk.options[produk.selectedIndex].dataset.nama;
    const hargaProduk = produk.options[produk.selectedIndex].dataset.harga;

    //Cek if product exist
    const cekProduk = document.getElementById(`produk-${idProduk}`);

    if (!cekProduk) {
        let html = `<tr id="produk-${idProduk}">`;
        html += `<td class="text-center">
                <button class="btn btn-danger btn-sm" onclick="removeRow(event)">
                    <i class="fa fa-trash"></i>
                </button>
                <input name="produk[]" type="hidden" value=${idProduk}>
            </td>`;
        html += `<td>${namaProduk}</td>`;
        html += `<td>${formatRupiah(hargaProduk)}</td>`;
        html += `<td><input type="number" onchange="hitungTotal(event)" data-harga="${hargaProduk}" min="1" name="jumlah[]" value="1" class="form-control"></td>`;
        html += `<td>${formatRupiah(hargaProduk)}</td>`;
        html += `</tr>`;

        tbdoy.insertAdjacentHTML("beforeend", html);
    }
}

function hitungTotal(event) {
    const jumlah = event.target.value;
    const harga = event.target.dataset.harga;
    const total = jumlah * harga;

    const htmlTotal = event.target.parentElement.nextSibling;
    htmlTotal.innerHTML = formatRupiah(total);
}

function removeRow(event) {
    event.preventDefault();

    confirmDelete(() => {
        const tr = event.target.parentElement.parentElement.parentElement;
        tr.remove();
    });
}
