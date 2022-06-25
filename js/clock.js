setInterval(function () {
    var d = new Date();
    var day = d.getDay();
    var date = d.getDate();
    var month = d.getMonth();
    var year = d.getFullYear();
    var dayarr = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    var montharr = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
    'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ]
    day = dayarr[day];
    month = montharr[month];
    $('#date-wrapper').html(
        day + ", " + date + " " + month + " " + year
    )
    $('#time-wrapper').html(
        d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds()
    );
}, 500);