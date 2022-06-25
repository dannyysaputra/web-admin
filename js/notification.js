function formatDate(date) {
    const d = new Date(date);
    const dayArray = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    const monthArray = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
        'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ]

    var dd = d.getDate();
    var mm = d.getMonth();
    var yyyy = d.getFullYear();

    return `${dayArray[d.getDay()]}, ${dd} ${monthArray[mm]} ${yyyy}`;
}

function createNotificationBox(date, status, body) {
    var color = '';

    if (status == 'Danger') {
        color = 'danger';
    } else if (status == 'Warning') {
        color = 'warning';
    } else if (status == 'Safe') {
        color = 'success';
    }

    return `
    <div class="d-flex border border-${color} m-2 align-items-center">
        <div class="ms-4 me-4">
            <span class="d-block bg-${color} rounded-circle" style="width: 50px; height: 50px;"></span>
        </div>
        <div class="align-items-center mt-3">
            <span class="fw-bold text-${color} text-uppercase">${formatDate(date)}</span>
            <p >${body}</p>
        </div>
    </div>`
}

document.addEventListener('DOMContentLoaded', function () {
    const notificationBtn = $('#notification-btn');
    const notificationBtnFoot = $('#notification-btn-foot');

    function renderNotificationBtn(data) {
        notificationBtn.text(`${data.length} notifications`)
    }

    function renderNotificationBtnFoot(data) {
        notificationBtnFoot.text(`${data.length}`)
    }

    function renderNotificationContent(data) {
        console.log(data)
        data.map(d => {
            $('#notification-content').append(createNotificationBox(d.created_at, d.status, d.body))
        });
    }

    function renderNotificationSidebarContent(data) {
        data.map(d => {
            $('#notification-sidebar-content').append(createNotificationBox(d.created_at, d.status, d.body))
        });
    }

    function renderCheckboxStatus(data) {
        const result = [];

        const danger = $('#danger-check')[0].checked;
        const warning = $('#warning-check')[0].checked;
        const safe = $('#safe-check')[0].checked;
        
        if(danger) {
            data.map((d) => {
                if(d.status === 'Danger') {
                    result.push(d);
                }
            })
        }
        if(warning) {
            data.map((d) => {
                if(d.status === 'Warning') {
                    result.push(d);
                }
            })
        }
        if(safe) {
            data.map((d) => {
                if(d.status === 'Safe') {
                    result.push(d);
                }
            })
        }

        setTimeout(() => {
            $('#notification-content').empty();
            renderNotificationContent(result);
        }, 500)
    }

    function notificationFilter(data) {
        $('#notif-search-input').on('input', function() {
            var value = $(this).val().toLowerCase();

            const result = data.filter(d => {
                return d.body.toLowerCase().includes(value);
            })

            setTimeout(() => {
                $('#notification-content').empty();
                renderNotificationContent(result);
            }, 500)
        });

        $('#danger-check').change(function() {
            renderCheckboxStatus(data);
        });

        $('#warning-check').change(function() {
            renderCheckboxStatus(data);
        });

        $('#safe-check').change(function() {
            renderCheckboxStatus(data);
        });

        renderCheckboxStatus(data);
    }

    $.ajax('/api/notifications.json', {
        success: function (data) {
            renderNotificationBtn(data);
            renderNotificationBtnFoot(data);
            renderNotificationContent(data);
            renderNotificationSidebarContent(data);
            notificationFilter(data);
        }
    })
})