const core = {
    csrfToken: document
        .querySelector(`[name="csrf-token"]`)
        .getAttribute("content"),
    baseUrl: window.location.origin,
    getItemKeranjang: async () => {
        const request = new Request(`${core.baseUrl}/keranjang/jumlah`, {
            method: "GET",
            headers: {
                Accept: "application/json",
            },
        });

        fetch(request)
            .then((response) => response.json())
            .then((response) => {
                const { jumlah } = response;
                if (jumlah) {
                    document.getElementById("jumlahkeranjang").innerHTML =
                        jumlah;
                }
            });
    },
    confirmDelete: function (callback) {
        Swal.fire({
            title: "Anda yakin ingin menghapus produk?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!",
        }).then((result) => {
            if (result.isConfirmed) {
                callback();
            }
        });
    },
    showInfo: function (title) {
        Swal.fire({
            title: title,
            icon: "info",
            showConfirmButton: false,
            timer: 900,
        });
    },
    showLoading: function () {
        Swal.fire({
            title: "Tunggu Sebentar",
            imageUrl: "essence/loading.gif",
            imageWidth: 300,
            imageHeight: 200,
            imageAlt: "Custom image",
            showConfirmButton: false,
        });
    },
    formatRupiah: function (money) {
        return new Intl.NumberFormat(
            "id-ID",
            { style: "currency", currency: "IDR", minimumFractionDigits: 0 } // diletakkan dalam object
        ).format(money);
    },
};

core.getItemKeranjang();
