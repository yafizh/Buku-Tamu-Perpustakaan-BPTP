$(document).ready(async () => {
    const topic_id = $("select[name=topic_id]"),
        name = $("input[name=name]"),
        visit_time = $("input[name=visit_time]"),
        visit_date = $("input[name=visit_date]"),
        visit_reason = $("textarea[name=visit_reason]"),
        profession = $("select[name=profession]");
    const topics = await getTopics();

    topics.forEach(value => $("select[name=topic_id]").append(`<option value="${value.id}">${value.name}</option>`));

    $('#profession').on('change', function () {
        $(".added").remove();
        if ($(this).val() == 2) {
            $("#profession-field").after(university);
            return;
        }
        if ($(this).val() == 3) {
            $("#profession-field").after(employees);
            return;
        }
    });

    $("form").on("submit", async (e) => {
        e.preventDefault();
        const guest = {
            topic_id: topic_id.val(),
            name: name.val(),
            visit_datetime: `${visit_date.val()} ${visit_time.val()}`,
            visit_reason: visit_reason.val(),
            profession: profession.children(':selected').text()
        };
        if (profession.children(':selected').val() == 2)
            guest["university"] = $("input[name=university]").val();

        if (profession.children(':selected').val() == 3)
            guest["division"] = $("select[name=division] option:selected").text();

        const response = await postGuest(guest);
        if (response.isSuccess) {
            Swal.fire({
                title: 'Berhasil Mengisi Buku Tamu',
                icon: 'success',
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonText: 'Tutup',
            }).then((result) => {
                if (result.isDismissed) {
                    topic_id.prop('selectedIndex', 0);
                    name.val('');
                    visit_reason.val('');
                    profession.prop('selectedIndex', 0);
                    $(".added").remove();
                }
            });

        } else {
            Swal.fire({
                title: 'Gagal Mengisi Buku Tamu',
                icon: 'error',
                showConfirmButton: false
            });
        }
    });

    setInterval(() => {
        const newDate = new Date();
        const time = newDate.toLocaleString('id-ID', { timeZone: 'Asia/Kuala_Lumpur' }).split(' ')[1];
        visit_time.val(`${time.split('.')[0]}.${time.split('.')[1]}`);
    }, 1000);
});