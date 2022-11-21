$("#provinsi").on("change", function (e) {
    const idProvinsi = $(this).val();
    if (idProvinsi) {
        const request = new Request(
            `${core.baseUrl}/api/provinsi/getkabupaten`,
            {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": core.csrfToken,
                    Accept: "application/json",
                },
                body: JSON.stringify({
                    id_provinsi: idProvinsi,
                }),
            }
        );

        fetch(request)
            .then((response) => response.json())
            .then((response) => {
                const kabupaten = response.data;
                $("#kabupaten").empty();

                let html = "<option value=''>- Pilih Kabupaten -</option>";
                kabupaten.forEach((index) => {
                    const { id_kabupaten, nama_kabupaten } = index;
                    html += `<option value="${id_kabupaten}">${nama_kabupaten}</option>`;
                });

                $("#kabupaten").append(html);
                $("#kabupaten").niceSelect("update");
            });
    }
});
