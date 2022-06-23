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
        day + ", " + date + "-" + month + "-" + year
    )
    $('#time-wrapper').html(
        d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds()
    );
}, 500);

// var d = new Date();
// var day = d.getDay();
// var date = d.getDate();
// var month = d.getMonth();
// var year = d.getFullYear();
// var hour = d.getHours();
// var minute = d.getMinutes();
// var second = d.getSeconds();
// 
// switch (bulan) {
//     case 0:
//         bulan = "Januari";
//         break;
//     case 1:
//         bulan = "Februari";
//         break;
//     case 2:
//         bulan = "Maret";
//         break;
//     case 3:
//         bulan = "April";
//         break;
//     case 4:
//         bulan = "Mei";
//         break;
//     case 5:
//         bulan = "Juni";
//         break;
//     case 6:
//         bulan = "Juli";
//         break;
//     case 7:
//         bulan = "Agustus";
//         break;
//     case 8:
//         bulan = "September";
//         break;
//     case 9:
//         bulan = "Oktober";
//         break;
//     case 10:
//         bulan = "November";
//         break;
//     case 11:
//         bulan = "Desember";
//         break;
// }
// var tampilTanggal = "Tanggal: " + hari + ", " + tanggal + " " + bulan + " " + tahun;
// var tampilWaktu = "Jam: " + jam + ":" + menit + ":" + detik;
// console.log(tampilTanggal);
// console.log(tampilWaktu);