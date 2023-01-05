const objects1 = [];
const objects2 = [];
const objects3 = [];
const schema1 = [{
    column: 'Nama',
    type: String,
    value: guest => guest.name,
    width: 20
},
{
    column: 'Waktu',
    type: String,
    value: guest => guest.time,
    width: 10
},
{
    column: 'Tanggal',
    type: String,
    value: guest => guest.date,
    width: 25
},
{
    column: 'Pekerjaan/Profesi',
    type: String,
    value: guest => guest.profession,
    width: 20
},
{
    column: 'Topik',
    type: String,
    value: guest => guest.topic,
    width: 30
},
{
    column: 'Alasan Kunjungan',
    type: String,
    value: guest => guest.reason,
    width: 50
}
];
const schema2 = [{
    column: 'Nama',
    type: String,
    value: guest => guest.name,
    width: 20
},
{
    column: 'Waktu',
    type: String,
    value: guest => guest.time,
    width: 10
},
{
    column: 'Tanggal',
    type: String,
    value: guest => guest.date,
    width: 25
},
{
    column: 'Pekerjaan/Profesi',
    type: String,
    value: guest => guest.profession,
    width: 20
},
{
    column: 'Universitas',
    type: String,
    value: guest => guest.university,
    width: 20
},
{
    column: 'Topik',
    type: String,
    value: guest => guest.topic,
    width: 30
},
{
    column: 'Alasan Kunjungan',
    type: String,
    value: guest => guest.reason,
    width: 50
}
];
const schema3 = [{
    column: 'Nama',
    type: String,
    value: guest => guest.name,
    width: 20
},
{
    column: 'Waktu',
    type: String,
    value: guest => guest.time,
    width: 10
},
{
    column: 'Tanggal',
    type: String,
    value: guest => guest.date,
    width: 25
},
{
    column: 'Pekerjaan/Profesi',
    type: String,
    value: guest => guest.profession,
    width: 20
},
{
    column: 'Bagian',
    type: String,
    value: guest => guest.division,
    width: 20
},
{
    column: 'Topik',
    type: String,
    value: guest => guest.topic,
    width: 30
},
{
    column: 'Alasan Kunjungan',
    type: String,
    value: guest => guest.reason,
    width: 50
}
];

const updateLastTimeBackup = async () => {
    const backupDate = await getBackupDatetime();
    $("#last-export").text(`Terakhir di-download: ${backupDate.date}, Pukul ${backupDate.time}`);
}

const detailGuest = async (id) => {
    const guest = await getGuestById(id);
    let university = guest['raw'].university !== null
        ?
        (`
    <tr>
        <td>Universitas</td>
        <td>${guest['raw'].university}</td>
    </tr>
    `)
        :
        false;

    let division = guest['raw'].division !== null
        ?
        (`
        <tr>
            <td>Bagian</td>
            <td>${guest['raw'].division}</td>
        </tr>
        `)
        :
        false;

    $("#detailGuestModal .modal-body").html(`
        <table class="table table-bordered">
            <tr>
                <td>Nama</td>
                <td>${guest['show'].name}</td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>${guest['raw'].visit_time}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>${guest['show'].date}</td>
            </tr>
            <tr>
                <td>Pekerjaan/Profesi</td>
                <td>${guest['show'].profession}</td>
            </tr>
            ${university ? university : ''}
            ${division ? division : ''}
            <tr>
                <td>Topik</td>
                <td>${guest['show'].topic}</td>
            </tr>
            <tr>
                <td>Tujuan Kunjungan</td>
                <td>${guest['raw'].visit_reason}</td>
            </tr>
        </table>
    `);
    $("#detailGuestModal").modal('show');
}

const pagination = (dataSource) => {

    const container = $('#pagination-demo1');
    let options = {};
    if (dataSource.length) {
        options = {
            dataSource: dataSource,
            callback: function (response, pagination) {
                let dataHtml = '';

                $.each(response, function (index, value) {
                    dataHtml += `
                            <tr onclick="detailGuest(${value['raw'].id})">
                                <td class="text-center">${(index + 1) + (pagination.pageSize * (pagination.pageNumber - 1))}</td>
                                <td>${value['show'].name}</td>
                                <td class="text-center">${value['show'].date}</td>
                                <td class="text-center">${value['show'].profession}</td>
                                <td class="text-center">${value['show'].topic}</td>
                            </tr>`;
                });
                $('tbody').html(dataHtml);
            }
        };
    } else {
        options.dataSource = [];
        $('tbody').html(`
            <tr class="empty">
                <td class="text-center" colspan="5">Data Kosong</td>
            </tr>`);
    }

    $("#loader").remove();

    dataSource.forEach((value) => {
        if (value['raw'].university) {
            objects2.push({
                "name": value['raw'].name,
                "time": value['raw'].visit_time,
                "date": value['show'].date,
                "profession": value['show'].profession,
                "topic": value['show'].topic,
                "university": value['raw'].university,
                "reason": value['raw'].visit_reason
            });
        } else if (value['raw'].division) {
            objects3.push({
                "name": value['raw'].name,
                "time": value['raw'].visit_time,
                "date": value['show'].date,
                "profession": value['show'].profession,
                "topic": value['show'].topic,
                "division": value['raw'].division,
                "reason": value['raw'].visit_reason
            });
        } else {
            objects1.push({
                "name": value['raw'].name,
                "time": value['raw'].visit_time,
                "date": value['show'].date,
                "profession": value['show'].profession,
                "topic": value['show'].topic,
                "reason": value['raw'].visit_reason
            });
        }

    });
    container.pagination(options);
}


$(document).ready(async () => {
    const name = $("input[name=name]"),
        visit_date = $("input[name=visit_date]"),
        profession = $("select[name=profession]"),
        topic = $("select[name=topic_id]");

    name.val('');
    visit_date.val('Semua');
    topic.prop('selectedIndex', 0);
    profession.prop('selectedIndex', 0);

    const topics = await getTopics();
    const guests = await getGuests({
        name: name.val(),
        visit_date: visit_date.val(),
        profession: profession.val(),
        topic: topic.val(),
    });

    topics.forEach(value => $("select[name=topic_id]").append(`<option value="${value.id}">${value.name}</option>`));

    const filter = async (filter = {
        name: name.val(),
        visit_date: visit_date.val(),
        profession: profession.val(),
        topic: topic.val(),
    }) =>
        pagination(await getGuests(filter));

    pagination(guests);
    updateLastTimeBackup();
    name.on('input', () => filter());
    profession.on('change', () => filter());
    topic.on('change', () => filter());

    visit_date.daterangepicker({
        opens: 'right',
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    }, function (start, end, label) {
        filter({
            name: name.val(),
            visit_date: start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'),
            profession: profession.val(),
            topic: topic.val(),
        });
    });
    visit_date.on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });

    visit_date.on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('Semua');
        filter();
    });

    $("#export").on('click', async () => {
        try {
            writeXlsxFile([objects1, objects2, objects3], {
                schema: [schema1, schema2, schema3],
                sheets: ['Umum', 'Mahasiswa', 'Pegawai BPTP'],
                fileName: 'Data Riwayat Kunjungan.xlsx'
            });
            await postBackupDatetime();
            updateLastTimeBackup();
        } catch (error) {
            console.error(error)
            alert("Error! Hubungi Programmer!")
        }
    });
});