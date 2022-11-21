/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

function deleteData(event) {
    event.preventDefault();

    const form = event.target.parentElement;
    confirmDelete(() => {
        event.target.parentElement.submit();
    });
}

function confirmDelete(callback) {
    swal.fire({
        icon: "warning",
        text: "Yakin ingin menghapus data?",
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: "Ya, hapus",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
    }).then((result) => {
        if (result.isConfirmed) {
            callback();
        }
    });
}

function formatRupiah(money) {
    return new Intl.NumberFormat(
        "id-ID",
        { style: "currency", currency: "IDR", minimumFractionDigits: 0 } // diletakkan dalam object
    ).format(money);
}
