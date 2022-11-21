$(".btn-number").click(function (e) {
    e.preventDefault();

    fieldName = $(this).attr("data-field");
    type = $(this).attr("data-type");
    const input = $("input[name='" + fieldName + "']");
    const currentVal = parseInt(input.val());
    const idKeranjang = input.data("id");

    if (!isNaN(currentVal)) {
        if (type == "minus") {
            if (currentVal > input.attr("min")) {
                input.val(currentVal - 1).change();
            }
            if (parseInt(input.val()) == input.attr("min")) {
                $(this).attr("disabled", true);
            }
        } else if (type == "plus") {
            if (currentVal < input.attr("max")) {
                input.val(currentVal + 1).change();
            }
            if (parseInt(input.val()) == input.attr("max")) {
                $(this).attr("disabled", true);
            }
        }

        updateKeranjang(input.val(), idKeranjang, input);
    } else {
        input.val(0);
    }
});
$(".input-number").focusin(function () {
    $(this).data("oldValue", $(this).val());
});
$(".input-number").change(function () {
    minValue = parseInt($(this).attr("min"));
    maxValue = parseInt($(this).attr("max"));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr("name");
    if (valueCurrent >= minValue) {
        $(
            ".btn-number[data-type='minus'][data-field='" + name + "']"
        ).removeAttr("disabled");
    } else {
        alert("Sorry, the minimum value was reached");
        $(this).val($(this).data("oldValue"));
    }
    if (valueCurrent <= maxValue) {
        $(
            ".btn-number[data-type='plus'][data-field='" + name + "']"
        ).removeAttr("disabled");
    } else {
        alert("Sorry, the maximum value was reached");
        $(this).val($(this).data("oldValue"));
    }
});

$(".input-number").keydown(function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if (
        $.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
        // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)
    ) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if (
        (e.shiftKey || e.keyCode < 48 || e.keyCode > 57) &&
        (e.keyCode < 96 || e.keyCode > 105)
    ) {
        e.preventDefault();
    }
});

function updateKeranjang(jumlah, idKeranjang, keranjang) {
    const request = new Request(`${core.baseUrl}/keranjang/${idKeranjang}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json;",
            "X-CSRF-TOKEN": core.csrfToken,
        },
        body: JSON.stringify({
            jumlah: jumlah,
        }),
    });

    fetch(request)
        .then((response) => response.json())
        .then((response) => {
            let { grandtotal, subtotal } = response.data;

            Swal.fire({
                icon: "success",
                position: "bottom-right",
                title: response.message,
                timer: 600,
                toast: true,
                showConfirmButton: false,
            }).then((res) => {
                keranjang.parent().parent().next().html(subtotal);
                document.getElementById("grandtotal").innerHTML = grandtotal;
            });
        });
}

let buttonHapusKeranjang = document.querySelectorAll(".hapuskeranjang");

buttonHapusKeranjang.forEach((button) => {
    button.addEventListener("click", function (e) {
        const idKeranjang = this.children[0].dataset.id;
        core.confirmDelete(function () {
            const request = new Request(
                `${core.baseUrl}/keranjang/${idKeranjang}`,
                {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": core.csrfToken,
                    },
                }
            );

            fetch(request)
                .then((response) => response.json())
                .then((response) => {
                    Swal.fire({
                        icon: response.status,
                        title: response.message,
                        showConfirmButton: false,
                        timer: 900,
                    }).then(() => {
                        location.reload();
                    });
                });
        });
    });
});
